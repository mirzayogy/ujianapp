$(function () {
  generateKelas();
});

function addRow(opsi,hari,jam,matakuliah,pengajar)
{
  if (!document.getElementsByTagName) return;
  tabBody=document.getElementsByTagName("tbody").item(0);
  row=document.createElement("tr");
  cell1 = document.createElement("td");
  cell2 = document.createElement("td");
  cell3 = document.createElement("td");
  cell4 = document.createElement("td");
  // cell5 = document.createElement("td");
  textnode1=document.createTextNode(opsi);
  textnode1=document.createTextNode(hari);
  textnode2=document.createTextNode(jam);
  textnode3=document.createTextNode(matakuliah);
  textnode4=document.createTextNode(pengajar);
  cell1.appendChild(textnode1);
  cell2.appendChild(textnode2);
  cell3.appendChild(textnode3);
  cell4.appendChild(textnode4);
  // cell5.appendChild(textnode5);
  row.appendChild(cell1);
  row.appendChild(cell2);
  row.appendChild(cell3);
  row.appendChild(cell4);
  // row.appendChild(cell5);
  tabBody.appendChild(row);
}

function generateTable(){
  var id_kelas = document.getElementById('id_kelas').value;
  var data_send = {id_kelas:id_kelas};
  var datas = JSON.stringify(data_send);

  var table1 = document.getElementById('js-basic-example');

  // while(table1.rows.length > 0) {
  //   table1.deleteRow(0);
  // }
   $("#js-basic-example").find("tbody").empty();
  $.ajax({
    url: MAIN_URL+"pages/jadwal/jadwaltampilkuliahperkelas.php",
    type : "POST",
    contentType : 'application/json',
    data : datas,
    success : function(result){
      // console.log(result);
      // x=[];
      // $(jamSelector).empty();
      $.each(result.records, function(i,n) {
        addRow(n.id,n.hari,n.jam_mulai,n.singkatan_mata_kuliah,n.singkatan_pengajar);
      });
      // $.each(x, function (id, entry) {
      //   $(jamSelector).append($("<option></option>").val(entry.id).html(entry.jam_mulai+" - "+entry.jam_selesai));
      // });
    },
    error: function(xhr, resp, text){
      bootbox.alert("Ambil data gagal");
    }
  });
}

function generateKelas(){

  var matakuliahSelector = '#id_kelas';

  var jenis_kelas = $("input[name='jenis_kelas']:checked").val();
  var id_programstudi = document.getElementById('id_programstudi').value
  var id_tahunakademik = document.getElementById('id_tahunakademik').value

  var data_send = {jenis_kelas:jenis_kelas,id_programstudi:id_programstudi,id_tahunakademik:id_tahunakademik};
  var datas = JSON.stringify(data_send);


  $.ajax({
    url: MAIN_URL+"pages/jadwal/jadwalpilihkelas.php",
    type : "POST",
    contentType : 'application/json',
    data : datas,
    success : function(result){
      $(matakuliahSelector).html(result);
      $(matakuliahSelector).selectpicker('refresh');
      $(matakuliahSelector).selectpicker('render');
      generateTable();
    },
    error: function(xhr, resp, text){
      bootbox.alert("Ambil data gagal");
    }
  });

  return false;
}
