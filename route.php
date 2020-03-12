<?php
// include "libs/library.php";
$nopage = "<meta http-equiv='refresh' content='1; url=404.php'> ";
if(isset($_GET['p'])){
		$page = $_GET['p'];
		switch ($page) {
			 case '' :
      	echo "<meta http-equiv='refresh' content='1; url=sign-in.php'> ";
				break;
			case 'home':
				include "pages/home.php";
				break;
			case 'test':
				include "pages/test.php";
				break;
			case 'programstudi':
				include "pages/programstudi/programstudiread.php";
				break;
			case 'programstudicreate':
				include "pages/programstudi/programstudicreate.php";
				break;
			case 'programstudiupdate':
				include "pages/programstudi/programstudiupdate.php";
				break;
			case 'tahunakademik':
				include "pages/tahunakademik/tahunakademikread.php";
				break;
			case 'tahunakademikcreate':
				include "pages/tahunakademik/tahunakademikcreate.php";
				break;
			case 'tahunakademikupdate':
				include "pages/tahunakademik/tahunakademikupdate.php";
				break;
			case 'matakuliah':
				include "pages/matakuliah/matakuliahread.php";
				break;
			case 'matakuliahcreate':
				include "pages/matakuliah/matakuliahcreate.php";
				break;
			case 'matakuliahupdate':
				include "pages/matakuliah/matakuliahupdate.php";
				break;
			case 'dosen':
				include "pages/dosen/dosenread.php";
				break;
			case 'dosencreate':
				include "pages/dosen/dosencreate.php";
				break;
			case 'dosenupdate':
				include "pages/dosen/dosenupdate.php";
				break;
			case 'kelas':
				include "pages/kelas/kelasread.php";
				break;
			case 'kelascreate':
				include "pages/kelas/kelascreate.php";
				break;
			case 'kelasupdate':
				include "pages/kelas/kelasupdate.php";
				break;
			case 'jadwal':
				include "pages/jadwal/jadwalread.php";
				break;
			case 'jadwalcreate':
				include "pages/jadwal/jadwalcreate.php";
				break;
			case 'jadwalupdate':
				include "pages/jadwal/jadwalupdate.php";
				break;
			case 'jadwalpilih':
				include "pages/jadwal/jadwalpilih.php";
				break;

				//end Admin

			default:
				echo $nopage;
				break;
		}
	}else{
		include "pages/home.php";
	}
?>
