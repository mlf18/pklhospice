<?php
	require_once('../../config/db_login.php');
	$aksi=$_GET['aks'];
	if($aksi=='poost'){
	$id=test_input($_POST['idt']);
	$keluhan=test_input($_POST['keluhan']);
	$sql="INSERT INTO `post` (`idpost`, `idthread`, `isipost`,`user`,`tgl_post`) VALUES (NULL, '$id', '$keluhan','User',now ())";
	$result=$db->query($sql);
	header('location:balas.php?idt='.$id);
	}
	elseif($aksi=='tambah'){
	$klinik=test_input($_POST['cabang']);
	$dokter=test_input($_POST['dokter']);
	$tipe=test_input($_POST['tipe']);
	$judul=test_input($_POST['judul']);
	$keluhan=test_input($_POST['keluhan']);
	$email=test_input($_POST['email']);
	$sql="INSERT INTO `thread` (`idcabang`, `iddokter`, `tipe`, `judul`,`tgl_thread`) VALUES ('$klinik', '$dokter', '$tipe', '$judul',now())";
	$result = $db->query( $sql);
	$sql="select idthread from thread";
	$result = $db->query( $sql);
	$no=$result->num_rows;
	echo $no.' '.$keluhan;
	$sql = "INSERT INTO `post` (`idthread`, `isipost`,`email`,`user`,`tgl_post`) VALUES ('$no', '$keluhan','$email','User',now())";
	$result = $db->query( $sql);
	header('location:../../index.php?modul=4');}
function test_input($data)
{
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>