<?php
	function pilihdok($nama){
		global $db;
		echo "<select id='$nama' name='$nama'>
		<option value=''>----</option>";
		$sql="select * from $nama";
		$result=$db->query($sql);
		if (!$result){
		   die ("Could not query the database: <br />". $db->error);
		}
		while($row=$result->fetch_object()){
			echo "<option value='$row->iddokter'>$row->nama</option>";
		}
		echo"</select>";
	}
	function pilihkli($nama){
		global $db;
		echo "<select id='$nama' name='$nama'>
		<option value=''>----</option>";
		$sql="select * from $nama";
		$result=$db->query($sql);
		if (!$result){
		   die ("Could not query the database: <br />". $db->error);
		}
		while($row=$result->fetch_object()){
			echo "<option value='$row->idcabang'>$row->lokasi</option>";
		}
		echo"</select>";
	}
?>