<?php
session_start();
if(!isset($_SESSION['ip_user'])){
	$_SESSION['ip_user']=filter_var($_SERVER['REMOTE_ADDR'],FILTER_VALIDATE_IP);
	$open = fopen("lumino2/hits.txt", "r+");
	$value = fgets($open);
	$close = fclose($open);
	$value++;
	$open = fopen("lumino2/hits.txt", "w+");
	fwrite($open,$value);
}else{
	
}


?>