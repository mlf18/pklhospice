<?php
	//File 	: db_login.php
//Deskripsi	: menyimpan parameter untuk koneksi ke database

$db_host='localhost';
$db_database='db_laderma';
$db_username='root';
$db_password='';
$db = new mysqli($db_host, $db_username, $db_password, $db_database);
	if($db->connect_errno){
		die("Could not connect to the database : <br/>".$db->error);
	}
?>