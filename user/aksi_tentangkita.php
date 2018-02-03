<?php
function tambah_section1($section){
	global $db;
if($_POST){
	$judul=$_POST['nama'];
	$section=$_POST['section'];
	$deskripsi=$_POST['deskripsi'];
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
  $fupload_name='about';
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

  $dst_width=640;
  $dst_height = 443;

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
	$sql="INSERT INTO `halaman_statis` (`id`, `nama`, `judul`, `isi`, `gambar`,`tanggal`) VALUES ('', 'section1', '$judul', '$deskripsi', '$ima',now())";
	$result=$db->query($sql);
	if(!$result){
		die("Could not query the database: </br>".$db->error);
	}
	}
	$section=$_GET['section'];
?>
	<div class="box-content">	
			<form class="form-horizontal" name="postform" action="" method="post" enctype='multipart/form-data'>
				<fieldset>
				<input id="section" type="hidden" name="section" value="<?php echo $section;?>" />
				  <div class="control-group">
					<label class="control-label">Nama</label>
					<div class="controls">
					  <input id="nama" type="text" name="nama" pattern="[0-9A-Za-z,-,',., ]*"  class="span6 typehead">
					</div>
				  </div>
				  <div class="control-group">
					<label class="control-label">Isi</label>
					<div class="controls">
					  <textarea class="span6 typehead" id="deskripsi" name="deskripsi"></textarea>
					</div>
				  </div>				  
				  <div class="control-group">
					  <label class="control-label">Upload Gambar</label>
					  <div class="controls">
						<input type="file" id="fupload" name="fupload">
					  </div>
					</div>
				  <div class="form-actions">
					<button type="submit" class="btn btn-primary">Save changes</button>
					<button class="btn">Cancel</button>
				  </div>
				</fieldset>
			  </form>
		
</div><?php }?>
<?php
function tambah_staff(){
global $db;
if($_POST){
	$sql="SELECT id_staff FROM staff";
	$result=$db->query($sql);
	if(!$result){
		die("Could not query the database: </br>".$db->error);
	}
	$id=$result->num_rows+1;	
	$nama=$_POST['nama'];
	$bidang=$_POST['bidang'];
	$deskripsi=$_POST['deskripsi'];
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
		die("Could not query the database: </br>".$db->error);
	}
	}
?>
	<div class="box-content">	
			<form class="form-horizontal" name="postform" action="" method="post" enctype='multipart/form-data'>
				<fieldset>
				<input id="section" type="hidden" name="section" value="<?php echo $section;?>" />
				  <div class="control-group">
					<label class="control-label">Nama</label>
					<div class="controls">
					  <input id="nama" type="text" name="nama" pattern="[0-9A-Za-z,-,',., ]*"  class="span6 typehead">
					</div>
				  </div>
				  <div class="control-group">
					<label class="control-label">Bidang</label>
					<div class="controls">
					  <input id="bidang" type="text" name="bidang" pattern="[0-9A-Za-z,-,',., ]*"  class="span6 typehead">
					</div>
				  </div>
				  <div class="control-group">
					<label class="control-label">Deskripsi Singkat</label>
					<div class="controls">
					  <textarea class="span6 typehead" id="deskripsi" name="deskripsi"></textarea>
					</div>
				  </div>				  
				  <div class="control-group">
					  <label class="control-label">Upload Gambar</label>
					  <div class="controls">
						<input type="file" id="fupload" name="fupload">
					  </div>
					</div>
				  <div class="form-actions">
					<button type="submit" class="btn btn-primary">Save changes</button>
					<button class="btn">Cancel</button>
				  </div>
				</fieldset>
			  </form>
		
</div><?php }?>
<?php
		if(empty($_GET['section'])){
			$section='';
		}else{
			$section=$_GET['section'];
		}
		if ($section=='staff'){tambah_staff();}
		else {tambah_section1($section);}
		?>