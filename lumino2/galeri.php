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
require_once 'db_login.php';
	function select_cabang(){
			global $db;
			$sql="select idcabang,lokasi from cabang";
			$result=$db->query($sql);
			if(!$result){
				die("Could not query the database: </br>".$db->error);
			}
			while($row=$result->fetch_object()){
				echo "<option value='$row->idcabang'>$row->lokasi</option>";
			}
			echo '<option value="other">Other</option>';
		}
	function cabang($id){
			global $db;
                        if($id==NULL){
                            echo "Other";
                        }else{
                        $sql="select lokasi from cabang where idcabang='$id'";
			$result=$db->query($sql);
			if(!$result){
				die("Could not query the database: </br>".$db->error);
			}
                        if($result->num_rows > 0){
                            while($row=$result->fetch_object()){
				echo "$row->lokasi";
			}
                        }
                        }
		}		
function tambah_gambar(){
	global $db;
        global $idu;
	?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active"><a href="galeri">Galeri</a></li>
			</ol>
		</div><!--/.row-->
	<?php
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
	if($idcabang=="other"){
		$idcabang='NULL';
	}
	$judul=test_input($_POST['judul']);
        $sql="select * from gambar where judul = '$judul'";
        $result=$db->query($sql);
        if($result->num_rows < 1 ){
        if ($_FILES['fupload']['error'] > 0){
	echo 'Problem: ';
	switch ($_FILES['fupload']['error'])
	{
		case 1:  echo 'File exceeded upload_max_filesize';
				echo '<p><a href="galeri-tambah">Kembali</a></p>';
				break;
		case 2:  echo 'File exceeded max_file_size';
				echo '<p><a href="galeri-tambah">Kembali</a></p>';
				break;
		case 3:  echo 'File only partially uploaded';
				echo '<p><a href="galeri-tambah">Kembali</a></p>';
				break;
		case 4:  echo 'No file uploaded';
				echo '<p><a href="galeri-tambah">Kembali</a></p>';
				break;
		case 6:  echo 'Cannot upload file: No temp directory specified';
				echo '<p><a href="galeri-tambah">Kembali</a></p>';
				break;
		case 7:  echo 'Upload failed: Cannot write to disk';
				echo '<p><a href="galeri-tambah">Kembali</a></p>';
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
			$im_src=@imagecreatefromjpeg($vfile_upload); 
			break;
	    case "image/png":
		case "image/x-png":
			$im_src=imagecreatefrompng($vfile_upload); 
			break;
  }
  $result=false;
  $pesan="Terjadi Kesalahan Saat Upload File Image";
  if($im_src){
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
	$sql="INSERT INTO `gambar` (`id`, `idcabang`,`gambar`,`judul`,`tanggal`,`iduser`) VALUES ('$id', $idcabang,'$ima','$judul',now(),'$idu')";
	$result=$db->query($sql);
        $pesan='';
  }     
	echo'
	<div class="row">
			<div class="col-lg-12">';
	if(!$result){
		die('
		<div class="alert bg-danger" role="alert">
			<svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg><a href="galeri-tambah"> Terjadi Kesalahan ! '.$db->error.$pesan.' </a><a href="">Coba lagi</a> <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
		</div>');
	}else{
	echo'
	<div class="alert bg-success" role="alert">
		<svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg><a href="galeri-lihat"> Data Telah Ditambahkan </a><a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
	</div>';
	}
	echo'
	</div>
	</div>';    
        }else{
            echo'
                <div class="alert bg-danger" role="alert">
                    <svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg><a href="galeri-tambah"> Data '.$judul.' Telah Ada<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
                        </div>';
        }
	}
?>
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Galeri</h1>
			</div>
		</div><!--/.row-->
		<div class="row">
			<div class="col-lg-10 col-lg-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading">Tambah Gambar</div>
					<div class="panel-body">
						<div class="col-lg-9 col-lg-offset-1">
                                                    <form role="form" class="form-horizontal" action="" method="post" enctype='multipart/form-data'>		
								<div class="form-group">
									<label class="control-label col-sm-2" for="nama">Nama</label>
                                                                        <div class="col-sm-10">
                                                                            <input class="form-control nama" name="judul" id="nama" pattern="{1,50}" required autofocus="">
                                                                        </div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-2" for="cabang">Cabang</label>
                                                                        <div class="col-sm-10">
									<select class="form-control cab" name="cabang" id="cabang" required>
									<?php select_cabang();?>
									</select>
                                                                        </div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-2" for="gambar">Upload Gambar</label>
                                                                        <div class="col-sm-10">
                                                                            <input type="file" name="fupload" id="gambar" required>
                                                                        </div>
								</div>
								 <div class="col-sm-2"></div>
                                                                 <div class="col-sm-10">
                                                                    <button type="submit" id="submit" class="btn btn-primary">Submit</button>
                                                                    <a class="btn btn-info" href="galeri">Kembali</a>
                                                                 </div>
                                                                </form>
							</div>
					</div>
				</div>
			</div><!-- /.col-->
		</div><!-- /.row -->
		
	</div><!--/.main-->
	<?php } ?>
<?php 
	function hapus_gambar($id){
	global $db;
	$sql="select gambar from gambar where id= $id";
	$result=$db->query($sql);
	if(!$result){
		die("Could not query the database: </br>".$db->error);
	}
	while($row=$result->fetch_object()){
            if($row->gambar!=""){
                unlink('../images/'.$row->gambar);
		unlink('../images/small_'.$row->gambar);
            }
	}
	$sql="DELETE FROM `gambar` WHERE `gambar`.`id` = $id";
	$result=$db->query($sql);
	if(!$result){
		die("Could not query the database: </br>".$db->error);
	}
	} 
?>
<?php function lihat_gambar(){ 
global $db;
	$i=1;?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active"><a href="galeri">Galeri</a></li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Galeri</h1>
			</div>
		</div><!--/.row-->
				
		<?php 
		$sql= "SELECT * FROM gambar";
		$result=$db->query($sql);
		?>
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2">
				<div class="panel panel-default">
                                    <div class="panel-heading"><a href = "galeri-tambah" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Tambah</a></div>
					<div class="panel-body">
                                            <div class="col-lg-9 col-lg-offset-2">
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
							<td><?php echo $i;?></td>
							<td><?php echo $row->judul;?></td>
                                                        <td><?php echo $row->tanggal;?></td>
							<td>
                                                        <a class="btn btn-info open" data-url="galeri.php?aksi=buka&id=" data-id="<?php echo $row->id;?>" data-file="sedang" data-toggle="modal" data-target="#myModal">
							<i class="fa fa-eye" aria-hidden="true"></i>
							</a>
							<a class="btn btn-primary" href="galeri-edit-<?php echo $row->id;?>">
							<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
							</a>
							<a class="btn btn-danger" href="galeri-hapus-<?php echo $row->id;?>" onclick="return confirm('Apakah Anda yakin untuk menghapus data ini ?')">
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

<?php function edit_gambar($id){
	global $db;
        global $idu;
	?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active"><a href="galeri">Galeri</a></li>
			</ol>
		</div><!--/.row-->
	<?php
	if($_POST){
	$id=$_POST['id'];
	$idcabang=test_input($_POST['cabang']);
	if($idcabang=="other"){
	$idcabang='NULL';
	}
	$judul=test_input($_POST['judul']);
        $sql="select * from gambar where judul = '$judul' and id != $id";
        $result=$db->query($sql);
        if($result->num_rows < 1 ){
        if ($_FILES['fupload']['error'] > 0 and $_FILES['fupload']['error']!=4)
{
	echo 'Problem: ';
	switch ($_FILES['fupload']['error'])
	{
		case 1:  echo 'File exceeded upload_max_filesize';
				echo '<p><a href="galeri-edit-'.$id.'">Kembali</a></p>';
				break;
		case 2:  echo 'File exceeded max_file_size';
				echo '<p><a href="galeri-edit-'.$id.'">Kembali</a></p>';
				break;
		case 3:  echo 'File only partially uploaded';
				echo '<p><a href="galeri-edit-'.$id.'">Kembali</a></p>';
				break;
		case 4:  echo 'No file uploaded';
				echo '<p><a href="galeri-edit-'.$id.'">Kembali</a></p>';
				break;
		case 6:  echo 'Cannot upload file: No temp directory specified';
				echo '<p><a href="galeri-edit-'.$id.'">Kembali</a></p>';
				break;
		case 7:  echo 'Upload failed: Cannot write to disk';
				echo '<p><a href="galeri-edit-'.$id.'">Kembali</a></p>';
				break;
	}
	exit;
}
//direktori gambar
if($_FILES['fupload']['error']!=4){
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
  }else{
      $ima=$_POST['gambartemp'];
  }
	$sql="UPDATE `gambar` SET `idcabang` = $idcabang,`iduser`='$idu',`judul`='$judul',`gambar`='$ima' WHERE `gambar`.`id` = '$id'";
	$result=$db->query($sql);
	if(!$result){
		echo'
		<div class="alert bg-danger" role="alert">
			<svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg><a href="galeri-edit-'.$id.'"> Terjadi Kesalahan ! </a><a href="">Coba lagi</a> <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
		</div>';
		die("Could not query the database: </br>".$db->error);
	}else{
	echo'
	<div class="alert bg-success" role="alert">
		<svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg><a href="galeri-lihat"> Data Telah Ditambahkan </a><a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
	</div>';
	}    
        }else{
            echo'
                <div class="alert bg-danger" role="alert">
                    <svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg><a href="galeri-edit-'.$id.'"> Data '.$judul.' Telah Ada<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
                        </div>';
        }
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
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Galeri</h1>
			</div>
		</div><!--/.row-->
                <div class="row">
			<div class="col-lg-10 col-lg-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading">Edit : <?php echo $judul;?></div>
					<div class="panel-body">
						<div class="col-lg-9 col-lg-offset-1">
                                                    <form role="form" class="form-horizontal" action="" method="post" enctype='multipart/form-data'>		
							<input type="hidden" name="id" value="<?php echo $id;?>">
                                                        <input type="hidden" name="gambartemp" value="<?php echo $gambar; ?>">
								<div class="form-group">
									<label class="control-label col-sm-2" for="nama">Nama</label>
                                                                        <div class="col-sm-10">
                                                                            <input class="form-control nama" name="judul" id="nama" pattern="{1,50}" value="<?php echo $judul;?>" required autofocus="">
                                                                        </div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-2" for="cabang">Cabang</label>
                                                                        <div class="col-sm-10">
									<select class="form-control cab" name="cabang" id="cabang" required>
									<?php select_cabang();?>
									</select>
                                                                        </div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-2" for="gambar-prev">Gambar</label>
                                                                        <div class="col-sm-10">
                                                                        <p><img id="gambar-prev" src="../images/small_<?php echo $gambar;?>" alt="img"></img></p>
                                                                        </div>
								</div>								
								<div class="form-group">
									<label class="control-label col-sm-2" for="gambar">Upload Gambar</label>
                                                                        <div class="col-sm-10">
									<input type="file" name="fupload" id="gambar">
                                                                        </div>
								</div>
								<div class="col-sm-2"></div>
                                                            <div class="col-sm-10">
								<button type="submit" id="submit" class="btn btn-primary">Submit</button>
                                                                <a class="btn btn-info" href="galeri">Kembali</a>
                                                            </div>
                                                                </form>
							</div>
					</div>
				</div>
			</div><!-- /.col-->
		</div><!-- /.row -->
		
	</div><!--/.main-->
<?php } ?>
<?php 
function open_gambar($id){
	?>
	<div class="col-lg-12 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active"><a href="galeri">Galeri</a></li>
			</ol>
		</div><!--/.row-->
	<?php
	global $db;
        global $idu;
	$sql_select= "SELECT * FROM gambar WHERE id='$id'";
	$q= $db->query($sql_select);
	if(!$q){
		die("Could not query the database: </br>".$db->error);
	}
	while($row=$q->fetch_object()){
		$id=$row->id;
		$judul=$row->judul;
		$gambar=$row->gambar;
                $idcabang=$row->idcabang;
	}
?>	
	<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Galeri</h1>
			</div>
		</div><!--/.row-->
		<div class="row">
			<div class="col-lg-10 col-lg-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading"><?php echo $judul;?></div>
					<div class="panel-body">
						<div class="col-lg-9 col-lg-offset-1">
                                                    <div class="col-sm-12">
                                                        <div class="col-sm-2">
                                                            <label>Nama</label>
                                                        </div>
                                                        <div class="col-sm-10">
                                                            <p style="margin-left: 25px;"><?php echo $judul;?></p>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <div class="col-sm-2">
                                                            <label>Cabang</label>
                                                        </div>
                                                        <div class="col-sm-10">
                                                            <div style="margin-left: 25px;">
                                                                <?php echo cabang($idcabang);?>
                                                            </div>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <div class="col-sm-2">
                                                            <label>Gambar</label>
                                                        </div>
                                                        <div class="col-sm-10">
                                                            <img id="gambar" width="100%" style="margin-left: 25px;margin-bottom: 10px;" src="../images/small_<?php echo $gambar;?>"/>
                                                         </div>
                                                         <div class="clearfix"></div>
                                                        <div class="col-sm-2"></div>
                                                        <div class="col-sm-10">
                                                             <a class="btn btn-primary" style="margin-left: 25px;" href="galeri-edit-<?php echo $id;?>">Edit</a>
                                                        </div>
                                                        <div class="clearfix"></div>
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
		if ($aksi==null||$aksi=="lihat"){lihat_gambar();}
		else if ($aksi=='tambah'){tambah_gambar();}
		else if ($aksi=='edit'){edit_gambar($_GET['id']);}
                else if ($aksi=='buka'){open_gambar($_GET['id']);}
		else if ($aksi=='hapus'){hapus_gambar($_GET['id']);lihat_gambar();}
		?>
		