<script type="text/javascript">
	function konfirmasi(){
		var pilihan = confirm("Apakah Anda yakin untuk menghapus data ini ?");		
		if(pilihan){
			return true;
		}else{
			return false;
		}
	}
</script>
<?php 
function tambah_fitur(){
	global $db;
	?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Fitur</li>
			</ol>
		</div><!--/.row-->
	<?php 
	if($_POST){
	$sql="SELECT id FROM fitur";
	$result=$db->query($sql);
	if(!$result){
		die("Could not query the database: </br>".$db->error);
	}
	if($result->num_rows > 0){
	while($row=$result->fetch_object()){
		$id=$row->id;
	}
	}else{
		$id=0;
	}
	$id=$id+1;
	$nama=test_input($_POST['nama']);
	$deskripsi=strip_tags($_POST['deskripsi']);
	if(isset($_FILES['fupload'])){
	if ($_FILES['fupload']['error'] > 0)
{
	echo 'Problem: ';
	switch ($_FILES['fupload']['error'])
	{
		case 1:  echo 'File exceeded upload_max_filesize';
				echo '<p><a href="index.php?modul=12&aksi=tambah">Kembali</a></p>';
				break;
		case 2:  echo 'File exceeded max_file_size';
				echo '<p><a href="index.php?modul=12&aksi=tambah">Kembali</a></p>';
				break;
		case 3:  echo 'File only partially uploaded';
				echo '<p><a href="index.php?modul=12&aksi=tambah">Kembali</a></p>';
				break;
		case 4:  echo 'No file uploaded';
				echo '<p><a href="index.php?modul=12&aksi=tambah">Kembali</a></p>';
				break;
		case 6:  echo 'Cannot upload file: No temp directory specified';
				echo '<p><a href="index.php?modul=12&aksi=tambah">Kembali</a></p>';
				break;
		case 7:  echo 'Upload failed: Cannot write to disk';
				echo '<p><a href="index.php?modul=12&aksi=tambah">Kembali</a></p>';
				break;
	}
	exit;
}
//direktori gambar
  $vdir_upload = "../images/";
  $fupload_name='fitur'.$id;
  $vfile_upload = $vdir_upload . $fupload_name;
  $imageType = $_FILES["fupload"]["type"];

  //Simpan gambar dalam ukuran sebenarnya
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);

  //identitas file asli
  switch($imageType) {
		case "image/gif":
			$im_src=imagecreatefromgif($vfile_upload); 
			break;
	    case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
			$im_src=imagecreatefromjpeg($vfile_upload); 
			break;
	    case "image/png":
		case "image/x-png":
			$im_src=imagecreatefrompng($vfile_upload); 
			break;
  }
  
  $src_width = imageSX($im_src);
  $src_height = imageSY($im_src);

  //Simpan dalam versi besar 400 pixel
  //Set ukuran gambar hasil perubahan
  $dst_width = 64;
  $dst_height = 64;

  //proses perubahan ukuran
  $im = imagecreatetruecolor($dst_width,$dst_height);
  imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);
   
  //Simpan gambar
  switch($imageType) {
		case "image/gif":
  			imagegif($im,$vdir_upload.$fupload_name.'.gif');
			$ima=$fupload_name.'.gif';
			break;
	    case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
  			imagejpeg($im,$vdir_upload.$fupload_name.'.jpg');
			$ima=$fupload_name.'.jpg';
			break;
	    case "image/png":
		case "image/x-png":
  			imagepng($im,$vdir_upload.$fupload_name.'.png');
			$ima=$fupload_name.'.png';
			break;
  }

  //Hapus gambar di memori komputer
  imagedestroy($im_src);
  imagedestroy($im);
  unlink($vfile_upload);
	}
	$sql="INSERT INTO `fitur` (`id`, `nama`,`deskripsi`,`gambar`) VALUES ('$id', '$nama','$deskripsi','$ima')";
	$result=$db->query($sql);
	echo'
	<div class="row">
			<div class="col-lg-12">';
	if(!$result){
		echo'
		<div class="alert bg-danger" role="alert">
			<svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg><a href="index.php?modul=12&aksi=tambah"> Terjadi Kesalahan !</a> <a href="">Coba lagi</a> <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
		</div>';
		die("Could not query the database: </br>".$db->error);
	}else{
	$sql="SELECT idcontent FROM content";
	$result=$db->query($sql);
	if(!$result){
		die("Could not query the database: </br>".$db->error);
	}
	if($result->num_rows > 0){
		while($row=$result->fetch_object()){
			$idc=$row->idcontent+1;
		}
	}else{
		$idc=1;
	}
	$sql="INSERT INTO `content` (`idcontent`, `idartikel`, `idcabang`, `idcareer`, `idevent_promo`, `idfitur`, `idgambar`, `idproduk`, `idsejarah`, `idstaff`, `idvideo`, `iduser`) VALUES ('$idc', NULL, NULL, NULL, NULL, '$id', NULL, NULL, NULL, NULL, NULL, '1')";
	$result=$db->query($sql);
	tambah_log($idc,"tambah",$nama);
	echo'
	<div class="alert bg-success" role="alert">
		<svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg><a href="index.php?modul=12"> Data Telah Ditambahkan </a><a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
	</div>';
	}
	echo'
	</div>
	</div>';
	}
?>	
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Fitur</h1>
			</div>
		</div><!--/.row-->
				
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Form</div>
					<div class="panel-body">
						<div class="col-md-8">
							<form role="form" action="" method="post" enctype='multipart/form-data'>		
								<div class="form-group">
									<label>Nama</label>
									<input class="form-control" name="nama" required>
								</div>
								<div class="form-group">
									<label>Deskripsi</label>
									<textarea id="deskripsi" class="form-control" name="deskripsi" rows="3" required></textarea>
								</div>
																
								<div class="form-group">
									<label>Gambar</label>
									<input type="file" name="fupload" required>
								</div>
								<button type="submit" class="btn btn-primary">Submit Button</button>
							</div>
						</form>
					</div>
				</div>
			</div><!-- /.col-->
		</div><!-- /.row -->
		
	</div><!--/.main-->
<?php } ?>
<?php 
function lihat_fitur() {
	global $db;
	$i=1;?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Icons</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Fitur</h1>
			</div>
		</div><!--/.row-->
				
		<?php 
		$sql= "SELECT id,nama,deskripsi FROM fitur";
		$result=$db->query($sql);
		?>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading"><a href = "index.php?modul=12&aksi=tambah" class="btn btn-primary"><svg class="glyph stroked plus sign"><use xlink:href="#stroked-plus-sign"/></svg> Tambah</a></div>
					<div class="panel-body">
						<table data-toggle="table" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="asc">
						    <thead>
						    <tr>
						        <th>No</th>
						        <th>Nama</th>
						        <th>Deskripsi</th>
						        <th>Aksi</th>
						    </tr>
						    </thead>
							<?php while($row=$result->fetch_object()){?>
							<tr>
							<td><?php echo $i;?></td>
							<td><?php echo $row->nama;?></td>
							<td>
							<?php
							if(strlen($row->deskripsi)>20){
								$isi = substr_replace($row->deskripsi,'.....',20);}
								else{
									$isi=$row->deskripsi;
								}
							echo $isi;
							?>
							</td>
							<td>
							<a class="btn btn-primary" href="index.php?modul=12&aksi=edit&id=<?php echo $row->id;?>">
							<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
							</a>
							&nbsp;
							<a class="btn btn-danger" href="index.php?modul=12&aksi=hapus&id=<?php echo $row->id;?>" onclick="return confirm('Apakah Anda yakin untuk menghapus data ini ?')">
							<i class="fa fa-trash-o" aria-hidden="true"></i>
							</a>
							</td>
							</tr>
							<?php $i++;}?>
						</table>
					</div>
				</div>
			</div>
		</div><!--/.row-->			
	</div><!--/.main-->	
<?php } ?>
<?php 
	function hapus_fitur($id){
	global $db;
	$sql="select nama,gambar from fitur where id= $id";
	$result=$db->query($sql);
	if(!$result){
		die("Could not query the database: </br>".$db->error);
	}
	while($row=$result->fetch_object()){
		$nama=$row->nama;
		unlink('../images/'.$row->gambar);
		unlink('../images/small_'.$row->gambar);
	}
	$sql="select idcontent FROM `content` WHERE `content`.`idevent_promo` = $id";
	$result=$db->query($sql);
	$idk=$result->idcontent;
	$sql="DELETE FROM `content` WHERE `content`.`idfitur` = $id";
	$result=$db->query($sql);
	$sql="DELETE FROM `fitur` WHERE `fitur`.`id` = $id";
	$result=$db->query($sql);
	if(!$result){
		die("Could not query the database: </br>".$db->error);
	}else{
		tambah_log($idc,"hapus",$nama);
	}
	} 
?>
<?php 
function edit_fitur($id){
	?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Fitur</li>
			</ol>
		</div><!--/.row-->
	<?php
	global $db;
	if($_POST){
	$id=$_POST['id'];
	$nama=test_input($_POST['nama']);
	$deskripsi=strip_tags($_POST['deskripsi']);
	if(isset($_FILES['fupload'])){
	if ($_FILES['fupload']['error'] > 0)
{
	echo 'Problem: ';
	switch ($_FILES['fupload']['error'])
	{
		case 1:  echo 'File exceeded upload_max_filesize';
				echo '<p><a href="index.php?modul=12&aksi=edit&id='.$id.'">Kembali</a></p>';
				break;
		case 2:  echo 'File exceeded max_file_size';
				echo '<p><a href="index.php?modul=12&aksi=edit&id='.$id.'">Kembali</a></p>';
				break;
		case 3:  echo 'File only partially uploaded';
				echo '<p><a href="index.php?modul=12&aksi=edit&id='.$id.'">Kembali</a></p>';
				break;
		case 4:  echo 'No file uploaded';
				echo '<p><a href="index.php?modul=12&aksi=edit&id='.$id.'">Kembali</a></p>';
				break;
		case 6:  echo 'Cannot upload file: No temp directory specified';
				echo '<p><a href="index.php?modul=12&aksi=edit&id='.$id.'">Kembali</a></p>';
				break;
		case 7:  echo 'Upload failed: Cannot write to disk';
				echo '<p><a href="index.php?modul=12&aksi=edit&id='.$id.'">Kembali</a></p>';
				break;
	}
	exit;
}
//direktori gambar
  $vdir_upload = "../images/";
  $fupload_name='fitur'.$id;
  $vfile_upload = $vdir_upload . $fupload_name;
  $imageType = $_FILES["fupload"]["type"];

  //Simpan gambar dalam ukuran sebenarnya
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);

  //identitas file asli
  switch($imageType) {
		case "image/gif":
			$im_src=imagecreatefromgif($vfile_upload); 
			break;
	    case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
			$im_src=imagecreatefromjpeg($vfile_upload); 
			break;
	    case "image/png":
		case "image/x-png":
			$im_src=imagecreatefrompng($vfile_upload); 
			break;
  }
  
  $src_width = imageSX($im_src);
  $src_height = imageSY($im_src);

  //Simpan dalam versi besar 400 pixel
  //Set ukuran gambar hasil perubahan
  $dst_width = 64;
  $dst_height = 64;

  //proses perubahan ukuran
  $im = imagecreatetruecolor($dst_width,$dst_height);
  imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);
   
  //Simpan gambar
  switch($imageType) {
		case "image/gif":
  			imagegif($im,$vdir_upload.$fupload_name.'.gif');
			$ima=$fupload_name.'.gif';
			break;
	    case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
  			imagejpeg($im,$vdir_upload.$fupload_name.'.jpg');
			$ima=$fupload_name.'.jpg';
			break;
	    case "image/png":
		case "image/x-png":
  			imagepng($im,$vdir_upload.$fupload_name.'.png');
			$ima=$fupload_name.'.png';
			break;
  }

  //Hapus gambar di memori komputer
  imagedestroy($im_src);
  imagedestroy($im);
  unlink($vfile_upload);
  }
	$sql="UPDATE `fitur` SET `nama` = '$nama',`deskripsi`='$deskripsi',`gambar`='$ima' WHERE `fitur`.`id` = '$id'";
	$result=$db->query($sql);
	echo'
	<div class="row">
			<div class="col-lg-12">';
	if(!$result){
		echo'
		<div class="alert bg-warning" role="alert">
					<a href="index.php?modul=12&aksi=edit&id='.$id.'">Terjadi Masalah Silahkan Coba Lagi</a> <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
		</div>';
		die("Could not query the database: </br>".$db->error);
	}
	else{
	echo'
		<div class="alert bg-success" role="alert">
			<svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg><a href="index.php?modul=12"> Data Telah Diubah </a><a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
		</div>';
	$sql="SELECT idcontent FROM `content` where idfitur = $id";
	$result=$db->query($sql);
	if(!$result){
	die("Could not query the database: </br>".$db->error);
	}
	$row=$result->fetch_object();
	tambah_log($row->idcontent,"edit",$nama);
	}
	echo'
	</div>
	</div>';
	}
	$sql_select= "SELECT * FROM fitur WHERE id='$id'";
	$q= $db->query($sql_select);
	if(!$q){
		die("Could not query the database: </br>".$db->error);
	}
	while($row=$q->fetch_object()){
		$id=$row->id;
		$nama=$row->nama;
		$deskripsi=$row->deskripsi;
		$gambar=$row->gambar;
	}
?>	
	<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Fitur</h1>
			</div>
		</div><!--/.row-->
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Form</div>
					<div class="panel-body">
						<div class="col-md-8">
							<form role="form" action="" method="post" enctype='multipart/form-data'>							
							<input type="hidden" name="id" value="<?php echo $id; ?>">
								<div class="form-group">
									<label>Nama</label>
									<input class="form-control" name="nama" value="<?php echo $nama;?>" required>
								</div>
								<div class="form-group">
									<label>Deskripsi</label>
									<textarea id="deskripsi" class="form-control" name="deskripsi" rows="3"><?php echo $deskripsi;?></textarea>
								</div>
								<div class="form-group">
									<label>Gambar</label><br/>
									<img src="../images/small_<?php echo $gambar;?>"/>
								</div>
								<div class="form-group">
									<label>Gambar</label>
									<input type="file" name="fupload">
								</div>
								<button type="submit" class="btn btn-primary">Submit</button>
							</div>
						</form>
					</div>
				</div>
			</div><!-- /.col-->
		</div><!-- /.row -->
		
	</div><!--/.main-->
<?php } 
function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
		if(empty($_GET['aksi'])){
			$aksi='';
		}else{
			$aksi=$_GET['aksi'];
		}
		if ($aksi==null){lihat_fitur();}
		else if ($aksi=='tambah'){tambah_fitur();}
		else if ($aksi=='edit'){edit_fitur($_GET['id']);}
		else if ($aksi=='hapus'){hapus_fitur($_GET['id']);lihat_fitur();}
?>