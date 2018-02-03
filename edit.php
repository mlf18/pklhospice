<?php
	require_once('config/db_login.php');
	if(!$_POST){
	$id=$_GET['id'];
	$sql="select * from produk where id='$id'";
	$result=$db->query($sql);
	if(!$result){
		die("Could not query the database: </br>".$db->error);
	}	
	while($row=$result->fetch_object()){
		$id=$row->id;
		$judul=$row->nama;
		$deskripsi=$row->deskripsi;
		$gambar=$row->gambar;
		echo $gambar;
	}}
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<table>
<form method="post" autocomplete="on" action="post.php?act=edit" enctype='multipart/form-data'>
<input type="hidden" name="id" id="id" value="<?php echo $id;?>">
<tr>
	<td>Judul</td>
	<td>:</td>
	<td><input type="text" name="judul" id="judul" value="<?php echo $judul; ?>"></td>
</tr>
<tr>
	<td>Deskripsi</td>
	<td>:</td>
	<td><textarea name="deskripsi" id="deskripsi" rows="6" cols="50"><?php echo $deskripsi;?></textarea></td>
</tr>
<tr>
	<td>Gambar</td>
	<td>:</td>
	<td><img src="images/small_<?php echo $gambar;?>" alt=""></td>
</tr>
<tr>
	<td>Gambar</td>
	<td>:</td>
	<td><input type="file" name="fupload" id="fupload"></td>
</tr>
<tr>
	<td colspan="2" rowspan='2'><input type="submit"></td>
</tr>
</form>
</table>
</body>
