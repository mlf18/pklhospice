<?php
require_once('db_login.php');
	$tampil=$_POST['tampil'];
	$id=$_POST['ida'];
	$sql="update testimoni set tampil=$tampil where id=$id";
	$result=$db->query($sql);
	if(!$result){
		die("Could not query the database: </br>".$db->error);
	}
?>
