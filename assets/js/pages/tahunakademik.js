$(function () {
  $('#myForm').validate({
    rules: {
      'date': {
        customdate: true
      },
      'tahunakademik': {
        tahunakademik: true
      }
    },
    highlight: function (input) {
      $(input).parents('.form-line').addClass('error');
    },
    unhighlight: function (input) {
      $(input).parents('.form-line').removeClass('error');
    },
    errorPlacement: function (error, element) {
      $(element).parents('.form-group').append(error);
    }

  });

  //Custom Validations ===============================================================================
  //Date
  $.validator.addMethod('customdate', function (value, element) {
    return value.match(/^\d\d\d\d?-\d\d?-\d\d$/);
  },
  'Please enter a date in the format YYYY-MM-DD.'
);

//Credit card
$.validator.addMethod('tahunakademik', function (value, element) {
  return value.match(/^\d\d\d\d?-\d\d\d\d$/);
},
'Masukan dengan format format XXXX-XXXX.'
);
//==================================================================================================

$(document).on('click', '.delete-button', function(){
  var id = $(this).attr("data-id");
  bootbox.confirm({
    message: "<h4>Yakin Hapus? "+id+"</h4>",
    buttons: {
      confirm: {
        label: '<span class="glyphicon glyphicon-ok"></span> Yes',
        className: 'btn-success'
      },
      cancel: {
        label: '<span class="glyphicon glyphicon-remove"></span> No',
        className: 'btn-danger'
      }
    },
    callback: function (result) {
      if(result==true){
        var data_send = {id:id};
        var datas = JSON.stringify(data_send);
        $.ajax({
          url: MAIN_URL+"pages/tahunakademik/tahunakademikdelete.php",
          type : "POST",
          contentType : 'application/json',
          data : datas,
          success : function(result){
            bootbox.alert("Hapus data berhasil",function(){
              window.location.replace(MAIN_URL+"tahunakademik");
            });
          },
          error: function(xhr, resp, text){
            bootbox.alert("Hapus data gagal");
          }
        });
      }
    }
  });
  return false;
});

});
