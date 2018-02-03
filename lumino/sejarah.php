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
function tambah_sejarah(){
	global $db;
	?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Sejarah</li>
			</ol>
		</div><!--/.row-->
	<?php 
	if($_POST){
	$sql="SELECT id FROM sejarah";
	$result=$db->query($sql);
	if(!$result){
		die("Could not query the database: </br>".$db->error);
	}
	if($result->num_rows > 0){
	while($row=$result->fetch_object()){
		$id=$row->id;
	}}else{$id=0;}
	$id=$id+1;
	$tahun=test_input($_POST['tahun']);
	$deskripsi=strip_tags($_POST['deskripsi']);
	if($_FILES['fupload']['error']!=4){
	if ($_FILES['fupload']['error'] > 0)
{
	echo 'Problem: ';
	switch ($_FILES['fupload']['error'])
	{
		case 1:  echo 'File exceeded upload_max_filesize';
				echo '<p><a href="index.php?modul=4&aksi=tambah">Kembali</a></p>';
				break;
		case 2:  echo 'File exceeded max_file_size';
				echo '<p><a href="index.php?modul=4&aksi=tambah">Kembali</a></p>';
				break;
		case 3:  echo 'File only partially uploaded';
				echo '<p><a href="index.php?modul=4&aksi=tambah">Kembali</a></p>';
				break;
		case 4:  echo 'No file uploaded';
				echo '<p><a href="index.php?modul=4&aksi=tambah">Kembali</a></p>';
				break;
		case 6:  echo 'Cannot upload file: No temp directory specified';
				echo '<p><a href="index.php?modul=4&aksi=tambah">Kembali</a></p>';
				break;
		case 7:  echo 'Upload failed: Cannot write to disk';
				echo '<p><a href="index.php?modul=4&aksi=tambah">Kembali</a></p>';
				break;
	}
	exit;
}
//direktori gambar
  $vdir_upload = "../images/";
  $fupload_name='sejarah'.$id;
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
  if($src_width>=640){
  $dst_width = 640;
  }
  $dst_height = ($dst_width/$src_width)*$src_height;

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
 
  //Simpan dalam versi small 200 pixel
  //Set ukuran gambar hasil perubahan

  $dst_width2 = 330;
  $dst_height2 = 250;

  //proses perubahan ukuran
  $im2 = imagecreatetruecolor($dst_width2,$dst_height2);
  imagecopyresampled($im2, $im_src, 0, 0, 0, 0, $dst_width2, $dst_height2, $src_width, $src_height);

  //Simpan gambar
  switch($imageType) {
		case "image/gif":
  			imagegif($im2,$vdir_upload . "small_" . $fupload_name.'.gif');
			break;
	    case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
  			imagejpeg($im2,$vdir_upload . "small_" . $fupload_name.'.jpg');
			break;
	    case "image/png":
		case "image/x-png":
  			imagepng($im2,$vdir_upload . "small_" . $fupload_name.'.png');
			break;
  }
  
  //Hapus gambar di memori komputer
  imagedestroy($im_src);
  imagedestroy($im);
  unlink($vfile_upload);
  imagedestroy($im2);
  }else{
	  $ima="";
  }
	$sql="INSERT INTO `sejarah` (`id`, `tahun`, `deskripsi`, `gambar`) VALUES ('$id', '$tahun', '$deskripsi', '$ima')";
	$result=$db->query($sql);
	echo'
	<div class="row">
			<div class="col-lg-12">';
	if(!$result){
		echo'
		<div class="alert bg-warning" role="alert">
					<a href="index.php?modul=4&aksi=tambah">Terjadi Masalah Silahkan Coba Lagi</a> <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
		</div>';
		die("Could not query the database: </br>".$db->error);
	}
	else{
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
	$sql="INSERT INTO `content` (`idcontent`, `idartikel`, `idcabang`, `idcareer`, `idevent_promo`, `idfitur`, `idgambar`, `idproduk`, `idsejarah`, `idstaff`, `idvideo`, `iduser`) VALUES ('$idc', NULL, NULL, NULL, NULL, NULL, NULL, '$id', NULL, NULL, NULL, '1')";
	$result=$db->query($sql);
	$tahun="$tahun";
	tambah_log($idc,"tambah",$tahun);
	echo'
		<div class="alert bg-success" role="alert">
			<svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg><a href="index.php?modul=4"> Data Telah Diubah</a> <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
		</div>';
	}
	echo'
	</div>
	</div>';
	}
?>	
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Sejarah</h1>
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
									<label>Kategori</label>
									<select class="form-control" name="tahun" required>
										<?php 
										$thn=2000;
										while($thn<=date("Y")){
											echo "<option value='$thn'>$thn</option>";
											$thn++;
										}
										?>
									</select>
								</div>
								
								<div class="form-group">
									<label>Deskripsi</label>
									<textarea id="deskripsi" class="form-control" name="deskripsi" rows="3" required></textarea>
								</div>
								<div class="form-group">
									<label>Gambar</label>
									<input type="file" name="fupload">
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
function lihat_sejarah() {
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
				<h1 class="page-header">Sejarah</h1>
			</div>
		</div><!--/.row-->
				
		<?php 
		$sql= "SELECT id,tahun,deskripsi FROM sejarah";
		$result=$db->query($sql);
		?>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading"><a href = "index.php?modul=4&aksi=tambah" class="btn btn-primary"><svg class="glyph stroked plus sign"><use xlink:href="#stroked-plus-sign"/></svg> Tambah</a></div>
					<div class="panel-body">
						<table data-toggle="table" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="asc">
						    <thead>
						    <tr>
						        <th>No</th>
						        <th>Tahun</th>
						        <th>Deskripsi</th>
						        <th>Aksi</th>
						    </tr>
						    </thead>
							<?php while($row=$result->fetch_object()){?>
							<tr>
							<td><?php echo $i;?></td>
							<td><?php echo $row->tahun;?></td>
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
							<a class="btn btn-primary" href="index.php?modul=4&aksi=edit&id=<?php echo $row->id;?>">
							<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
							</a>
							&nbsp;
							<a class="btn btn-danger" href="index.php?modul=4&aksi=hapus&id=<?php echo $row->id;?>" onclick="return confirm('Apakah Anda yakin untuk menghapus data ini ?')">
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
	function hapus_sejarah($id){
	global $db;
	$sql="select tahun,gambar from sejarah where id= $id";
	$result=$db->query($sql);
	if(!$result){
		die("Could not query the database: </br>".$db->error);
	}
	if($result->num_rows>0){
	while($row=$result->fetch_object()){
		$tahun=$row->tahun;
		unlink('../images/'.$row->gambar);
		unlink('../images/small_'.$row->gambar);
	}}
	$sql="select idcontent FROM `content` WHERE `content`.`idsejarah` = $id";
	$result=$db->query($sql);
	$row=$result->fetch_object();
	$idc=$row->idcontent;
	$sql="DELETE FROM `content` WHERE `content`.`idsejarah` = $id";
	$result=$db->query($sql);
	$sql="DELETE FROM `sejarah` WHERE `sejarah`.`id` = $id";
	$result=$db->query($sql);
	if(!$result){
		die("Could not query the database: </br>".$db->error);
	}else{
		$tahun="$tahun";
		tambah_log($idc,"hapus",$tahun);
	}
	} 
?>
<?php 
function edit_sejarah($id){
	?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Sejarah</li>
			</ol>
		</div><!--/.row-->
	<?php
	global $db;
	if($_POST){
	$id=$_POST['id'];
	$tahun=test_input($_POST['tahun']);
	$deskripsi=strip_tags($_POST['deskripsi']);
	if(isset($_FILES)){
	if ($_FILES['fupload']['error'] > 0)
{
	echo 'Problem: ';
	switch ($_FILES['fupload']['error'])
	{
		case 1:  echo 'File exceeded upload_max_filesize';
				echo '<p><a href="index.php?modul=4&aksi=edit&id='.$id.'">Kembali</a></p>';
				break;
		case 2:  echo 'File exceeded max_file_size';
				echo '<p><a href="index.php?modul=4&aksi=edit&id='.$id.'">Kembali</a></p>';
				break;
		case 3:  echo 'File only partially uploaded';
				echo '<p><a href="index.php?modul=4&aksi=edit&id='.$id.'">Kembali</a></p>';
				break;
		case 4:  echo 'No file uploaded';
				echo '<p><a href="index.php?modul=4&aksi=edit&id='.$id.'">Kembali</a></p>';
				break;
		case 6:  echo 'Cannot upload file: No temp directory specified';
				echo '<p><a href="index.php?modul=4&aksi=edit&id='.$id.'">Kembali</a></p>';
				break;
		case 7:  echo 'Upload failed: Cannot write to disk';
				echo '<p><a href="index.php?modul=4&aksi=edit&id='.$id.'">Kembali</a></p>';
				break;
	}
	exit;
}
//direktori gambar
  $vdir_upload = "../images/";
  $fupload_name='sejarah'.$id;
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
  if($src_width>=640){
  $dst_width = 640;
  }
  $dst_height = ($dst_width/$src_width)*$src_height;

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

  //Simpan dalam versi small 200 pixel
  //Set ukuran gambar hasil perubahan

  $dst_width2 = 330;
  $dst_height2 = 250;

  //proses perubahan ukuran
  $im2 = imagecreatetruecolor($dst_width2,$dst_height2);
  imagecopyresampled($im2, $im_src, 0, 0, 0, 0, $dst_width2, $dst_height2, $src_width, $src_height);

  //Simpan gambar
  switch($imageType) {
		case "image/gif":
  			imagegif($im2,$vdir_upload . "small_" . $fupload_name.'.gif');
			break;
	    case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
  			imagejpeg($im2,$vdir_upload . "small_" . $fupload_name.'.jpg');
			break;
	    case "image/png":
		case "image/x-png":
  			imagepng($im2,$vdir_upload . "small_" . $fupload_name.'.png');
			break;
  }
  
  //Hapus gambar di memori komputer
  imagedestroy($im_src);
  imagedestroy($im);
  unlink($vfile_upload);
  imagedestroy($im2);
}else{
	$ima="";
}
	$sql="UPDATE `sejarah` SET `tahun` = '$tahun',`deskripsi`='$deskripsi',`gambar`='$ima' WHERE `sejarah`.`id` = '$id'";
	$result=$db->query($sql);
	echo'
	<div class="row">
			<div class="col-lg-12">';
	if(!$result){
		echo'
		<div class="alert bg-warning" role="alert">
					<a href="index.php?modul=4&aksi=edit&id='.$id.'">Terjadi Masalah Silahkan Coba Lagi</a> <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
		</div>';
		die("Could not query the database: </br>".$db->error);
	}
	else{
	echo'
		<div class="alert bg-success" role="alert">
			<svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg><a href="index.php?modul=4"> Data Telah Diubah</a> <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
		</div>';
	$sql="SELECT idcontent FROM `content` where idsejarah = $id";
	$result=$db->query($sql);
	if(!$result){
	die("Could not query the database: </br>".$db->error);
	}
	$row=$result->fetch_object();
	tambah_log($row->idcontent,"edit",$tahun);	
	}
	echo'
	</div>
	</div>';
	}
	$sql_select= "SELECT * FROM sejarah WHERE id='$id'";
	$q= $db->query($sql_select);
	if(!$q){
		die("Could not query the database: </br>".$db->error);
	}
	while($row=$q->fetch_object()){
		$id=$row->id;
		$tahun=$row->tahun;
		$deskripsi=$row->deskripsi;
		$gambar=$row->gambar;
	}
?>	
	<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Sejarah</h1>
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
									<label>Kategori</label>
									<select class="form-control" name="tahun">
										<?php 
										$thn=2000;
										while($thn<=date("Y")){
											if($thn==$tahun){
												echo "<option value='$thn' selected>$thn</option>";
											}else{
												echo "<option value='$thn'>$thn</option>";
											}
											$thn++;
										}
										?>
									</select>
								</div>
								<div class="form-group">
									<label>Deskripsi</label>
									<textarea id="deskripsi" class="form-control" name="deskripsi" rows="3"><?php echo $deskripsi;?></textarea>
								</div>
								<div class="form-group">
									<label>Gambar</label><br/>
									<img src="../images/small_<?php echo $gambar;?>" alt="error"/>
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
		if ($aksi==null){lihat_sejarah();}
		else if ($aksi=='tambah'){tambah_sejarah();}
		else if ($aksi=='edit'){edit_sejarah($_GET['id']);}
		else if ($aksi=='hapus'){hapus_sejarah($_GET['id']);lihat_sejarah();}
?>