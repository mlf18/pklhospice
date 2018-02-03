<?php 
function lihat_halaman(){
	global $db;?>
<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Data Produk</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<?php							
						$sql= "SELECT * FROM halaman_statis";
						$q= $db->query($sql);
					?>
					
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th style="width:30px;">No</th>
								  <th>Nama</th>
								  <th>Judul</th>
								  <th>Tanggal</th>
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
								<td class="center"><?php echo $row->judul; ?></td>
								<td class="center"><?php echo $row->tanggal; ?></td>
								<td class="center">
									<?php echo '<a class="btn btn-info" href="body.php?modul=8&aksi=edit&id='.$row->id.'">'; ?>
										<i class="halflings-icon white edit"></i>
									</a>
								</td>
							</tr>
						
						  
						  <?php $n--;}}
						  ?>
					  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
</div><!--/row--><?php } ?>
<?php function edit_halaman($id){
	global $db;
	if($_POST){
	$id=$_POST['id'];
	$nama=$_POST['nama'];
	$judul=$_POST['judul'];
	$deskripsi=$_POST['deskripsi'];
	$ima='';
	if($_FILES["fupload"]["tmp_name"]!=null){
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
  $fupload_name=$nama;
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
  } else {
  $dst_width = $src_width;
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

  $dst_width2 = 217;
  $dst_height2 = 138;

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
	imagedestroy($im2);}
	$sql="UPDATE `halaman_statis` SET `nama` = '$nama',`judul` = '$judul',`isi`='$deskripsi',`gambar`='$ima' WHERE `halaman_statis`.`id` = '$id'";
	$result=$db->query($sql);
	if(!$result){
		echo'
		<div class="alert alert-danger">
			<strong>Error!</strong> <a href="body.php?modul=8&aksi=edit">Try Again</a>
		</div>';
		die("Could not query the database: </br>".$db->error);
	}
	echo'
	<div class="alert alert-success">
		<strong>Success!</strong> <a href="body.php?modul=8">Kembali</a>
	</div>';
	}
	$sql_select= "SELECT * FROM halaman_statis WHERE id='$id'";
	$q= $db->query($sql_select);
	if(!$q){
		die("Could not query the database: </br>".$db->error);
	}
	while($row=$q->fetch_object()){
		$idp=$row->id;
		$nama=$row->nama;
		$judul=$row->judul;
		$deskripsi=$row->isi;
		$gambar=$row->gambar;
	}
	
?>
	<div class="box-content">	
			<form class="form-horizontal" name="postform" action="" method="post" enctype='multipart/form-data'>
				<fieldset>
				<input type="hidden" id="id" name="id" value="<?php echo $idp;?>">
				  <div class="control-group">
					<label class="control-label">Nama</label>
					<div class="controls">
					  <input id="nama" type="text" name="nama" pattern="[0-9A-Za-z,-,',., ]*"  class="span6 typehead" value="<?php echo $nama;?>">
					</div>
				  </div>
				  <div class="control-group">
					<label class="control-label">Judul</label>
					<div class="controls">
					  <input id="judul" type="text" name="judul" pattern="[0-9A-Za-z,-,',., ]*"  class="span6 typehead" value="<?php echo $judul;?>">
					</div>
				  </div>
				  <div class="control-group">
					<label class="control-label">Isi</label>
					<div class="controls">
					  <textarea class="span6 typehead" id="deskripsi" name="deskripsi"><?php echo $deskripsi;?></textarea>
					</div>
				  </div>
				  <div class="control-group">
					  <label class="control-label">Gambar</label>
					  <div class="controls">
						<img src="../images/small_<?php echo $gambar;?>" alt="">
					  </div>
					</div>				  
				  <div class="control-group">
					  <label class="control-label" for="date01">Upload File</label>
					  <div class="controls">
						<input type="file" id="fupload" name="fupload">
					  </div>
					</div>
				  <div class="form-actions">
					<button type="submit" class="btn btn-primary">Save changes</button>
					<a class="btn" href="body.php?modul=8">Cancel</a>
				  </div>
				</fieldset>
			  </form>
		</div> <?php } 
		if(empty($_GET['aksi'])){
			$aksi='';
		}else{
			$aksi=$_GET['aksi'];
		}
		if ($aksi==null){lihat_halaman();}
		else if ($aksi=='edit'){edit_halaman($_GET['id']);}
		?>