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
function tambah_staff(){
	global $db;
	?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Staff</li>
			</ol>
		</div><!--/.row-->
	<?php 
        global $idu;
        $deskripsiok=0;
        $msg="";
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
	$deskripsi=strip_tags($_POST['deskripsi']);
        if(strlen(strip_tags($deskripsi))>1){
            $deskripsiok=1;
        }
	if($deskripsiok=1){
	if ($_FILES['fupload']['error'] > 0)
        {
	echo 'Problem: ';
	switch ($_FILES['fupload']['error'])
	{
		case 1:  echo 'File exceeded upload_max_filesize';
				echo '<p><a href="staff-tambah">Kembali</a></p>';
				break;
		case 2:  echo 'File exceeded max_file_size';
				echo '<p><a href="staff-tambah">Kembali</a></p>';
				break;
		case 3:  echo 'File only partially uploaded';
				echo '<p><a href="staff-tambah">Kembali</a></p>';
				break;
		case 4:  echo 'No file uploaded';
				echo '<p><a href="staff-tambah">Kembali</a></p>';
				break;
		case 6:  echo 'Cannot upload file: No temp directory specified';
				echo '<p><a href="staff-tambah">Kembali</a></p>';
				break;
		case 7:  echo 'Upload failed: Cannot write to disk';
				echo '<p><a href="staff-tambah">Kembali</a></p>';
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
                default : echo 'File Bukan File Gambar';
			echo '<p><a href="staff-tambah">Kembali</a></p>';
			break;
                        exit;
  }
  
  $src_width = imageSX($im_src);
  $src_height = imageSY($im_src);
  
  //Simpan dalam versi small 200 pixel
  //Set ukuran gambar hasil perubahan

  $dst_width2 = 217;
  $dst_height2 = ($dst_width2/$src_width)*$src_height;

  //proses perubahan ukuran
  $im2 = imagecreatetruecolor($dst_width2,$dst_height2);
  imagecopyresampled($im2, $im_src, 0, 0, 0, 0, $dst_width2, $dst_height2, $src_width, $src_height);

  //Simpan gambar
  switch($imageType) {
		case "image/gif":
  			imagegif($im2,$vdir_upload . "small_" . $fupload_name.'.gif');
                        $ima=$fupload_name.'.gif';
			break;
                case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
  			imagejpeg($im2,$vdir_upload . "small_" . $fupload_name.'.jpg');
                        $ima=$fupload_name.'.jpg';
			break;
                case "image/png":
		case "image/x-png":
  			imagepng($im2,$vdir_upload . "small_" . $fupload_name.'.png');
                        $fupload_name.'.png';
			break;
  }
  
  //Hapus gambar di memori komputer
  imagedestroy($im_src);
  unlink($vfile_upload);
  imagedestroy($im2);
	$sql="INSERT INTO `staff` (`id_staff`, `nama`, `deskripsi`, `gambar`.`tanggal`,`iduser`) VALUES ('$id', '$nama', '$deskripsi', '$ima',now(),'$idu')";
	$result=$db->query($sql);
	echo'
	<div class="row">
			<div class="col-lg-12">';
	if(!$result){
		echo'
		<div class="alert bg-danger" role="alert">
			<svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg><a href="staff-tambah"> Terjadi Kesalahan ! <a href="">Coba lagi</a> </a><a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
		</div>';
		die("Could not query the database: </br>".$db->error);
	}else{
	echo'
	<div class="alert bg-success" role="alert">
		<svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg><a href="staff-lihat"> Data Telah Ditambahkan </a><a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
	</div>';
	}
	echo'
	</div>
	</div>';
	}
        }
?>	
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Staff</h1>
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
                                                                        <input class="form-control" name="nama" pattern="{1,50}" required>
								</div>
								<div class="form-group">
									<label>Deskripsi</label>
									<textarea id="deskripsi" class="form-control" name="deskripsi" rows="3" pattern="{2,255}" required></textarea>
								</div>
																
								<div class="form-group">
									<label>Gambar</label>
									<input type="file" name="fupload" required>
								</div>
								<button type="submit" class="btn btn-primary">Submit</button>
							</div>
						</form>
					</div>
				</div>
			</div><!-- /.col-->
		</div><!-- /.row -->
		
	</div><!--/.main-->
<?php } ?>
<?php 
function lihat_staff() {
	global $db;
	$i=1;?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Staff</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Staff</h1>
			</div>
		</div><!--/.row-->
				
		<?php 
		$sql= "SELECT * FROM staff";
		$result=$db->query($sql);
		?>
		<div class="row">
			<div class="col-md-12 col-xs-12">
				<div class="panel panel-default">
                                    <div class="panel-heading"><a href = "staff-tambah" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Tambah</a></div>
					<div class="panel-body">
                                            <div class="col-lg-12 col-md-12 col-xs-12">
                                            <div class='table-responsive'>
                                                <table id='table' class="display table table-striped table-bordered">
						    <thead>
						    <tr>
						        <th>No</th>
						        <th>Nama</th>
                                                        <th>Tanggal</th>
						        <th>Aksi</th>
						    </tr>
						    </thead>
							<?php while($row=$result->fetch_object()){?>
							<tr>
							<td></td>
							<td><?php echo $row->nama;?></td>
                                                        <td><?php echo $row->tanggal;?></td>
							<td>
                                                        <a class="btn btn-info" href="staff-buka-<?php echo $row->id_staff;?>">
							<i class="fa fa-eye" aria-hidden="true"></i>
							</a>    
							<a class="btn btn-primary" href="staff-edit-<?php echo $row->id_staff;?>">
							<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
							</a>
							<a class="btn btn-danger" href="staff-hapus-<?php echo $row->id_staff;?>" onclick="return confirm('Apakah Anda yakin untuk menghapus data ini ?')">
							<i class="fa fa-trash-o" aria-hidden="true"></i>
							</a>
							</td>
							</tr>
							<?php $i++;}?>
						</table>
                                            </div>
                                            </div>
					</div>
				</div>
			</div>
		</div><!--/.row-->			
	</div><!--/.main-->	
<?php } ?>
<?php 
	function hapus_staff($id){
	global $db;
	$sql="select gambar from staff where id_staff= $id";
	$result=$db->query($sql);
	if(!$result){
		die("Could not query the database: </br>".$db->error);
	}
        if($result->num_rows > 0){
	while($row=$result->fetch_object()){
            if($row->gambar!=''){
                unlink('../images/small_'.$row->gambar);
            }
        }}
	$sql="DELETE FROM `staff` WHERE `staff`.`id_staff` = $id";
	$result=$db->query($sql);
	if(!$result){
		die("Could not query the database: </br>".$db->error);
	}
	} 
?>
<?php 
function edit_staff($id){
	?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Staff</li>
			</ol>
		</div><!--/.row-->
	<?php
	global $db;
        global $idu;
        $deskripsiok=0;
        $msg="";
	if($_POST){
	$id=$_POST['id'];
	$nama=test_input($_POST['nama']);
	$deskripsi=strip_tags($_POST['deskripsi']);
        if(strlen(strip_tags($deskripsi))>1){
            $deskripsiok=1;
        }
	if($deskripsiok=1){
	if ($_FILES['fupload']['error'] > 0)
        {
	echo 'Problem: ';
	switch ($_FILES['fupload']['error'])
	{
		case 1:  echo 'File exceeded upload_max_filesize';
				echo '<p><a href="staff-edit-'.$id.'">Kembali</a></p>';
				break;
		case 2:  echo 'File exceeded max_file_size';
				echo '<p><a href="staff-edit-'.$id.'">Kembali</a></p>';
				break;
		case 3:  echo 'File only partially uploaded';
				echo '<p><a href="staff-edit-'.$id.'">Kembali</a></p>';
				break;
		case 4:  echo 'No file uploaded';
				echo '<p><a href="staff-edit-'.$id.'">Kembali</a></p>';
				break;
		case 6:  echo 'Cannot upload file: No temp directory specified';
				echo '<p><a href="staff-edit-'.$id.'">Kembali</a></p>';
				break;
		case 7:  echo 'Upload failed: Cannot write to disk';
				echo '<p><a href="staff-edit-'.$id.'">Kembali</a></p>';
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

  $dst_width2 = 217;
  $dst_height2 = ($dst_width2/$src_width)*$src_height;
  //proses perubahan ukuran
  $im2 = imagecreatetruecolor($dst_width2,$dst_height2);
  imagecopyresampled($im2, $im_src, 0, 0, 0, 0, $dst_width2, $dst_height2, $src_width, $src_height);

  //Simpan gambar
  switch($imageType) {
		case "image/gif":
  			imagegif($im2,$vdir_upload . "small_" . $fupload_name.'.gif');
                        $ima=$fupload_name.'.gif';
			break;
                case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
  			imagejpeg($im2,$vdir_upload . "small_" . $fupload_name.'.jpg');
                        $ima=$fupload_name.'.jpg';
			break;
                case "image/png":
		case "image/x-png":
  			imagepng($im2,$vdir_upload . "small_" . $fupload_name.'.png');
                        $fupload_name.'.png';
			break;
  }
  
  //Hapus gambar di memori komputer
  imagedestroy($im_src);
  unlink($vfile_upload);
  imagedestroy($im2);
	$sql="UPDATE `staff` SET `nama` = '$nama',`deskripsi`='$deskripsi',`gambar`='$ima',`tanggal`=now(),`iduser`='$idu' WHERE `staff`.`id_staff` = '$id'";
	$result=$db->query($sql);
	echo'
	<div class="row">
			<div class="col-lg-12">';
	if(!$result){
		echo'
		<div class="alert bg-warning" role="alert">
					<a href="staff-edit-'.$id.'">Terjadi Masalah Silahkan Coba Lagi</a> <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
		</div>';
		die("Could not query the database: </br>".$db->error);
	}
	else{
	echo'
		<div class="alert bg-success" role="alert">
			<svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg><a href="staff-lihat"> Data Telah Diubah </a><a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
		</div>';
	}
	echo'
	</div>
	</div>';
	}
        }
	$sql_select= "SELECT * FROM staff WHERE id_staff='$id'";
	$q= $db->query($sql_select);
	if(!$q){
		die("Could not query the database: </br>".$db->error);
	}
	while($row=$q->fetch_object()){
		$id=$row->id_staff;
		$nama=$row->nama;
		$deskripsi=$row->deskripsi;
		$gambar=$row->gambar;
	}
?>	
	<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Staff</h1>
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
                                                                        <input class="form-control" name="nama" value="<?php echo $nama;?>" pattern="{1,50}" required>
								</div>
								<div class="form-group">
									<label>Deskripsi</label>
                                                                        <textarea id="deskripsi" class="form-control" name="deskripsi" pattern="{1,255}" rows="3" required><?php echo $deskripsi;?></textarea>
								</div>								
								<div class="form-group">
									<label>Gambar</label><br/>
									<img src="../images/small_<?php echo $gambar;?>"/>
								</div><div class="form-group">
									<label>Gambar</label>
                                                                        <input type="file" name="fupload" required>
								</div>
								<button type="submit" class="btn btn-primary">Submit</button>
							</div>
						</form>
					</div>
				</div>
			</div><!-- /.col-->
		</div><!-- /.row -->
		
	</div><!--/.main-->
<?php } ?>
<?php 
function open_staff($id){
	?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Staff</li>
			</ol>
		</div><!--/.row-->
	<?php
	global $db;
        global $idu;
	$sql_select= "SELECT * FROM staff WHERE id_staff='$id'";
	$q= $db->query($sql_select);
	if(!$q){
		die("Could not query the database: </br>".$db->error);
	}
	while($row=$q->fetch_object()){
		$id=$row->id_staff;
		$nama=$row->nama;
		$deskripsi=$row->deskripsi;
		$gambar=$row->gambar;
	}
        ?>
	<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Staff</h1>
			</div>
		</div><!--/.row-->
				
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading"><?php echo $nama;?></div>
					<div class="panel-body">
						<div class="col-md-8">
								<div class="form-group">
									<label>Nama</label>
                                                                        <p><?php echo $nama;?></p>
								</div>
								<div class="form-group">
									<label>Deskripsi</label>
                                                                        <?php echo html_entity_decode(stripslashes($deskripsi));?>
								</div>
								<div class="form-group">
									<label>Gambar</label>
                                                                        <p><img src="../images/small_<?php echo $gambar;?>"/></p>
                                                                </div>
                                                                <div class="form-group">
								<a class="btn btn-primary" href="staff-edit-<?php echo $id;?>">Edit</a>
                                                                </div>
						</div>
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
		if ($aksi==null || $aksi=="lihat"){lihat_staff();}
		else if ($aksi=='tambah'){tambah_staff();}
		else if ($aksi=='edit'){edit_staff($_GET['id']);}
                else if ($aksi=='buka'){open_staff($_GET['id']);}
		else if ($aksi=='hapus'){hapus_staff($_GET['id']);lihat_staff();}
?>