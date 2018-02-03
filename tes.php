<!DOCTYPE html>
<html>
<head>
</head>
<body>
<table>
<form method="post" autocomplete="on" action="post.php?act=tambah" enctype='multipart/form-data'>
<tr>
	<td>id</td>
	<td>:</td>
	<td><input type="text" name="id" id="id"></td>
</tr>
<tr>
	<td>Judul</td>
	<td>:</td>
	<td><input type="text" name="judul" id="judul"></td>
</tr>
<tr>
	<td>Deskripsi</td>
	<td>:</td>
	<td><textarea name="deskripsi" id="deskripsi" rows="6" cols="50"></textarea></td>
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
