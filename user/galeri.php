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
	function select_cabang(){
			global $db;
			$sql="select idcabang,lokasi from cabang";
			$result=$db->query($sql);
			if(!$result){
				die("Could not query the database: </br>".$db->error);
			}
			echo '<option value="">----</option>';
			while($row=$result->fetch_object()){
				echo "<option value='$row->idcabang'>$row->lokasi</option>";
			}
		}
	function cabang($id){
			global $db;
			$sql="select lokasi from cabang where idcabang='$id'";
			$result=$db->query($sql);
			if(!$result){
				die("Could not query the database: </br>".$db->error);
			}
			while($row=$result->fetch_object()){
				echo "$row->lokasi";
			}
		}		
function tambah_gambar(){
	global $db;
	if($_POST){
	$sql="SELECT id FROM gambar";
	$result=$db->query($sql);
	if(!$result){
		die("Could not query the database: </br>".$db->error);
	}
	if($result->num_rows > 0){
	while($row=$result->fetch_object()){
		$id=$row->id;
	}}else{$id=0;}
	$id=$id+1;
	$idcabang=test_input($_POST['cabang']);
	$judul=test_input($_POST['judul']);
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
  $fupload_name='gambar'.$id;
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
  $dst_width = $src_width;
  $dst_height =$src_height;

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

  $dst_width2 = 640;
  $dst_height2 = 370;

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
	$sql="INSERT INTO `gambar` (`id`, `idcabang`, `username`, `gambar`,`judul`) VALUES ('', '$idcabang', 'admin', '$ima','$judul')";
	$result=$db->query($sql);
if(!$result){
		echo'
		<div class="alert alert-danger">
			<strong>Error!</strong> <a href="body.php?modul=10&aksi=tambah">Try Again</a>
		</div>';
		die("Could not query the database: </br>".$db->error);
	}
	echo'
	<div class="alert alert-success">
		<strong>Success!</strong> <a href="body.php?modul=10">Kembali</a>
	</div>';
	}
?>
	<div class="box-content">	
			<form class="form-horizontal" name="postform" action="" method="post" enctype='multipart/form-data'>
				<fieldset>
				  <div class="control-group">
					<label class="control-label">Judul</label>
					<div class="controls">
					  <input id="judul" type="text" name="judul" pattern="[0-9A-Za-z,-,',., ]*"  class="span6 typehead" required/>
					</div>
				  </div>
				  <div class="control-group">
					<label class="control-label">Cabang</label>
					<div class="controls">
					  <select id="cabang" name="cabang" required>
					  <?php
					  select_cabang();
					  ?>
					  </select>
					</div>
				  </div>
				  <div class="control-group">
					  <label class="control-label" for="date01">Upload Gambar</label>
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
	function hapus_gambar($id){
	global $db;
	$sql="select gambar from gambar where id= $id";
	$result=$db->query($sql);
	if(!$result){
		die("Could not query the database: </br>".$db->error);
	}
	while($row=$result->fetch_object()){
		unlink('../images/'.$row->gambar);
		unlink('../images/small_'.$row->gambar);
	}
	$sql="DELETE FROM `gambar` WHERE `gambar`.`id` = $id";
	$result=$db->query($sql);
	if(!$result){
		die("Could not query the database: </br>".$db->error);
	}
	} 
?>
<?php function lihat_gambar(){ 
global $db;?>
<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Data gambar</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<?php							
						$sql= "SELECT id,idcabang,gambar FROM gambar order by id desc";
						$q= $db->query($sql);
					?>
					
					<div class="box-content">
					<a href="body.php?modul=10&aksi=tambah" class="btn btn-primary"><i class="halflings-icon white plus-sign"></i>Tambah gambar</a>
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th style="width:30px;">No</th>
								  <th>Lokasi</th>
								  <th>Gambar</th>
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
								<td class="center"><?php echo cabang($row->idcabang); ?></td>
								<td class="center"><img src="../images/small_<?php echo $row->gambar; ?>" alt=""/></td>
								<td class="center">
									<?php echo '<a class="btn btn-info" href="body.php?modul=10&aksi=edit&id='.$row->id.'">'; ?>
										<i class="halflings-icon white edit"></i>
									</a>
									<?php echo '<a class="btn btn-danger" href="body.php?modul=10&aksi=hapus&id='.$row->id.'"onclick="return confirm (\'Apakah Anda yakin ingin menghapus data?\');" >';?>
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

<?php function edit_gambar($id){
	global $db;
	if($_POST){
	$id=$_POST['id'];
	$idcabang=test_input($_POST['cabang']);
	$judul=test_input($_POST['judul']);
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
  $fupload_name='gambar'.$id;
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
  $dst_width = $src_width;
  $dst_height = $src_height;

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

  $dst_width2 = 640;
  $dst_height2 = 370;

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
	$sql="UPDATE `gambar` SET `idcabang` = '$idcabang',`username`='admin',`judul`='$judul',`gambar`='$ima' WHERE `gambar`.`id` = '$id'";
	$result=$db->query($sql);
	if(!$result){
		echo'
		<div class="alert alert-danger">
			<strong>Error!</strong> <a href="body.php?modul=10&aksi=edit">Try Again</a>
		</div>';
		die("Could not query the database: </br>".$db->error);
	}
	echo'
	<div class="alert alert-success">
		<strong>Success!</strong> <a href="body.php?modul=10">Kembali</a>
	</div>';
	}
	$sql_select= "SELECT * FROM gambar WHERE id='$id'";
	$q= $db->query($sql_select);
	if(!$q){
		die("Could not query the database: </br>".$db->error);
	}
	while($row=$q->fetch_object()){
		$id=$row->id;
		$judul=$row->judul;
		$gambar=$row->gambar;
	}
	
?>
	<div class="box-content">	
			<form class="form-horizontal" name="postform" action="" method="post" enctype='multipart/form-data'>
				<fieldset>
				<input type="hidden" id="id" name="id" value="<?php echo $id;?>">
				  <div class="control-group">
					<label class="control-label">Judul</label>
					<div class="controls">
					  <input id="judul" type="text" name="judul" pattern="[0-9A-Za-z,-,',., ]*"  class="span6 typehead" value="<?php echo $judul;?>" required>
					</div>
				  </div>
				  <div class="control-group">
					<label class="control-label">Cabang</label>
					<div class="controls">
					  <select id="cabang" name="cabang" required>
					  <?php
					  select_cabang();
					  ?>
					  </select>
					</div>
				  </div>
				  <div class="control-group">
					  <label class="control-label">Gambar</label>
					  <div class="controls">
						<img src="../images/small_<?php echo $gambar;?>" alt="">
					  </div>
					</div>				  				  
				  <div class="control-group">
					  <label class="control-label" for="date01">Upload Gambar</label>
					  <div class="controls">
						<input type="file" id="fupload" name="fupload" required>
					  </div>
					</div>
				  <div class="form-actions">
					<button type="submit" class="btn btn-primary">Save changes</button>
					<a class="btn" href="body.php?modul=10">Cancel</a>
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
		if ($aksi==null){lihat_gambar();}
		else if ($aksi=='tambah'){tambah_gambar();}
		else if ($aksi=='edit'){edit_gambar($_GET['id']);}
		else if ($aksi=='hapus'){hapus_gambar($_GET['id']);lihat_gambar();}
		?>
		