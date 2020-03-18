$(function () {

  generateJam();


  $('.timepicker').bootstrapMaterialDatePicker({
    format: 'HH:mm',
    clearButton: true,
    date: false
  });


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

function generateJam(){

  var jamSelector = '#id_jam';
  var jenis_kelas = $("input[name='jenis_kelas']:checked").val();
  var data_send = {jenis_kelas:jenis_kelas};
  var datas = JSON.stringify(data_send);



  $.ajax({
    url: MAIN_URL+"pages/jadwal/jadwalpilihjam.php",
    type : "POST",
    contentType : 'application/json',
    data : datas,
    success : function(result){
      console.log(jenis_kelas);
      $(jamSelector).html(result);
      // x=[];
      // $(jamSelector).empty();
      // $.each(result.records, function(i,n) {x.push(n);});
      // $.each(x, function (id, entry) {
      //   $(jamSelector).append($("<option></option>").val(entry.id).html(entry.jam_mulai+" - "+entry.jam_selesai));
      // });
      $(jamSelector).selectpicker('refresh');
      $(jamSelector).selectpicker('render');
    },
    error: function(xhr, resp, text){
      bootbox.alert("Ambil data gagal");
    }
  });

  cekHari();
  return false;
}

function cekHari(){
  var jenis_kelas = $("input[name='jenis_kelas']:checked").val();
  if(jenis_kelas=="NON REG"){
    $(".reg").attr('checked', false);
    $(".reg").attr('disabled', true);
    $(".reg").css('opacity', '.2');
    $(".nonreg").prop('checked', true);
    $(".nonreg").attr('disabled', false);
    $(".nonreg").css('opacity', '.1');

  }else{
    $(".nonreg").attr('checked', false);
    $(".nonreg").attr('disabled', true);
    $(".nonreg").css('opacity', '.2');
    $(".reg").attr('disabled', false);
    $(".reg").css('opacity', '.1');
  }
}


function cekJam(){
  // var jamSelector = '#jam';
  var jam = $("input[name='jam']:selected").val();

  $("#time1").val(jam);
  $("#time2").val(jam);
}

function generateMatakuliah(){
  var kelas = document.getElementById('id_kelas');
  var opt = kelas.options[kelas.selectedIndex];
  var matakuliahSelector = '#id_matakuliah';
  var semester = opt.text.substr(4,1);
  var id_kelas = opt.value;

  var id_programstudi = document.getElementById('id_programstudi').value

  var data_send = {semester:semester,id_programstudi:id_programstudi,id_kelas:id_kelas};
  var datas = JSON.stringify(data_send);



  $.ajax({
    url: MAIN_URL+"pages/jadwal/jadwalpilihmatakuliah.php",
    type : "POST",
    contentType : 'application/json',
    data : datas,
    success : function(result){
      $(matakuliahSelector).html(result);
      $(matakuliahSelector).selectpicker('refresh');
      $(matakuliahSelector).selectpicker('render');
    },
    error: function(xhr, resp, text){
      bootbox.alert("Ambil data gagal");
    }
  });

  return false;
}
