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
			case 'crawler':
				include "pages/crawler.php";
				break;
			case 'form':
				include "pages/form.php";
				break;
			case 'card':
				include "pages/card.php";
				break;
			case 'faq':
				include "pages/faq.php";
				break;
			case 'kartu':
				include "pages/kartudua.php";
				break;
			case 'identitas':
				include "pages/identitas.php";
				break;
			case 'kepegawaian':
				include "pages/kepegawaian.php";
				break;
			case 'datapt':
				include "pages/datapt.php";
				break;
			case 'inpassing':
				include "pages/inpassing.php";
				break;
			case 'jabatanfungsional':
				include "pages/jab_fung.php";
				break;
			case 'pangkatgolongan':
				include "pages/pang_gol.php";
				break;
			case 'penempatan':
				include "pages/penempatan.php";
				break;
			case 'pendidikan':
				include "pages/pendidikan/pendidikan_view.php";
				break;
			case 'pelaksanaanpendidikan':
				include "pages/pelaksanaan_pendidikan/pelaksanaan_pendidikan_view.php";
				break;
			case 'pengabdian':
				include "pages/pengabdian/pengabdian_view.php";
				break;
			case 'penunjang':
				include "pages/penunjang/penunjang_view.php";
				break;
			case 'diklat':
				include "pages/diklat.php";
				break;
			case 'sertifikasi':
				include "pages/sertifikasi.php";
				break;
			case 'pengajaran':
				include "pages/pengajaran.php";
				break;
			case 'bimbinganmahasiswa':
				include "pages/bim_mhs.php";
				break;
			case 'usulanbkd':
				include "pages/usulan_bkd/usulan_bkd_view.php";
				break;
			case 'klaimbkd':
				include "pages/usulan_bkd/klaimbkd.php";
				break;
			case 'kirimbkd':
				include "pages/usulan_bkd/kirimbkd.php";
				break;
			case 'lihatbkd':
				include "pages/usulan_bkd/lihatbkd.php";
				break;
			case 'klaimbkdpenelitian':
				include "pages/usulan_bkd/klaimbkd_penelitian.php";
				break;
			case 'klaimbkdpenelitiandel':
				include "pages/usulan_bkd/klaimbkd_penelitian_del.php";
				break;
			case 'klaimbkdpenelitiandetail':
				include "pages/usulan_bkd/klaimbkd_penelitian_detail.php";
				break;
			case 'klaimbkdpengabdian':
				include "pages/usulan_bkd/klaimbkd_pengabdian.php";
				break;
			case 'klaimbkdpengabdiandel':
				include "pages/usulan_bkd/klaimbkd_pengabdian_del.php";
				break;
			case 'klaimbkdpengabdiandetail':
				include "pages/usulan_bkd/klaimbkd_pengabdian_detail.php";
				break;
			case 'klaimbkdpenunjang':
				include "pages/usulan_bkd/klaimbkd_penunjang.php";
				break;
			case 'klaimbkdkhususdel':
				include "pages/usulan_bkd/klaimbkd_khusus_del.php";
				break;
			case 'klaimbkdkhususdetail':
				include "pages/usulan_bkd/klaimbkd_khusus_detail.php";
				break;
			case 'klaimbkdkhusus':
				include "pages/usulan_bkd/klaimbkd_khusus.php";
				break;
			case 'klaimbkdpenunjangdel':
				include "pages/usulan_bkd/klaimbkd_penunjang_del.php";
				break;
			case 'klaimbkdpenunjangdetail':
				include "pages/usulan_bkd/klaimbkd_penunjang_detail.php";
				break;
			case 'klaimbkdpelaksanaanpendidikan':
				include "pages/usulan_bkd/klaimbkd_pelaksanaan_pendidikan.php";
				break;
			case 'klaimbkdpelaksanaanpendidikandel':
				include "pages/usulan_bkd/klaimbkd_pelaksanaan_pendidikan_del.php";
				break;
			case 'klaimbkdpelaksanaanpendidikandetail':
				include "pages/usulan_bkd/klaimbkd_pelaksanaan_pendidikan_detail.php";
				break;
			case 'penelitian':
				include "pages/penelitian/penelitian_view.php";
				break;
			case 'penelitiancreate':
				include "pages/penelitian/penelitian_add.php";
				break;
			case 'penelitiandelete':
				include "pages/penelitian/penelitian_delete.php";
				break;
			case 'pesandosen':
				include "pages/sabar.php";
				break;
				//oppt
			case 'ptdatapt':
				include "pages/oppt/ptdatapt.php";
				break;
			case 'ptsptjm':
				include "pages/oppt/ptsptjm.php";
				break;
			case 'ptsptjmadd':
				include "pages/oppt/ptsptjmadd.php";
				break;
			case 'ptsptjmedit':
				include "pages/oppt/ptsptjmedit.php";
				break;
			case 'ptsptjmkirim':
				include "pages/oppt/ptsptjmkirim.php";
				break;
			case 'ptsptjmlihat':
				include "pages/oppt/ptsptjmlihat.php";
				break;
			case 'ptverifdosen':
				include "pages/oppt/ptverifdosen.php";
				break;
			case 'ptrbkd':
				include "pages/oppt/ptrbkd.php";
				break;
			case 'ptkinerjadosen':
				include "pages/oppt/ptkinerjadosen.php";
				break;
			case 'ptkinerjadosenperiode':
				include "pages/oppt/ptkinerjadosenperiode.php";
				break;
			case 'ptkinerjadosenperiodedet':
				include "pages/oppt/ptkinerjadosenperiodedet.php";
				break;
			case 'ptkinerjadosendet':
				include "pages/oppt/ptkinerjadosendet.php";
				break;
			case 'ptkinerjadosenview':
				include "pages/oppt/ptkinerjadosenview.php";
				break;
			case 'ptlapdosen':
				include "pages/oppt/ptlapdosen.php";
				break;
			case 'ptlapdosenold':
				include "pages/oppt/ptlapdosenold.php";
				break;
			case 'ptrekapsptjm':
				include "pages/oppt/ptrekapsptjm.php";
				break;
				//end oppt
				//verifikator
			case 'vflapkinerja':
				include "pages/vf/vflapkinerja.php";
				break;
			case 'vflapkinerjadosen':
				include "pages/vf/vflapkinerjadosen.php";
				break;
			case 'vflapkinerjadosendet':
				include "pages/vf/vflapkinerjadosendet.php";
				break;
			case 'vfrevisilkd':
				include "pages/vf/vfrevisilkd.php";
				break;
			case 'vflapkerja':
				include "pages/vf/vflapkerja.php";
				break;
				//end verifikator
				//Guest
			case 'guestlapkinerja':
				include "pages/guest/guestlapkinerja.php";
				break;
			case 'guestlapdosen':
				include "pages/guest/guestlapdosen.php";
				break;
				//end Guest
				//admin start
			case 'admlapptserdos':
				include "pages/adm/admlapptserdos.php";
				break;
			case 'admlapdospt':
				include "pages/adm/admlapdospt.php";
				break;
			case 'admlapkinerjadet':
				include "pages/adm/admlapkinerjadet.php";
				break;
			case 'admlapkinerjadetmore':
				include "pages/adm/admlapkinerjadetmore.php";
				break;
			case 'admlapkinerja':
				include "pages/adm/admlapkinerja.php";
				break;
			case 'admlapsptjm':
				include "pages/adm/admlapsptjm.php";
				break;
			case 'admlapsptjmdet':
				include "pages/adm/admlapsptjmdet.php";
				break;
			case 'admrekapsertifikasi':
				include "pages/adm/admrekapsertifikasi.php";
				break;
			case 'admrekappt':
				include "pages/adm/admrekappt.php";
				break;
			case 'admrekapptdosenm':
				include "pages/adm/admrekapptdosenm.php";
				break;
			case 'admrekapptdosentm':
				include "pages/adm/admrekapptdosentm.php";
				break;
			case 'admrekapbulan':
				include "pages/adm/admrekapbulan.php";
				break;
			case 'admrekapdoscair':
				include "pages/adm/admrekapdoscair.php";
				break;
			case 'admrekapdostun':
				include "pages/adm/admrekapdostun.php";
				break;
			case 'admrekaptahun':
				include "pages/adm/admrekaptahun.php";
				break;
			case 'admperiodesptjm':
				include "pages/adm/admperiodesptjm.php";
				break;
			case 'admperiodesptjmadd':
				include "pages/adm/admperiodesptjmadd.php";
				break;
			case 'admperiodesptjmedit':
				include "pages/adm/admperiodesptjmedit.php";
				break;
			case 'admperiodebkd':
				include "pages/adm/admperiodebkd.php";
				break;
			case 'admperiodebkdadd':
				include "pages/adm/admperiodebkdadd.php";
				break;
			case 'admperiodebkdedit':
				include "pages/adm/admperiodebkdedit.php";
				break;
			case 'admsinkronisasi':
				include "pages/adm/admsinkronisasi.php";
				break;
			case 'admsinkronisasiprov':
				include "pages/adm/admsinkronisasiprov.php";
				break;
			case 'admverifikator':
				include "pages/adm/admverifikator.php";
				break;
			case 'admveriprofil':
				include "pages/adm/admveriprofil.php";
				break;
			case 'admverirbkd':
				include "pages/adm/admverirbkd.php";
				break;
			case 'admverikinerja':
				include "pages/adm/admverikinerja.php";
				break;
			case 'admverikinerjaperiode':
				include "pages/adm/admverikinerjaperiode.php";
				break;
			case 'admverikinerjaperiodeprov':
				include "pages/adm/admverikinerjaperiodeprov.php";
				break;
			case 'admverikinerjaperiodeprovdosen':
				include "pages/adm/admverikinerjaperiodeprovdosen.php";
				break;
			case 'admverikinerjaperiodeprovdosendet':
				include "pages/adm/admverikinerjaperiodeprovdosendet.php";
				break;
			case 'admverikinerjaprov':
				include "pages/adm/admverikinerjaprov.php";
				break;
			case 'admverikinerjaprovperiode':
				include "pages/adm/admverikinerjaprovperiode.php";
				break;
			case 'admverikinerjaprovperiodestatus':
				include "pages/adm/admverikinerjaprovperiodestatus.php";
				break;
			case 'admverikinerjapt':
				include "pages/adm/admverikinerjapt.php";
				break;
			case 'admverikinerjadet':
				include "pages/adm/admverikinerjadet.php";
				break;
			case 'admverisptjmtahun':
				include "pages/adm/admverisptjmtahun.php";
				break;
			case 'admverisptjm':
				include "pages/adm/admverisptjm.php";
				break;
			case 'admverisptjmpt':
				include "pages/adm/admverisptjmpt.php";
				break;
			case 'admverisptjmdet':
				include "pages/adm/admverisptjmdet.php";
				break;
			case 'admverisptjmperiode':
				include "pages/adm/admverisptjmperiode.php";
				break;
			case 'admverisptjmprovbulan':
				include "pages/adm/admverisptjmprovbulan.php";
				break;
			case 'admdataverifikator':
				include "pages/adm/verifikator/controller.php";
				break;
			case 'admpenugasan':
				include "pages/adm/admpenugasan.php";
				break;
			case 'admpenugasanverifikator':
				include "pages/adm/admpenugasanverifikator.php";
				break;
			case 'admpilihverifikator':
				include "pages/adm/admpilihverifikator.php";
				break;
			case 'dosenptkol':
				include "pages/adm/dosenptkol.php";
				break;
			case 'cetaksptjm':
				include "pages/adm/cetaksptjmfilter.php";
				break;
			case 'cetakpencairan':
				include "pages/adm/cetakrekappencairan.php";
				break;
			case 'caridosen':
				include "pages/adm/caridosen.php";
				break;
			case 'dosenportal':
				include "pages/adm/dosenportal.php";
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
