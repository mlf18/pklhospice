<?php
include('config/db_login.php');
$ip=$_SERVER['REMOTE_ADDR'];
$tanggal= date("ymd");
$sql="select * from statistik where ip='$ip' and tanggal=$tanggal";
$result=$db->query($sql);
if(!$result){
		die("Could not query the database: </br>".$db->error);
	}
if($result->num_rows == 0){
	$sql_insert="insert into statistik(id,ip,tanggal,hits,online) values ('','$ip','$tanggal','1',now())";
	$result=$db->query($sql_insert);
if(!$result){
		die("Could not query the database: </br>".$db->error);
	}	
}else{
	while($row=$result->fetch_object()){
	$hits=$row->hits;
	}
	$sql_update="update statistik set hits=$hits+1,tanggal=$tanggal,online=now() where ip='$ip'";
	$result=$db->query($sql_update);
	if(!$result){
		die("Could not query the database: </br>".$db->error);
	}
}
?>