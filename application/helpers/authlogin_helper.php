<?php

function admin(){

	if (isset($_SESSION['role']) != 'admin') {
		echo '<script language="javascript">alert("Anda Harus Login"); window.location.href="'. base_url('login') .'";</script>';
	}
}

function ketua(){
	if (isset($_SESSION['role']) != 'ketua') {
		echo '<script language="javascript">alert("Anda Harus Login"); window.location.href="'. base_url('login') .'";</script>';
	}
}

// this function for avoid 'anggota' back to session
function anggota(){
	if (isset($_SESSION['role']) != 'anggota') {
		echo '<script language="javascript">alert("Anda Harus Login1"); window.location.href="'. base_url('login') .'";</script>';
	}
}

function angka_pembulatan($angka,$digit,$minimal){

	 $digitvalue=substr($angka,-($digit));  $bulat=0;
	 $nolnol="";
	 for($i=1;$i<=$digit;$i++){
	 	$nolnol.="0";
	 }

	 if($digitvalue<$minimal && $digit!=$nolnol){
	 	$x1=$minimal-$digitvalue;
	 	$bulat=$angka+$x1;
	 }
	 else{
	 	$bulat=$angka;
	 }
	 return $bulat; 
}

function rupiah($angka){

	if ($angka < 0) {
		$result = preg_replace("/[^0-9]/", "", $angka);
		$rupiah = number_format($result,2,',','.');
		$hasil = "<div style='height: 100%;text-align: right;'>(Rp ".$rupiah.")</div>";
	} 
	else {
		$rupiah = number_format($angka,2,',','.');
		$hasil = "<div style='height: 100%;text-align:right;'>Rp ".$rupiah."</div>";
	}
	return $hasil;
}

function rupiah2($angka){

	if ($angka < 0) {
		$result = preg_replace("/[^0-9]/", "", $angka);
		$rupiah = number_format($result,2,',','.');
		$hasil = 'Rp '.$rupiah;
	} 
	else {
		$rupiah = number_format($angka,2,',','.');
		$hasil = 'Rp '.$rupiah;
	}
	return $hasil;
}

function rupiah_cetak($angka){

	if ($angka < 0) {
		$result = preg_replace("/[^0-9]/", "", $angka);
		$rupiah = number_format($result,2,',','.');
		$hasil = "<div class='rata-kanan'>(Rp ".$rupiah.")</div>";
	}
	else {
		$rupiah = number_format($angka,2,',','.');
		$hasil = "<div class='rata-kanan'>Rp ".$rupiah."</div>";
	}
	return $hasil;
}

?>