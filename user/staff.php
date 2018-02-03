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
<?php function tambah_staff(){
global $db;
if($_POST){
	$sql="SELECT id_staff FROM staff";
	$result=$db->query($sql);
	if(!$result){
		die("Could not query the database: </br>".$db->error);
	}
	if($result->num_rows > 0){
	while($row=$result->fetch_object()){
		$id=$row->id_staff;
	}}else{$id=0;}
	$id=$id+1;
	$nama=test_input($_POST['nama']);
	$bidang=test_input($_POST['bidang']);
	$deskripsi=strip_tags($_POST['deskripsi']);
	if ($_FILES['fupload']['error'] > 0)
{
	echo 'Problem: ';
	switch ($_FILES['fupload']['error'])
	{
		case 1:  echo 'File exceeded upload_max_filesize';
				echo '<p><a href="../">Kembali</a></p>';
				break;
		case 2:  echo 'File exceeded max_file_size';
				echo '<p><a href="../">Kembali</a></p>';
				break;
		case 3:  echo 'File only partially uploaded';
				echo '<p><a href="../">Kembali</a></p>';
				break;
		case 4:  echo 'No file uploaded';
				echo '<p><a href="../">Kembali</a></p>';
				break;
		case 6:  echo 'Cannot upload file: No temp directory specified';
				echo '<p><a href="../">Kembali</a></p>';
				break;
		case 7:  echo 'Upload failed: Cannot write to disk';
				echo '<p><a href="../">Kembali</a></p>';
				break;
	}
	exit;
}
//direktori gambar
  $vdir_upload = "../images/";
  $fupload_name='staff'.$id;
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

  $dst_width=296;
  $dst_height = 250;

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
	$sql="INSERT INTO `staff` (`id_staff`, `nama`, `bidang`, `deskripsi`, `gambar`) VALUES ('', '$nama', '$bidang', '$deskripsi', '$ima')";
	$result=$db->query($sql);
	if(!$result){
		echo'
		<div class="alert alert-danger">
			<strong>Error!</strong> <a href="body.php?modul=5&aksi=tambah">Try Again</a>
		</div>';
		die("Could not query the database: </br>".$db->error);
	}
	echo'
	<div class="alert alert-success">
		<strong>Success!</strong> <a href="body.php?modul=5">Kembali</a>
	</div>';
	}
?>
	<div class="box-content">	
			<form class="form-horizontal" name="postform" action="" method="post" enctype='multipart/form-data'>
				<fieldset>
				<input id="section" type="hidden" name="section" value="<?php echo $section;?>" />
				  <div class="control-group">
					<label class="control-label">Nama</label>
					<div class="controls">
					  <input id="nama" type="text" name="nama" pattern="[0-9A-Za-z,-,',., ]*"  class="span6 typehead" required>
					</div>
				  </div>
				  <div class="control-group">
					<label class="control-label">Bidang</label>
					<div class="controls">
					  <input id="bidang" type="text" name="bidang" pattern="[A-Za-z,-,',., ]*"  class="span6 typehead" required>
					</div>
				  </div>
				  <div class="control-group">
					<label class="control-label">Deskripsi Singkat</label>
					<div class="controls">
					  <textarea class="span6 typehead" id="deskripsi" name="deskripsi" required></textarea>
					</div>
				  </div>				  
				  <div class="control-group">
					  <label class="control-label">Upload Gambar</label>
					  <div class="controls">
						<input type="file" id="fupload" name="fupload" required>
					  </div>
					</div>
				  <div class="form-actions">
					<button type="submit" class="btn btn-primary">Submit</button>
				  </div>
				</fieldset>
			  </form>
		
</div> <?php } ?>
<?php 
	function hapus_Staff($id){
	global $db;
	$sql="select gambar from staff where id_staff= $id";
	$result=$db->query($sql);
	if(!$result){
		die("Could not query the database: </br>".$db->error);
	}
	while($row=$result->fetch_object()){
		unlink('../images/'.$row->gambar);
	}
	$sql="DELETE FROM `staff` WHERE `staff`.`id_staff` = $id";
	$result=$db->query($sql);
	if(!$result){
		die("Could not query the database: </br>".$db->error);
	}
	} 
?>
<?php function lihat_staff(){ 
global $db;?>
<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Data Staff</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<?php							
						$sql= "SELECT id_staff,nama,bidang FROM staff";
						$q= $db->query($sql);
					?>
					
					<div class="box-content">
					<a href="body.php?modul=5&aksi=tambah" class="btn btn-primary"><i class="halflings-icon white plus-sign"></i>Tambah Staff</a>
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th style="width:30px;">No</th>
								  <th>Nama</th>
								  <th>Bidang</th>
								  <th style="width:88px;">Aksi</th>
							  </tr>
							</thead>
					<tbody>
						<?php
						$n=$q->num_rows;
						if($n > 0) {
							while($row=$q->fetch_object()){
							
						?>
						
							<tr>
								<td><?php echo $n; ?></td>
								<td class="center"><?php echo $row->nama; ?></td>
								<td class="center"><?php echo $row->bidang; ?></td>
								<td class="center">
									<?php echo '<a class="btn btn-info" href="body.php?modul=5&aksi=edit&id='.$row->id_staff.'">'; ?>
										<i class="halflings-icon white edit"></i>
									</a>
									<?php echo '<a class="btn btn-danger" href="body.php?modul=5&aksi=hapus&id='.$row->id_staff.'"onclick="return confirm (\'Apakah Anda yakin ingin menghapus data?\');" >';?>
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
						
						  
						  <?php $n--;}}
						  ?>
					  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->

	<?php } ?>	

<?php function edit_staff($id){
global $db;
if($_POST){
	$id=test_input($_POST['id']);
	$nama=test_input($_POST['nama']);
	$bidang=test_input($_POST['bidang']);
	$deskripsi=strip_tags($_POST['deskripsi']);
	if ($_FILES['fupload']['error'] > 0)
{
	echo 'Problem: ';
	switch ($_FILES['fupload']['error'])
	{
		case 1:  echo 'File exceeded upload_max_filesize';
				echo '<p><a href="../">Kembali</a></p>';
				break;
		case 2:  echo 'File exceeded max_file_size';
				echo '<p><a href="../">Kembali</a></p>';
				break;
		case 3:  echo 'File only partially uploaded';
				echo '<p><a href="../">Kembali</a></p>';
				break;
		case 4:  echo 'No file uploaded';
				echo '<p><a href="../">Kembali</a></p>';
				break;
		case 6:  echo 'Cannot upload file: No temp directory specified';
				echo '<p><a href="../">Kembali</a></p>';
				break;
		case 7:  echo 'Upload failed: Cannot write to disk';
				echo '<p><a href="../">Kembali</a></p>';
				break;
	}
	exit;
}
//direktori gambar
  $vdir_upload = "../images/";
  $fupload_name='staff'.$id;
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

  $dst_width=296;
  $dst_height = 250;

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
	$sql="UPDATE `staff` SET `nama` = '$nama',`bidang`='$bidang',`deskripsi`='$deskripsi',`gambar`='$ima' WHERE `staff`.`id_staff` = '$id'";
	$result=$db->query($sql);
	if(!$result){
		echo'
		<div class="alert alert-danger">
			<strong>Error!</strong> <a href="body.php?modul=5&aksi=edit">Try Again</a>
		</div>';
		die("Could not query the database: </br>".$db->error);
	}
	echo'
	<div class="alert alert-success">
		<strong>Success!</strong> <a href="body.php?modul=5">Kembali</a>
	</div>';
	}
	$sql="select * from staff where id_staff='$id'";
	$q=$db->query($sql);
	if(!$q){
		die("Could not query the database: </br>".$db->error);
	}
	while($row=$q->fetch_object()){
		$id=$row->id_staff;
		$nama=$row->nama;
		$bidang=$row->bidang;
		$deskripsi=$row->deskripsi;
		$gambar=$row->gambar;
	}
?>
	<div class="box-content">	
			<form class="form-horizontal" name="postform" action="" method="post" enctype='multipart/form-data'>
				<fieldset>
				<input id="id" type="hidden" name="id" value="<?php echo $id;?>" />
				  <div class="control-group">
					<label class="control-label">Nama</label>
					<div class="controls">
					  <input id="nama" type="text" name="nama" pattern="[0-9A-Za-z,-,',., ]*" value="<?php echo $nama;?>"  class="span6 typehead" required>
					</div>
				  </div>
				  <div class="control-group">
					<label class="control-label">Bidang</label>
					<div class="controls">
					  <input id="bidang" type="text" name="bidang" pattern="[A-Za-z,-,',., ]*" value="<?php echo $bidang;?>" class="span6 typehead" required>
					</div>
				  </div>
				  <div class="control-group">
					<label class="control-label">Deskripsi Singkat</label>
					<div class="controls">
					  <textarea class="span6 typehead" id="deskripsi" name="deskripsi" required><?php echo $deskripsi;?></textarea>
					</div>
				  </div>
					<div class="control-group">
					  <label class="control-label">Gambar</label>
					  <div class="controls">
						<img src="../images/<?php echo $gambar;?>" alt="">
					  </div>
					</div>				  				  
				  <div class="control-group">
					  <label class="control-label">Upload Gambar</label>
					  <div class="controls">
						<input type="file" id="fupload" name="fupload" required>
					  </div>
					</div>
				  <div class="form-actions">
					<button type="submit" class="btn btn-primary">Save changes</button>
					<a class="btn" href="body.php?modul=5">Cancel</a>
				  </div>
				</fieldset>
			  </form>
</div> <?php }
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
		if ($aksi==null){lihat_staff();}
		else if ($aksi=='tambah'){tambah_staff();}
		else if ($aksi=='edit'){edit_staff($_GET['id']);}
		else if ($aksi=='hapus'){hapus_staff($_GET['id']);lihat_staff();}
		?>
		