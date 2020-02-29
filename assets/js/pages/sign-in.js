$(document).ready(function(){

  $('#sign_in').validate({
      highlight: function (input) {
          console.log(input);
          $(input).parents('.form-line').addClass('error');
      },
      unhighlight: function (input) {
          $(input).parents('.form-line').removeClass('error');
      },
      errorPlacement: function (error, element) {
          $(element).parents('.input-group').append(error);
      }
  });

	setCookie("jwt", "", 1);

	var min=5;
	var max=9;
	var jumlah = Math.round(Math.random() * (+max - +min) + +min);

	min=1;
	max=4;
	var pengurang = Math.round(Math.random() * (+max - +min) + +min);
	var angka = jumlah - pengurang;

	document.getElementById("jumlahan").innerHTML = angka+" + "+pengurang;

  $(document).on('submit', '#sign_in', function(){
		var hasil = document.getElementById("hasil").value;

		if (hasil==jumlah) {
			var sign_in=$(this);
			var form_data=JSON.stringify(sign_in.serializeObject());

      console.log(form_data);

			$.ajax({
				url: API_URL+"pengguna/login.php",
				type : "POST",
				contentType : 'application/json',
				data : form_data,
				success : function(result){

					if(result.message=="Successful login."){
						setCookie("jwt", result.jwt, 1);
            window.location.replace(MAIN_URL);
					}else{
            bootbox.alert(result.message);
					}

				},
				error: function(xhr, resp, text){
          bootbox.alert(text);
					document.getElementById('response').innerHTML="<div class='alert alert-danger'>"+text+"</div>";
					console.log(xhr);

				}
			});

		}
		else {
      bootbox.alert("Penjumlahan tidak sesuai");
			return false;
		}

		return false;
	});

});
