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
function tambah_fitur(){
	global $db;
	?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active"><a href="fitur">Fitur</a></li>
			</ol>
		</div><!--/.row-->
	<?php 
        global $idu;
        $deskripsiok=0;
        $msg="";
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
	$deskripsi=($_POST['deskripsi']);
        if(strlen(strip_tags($deskripsi))> 0){
            $deskripsiok=1;
        }
	$sql="select * from fitur where nama = '$nama'";
        $result=$db->query($sql);
        if($result->num_rows < 1){
            if($deskripsiok==1){
                if(isset($_FILES['fupload'])){
                    if ($_FILES['fupload']['error'] > 0){
                        echo 'Problem: ';
                        switch ($_FILES['fupload']['error']){
                            case 1:     echo 'File exceeded upload_max_filesize';
                                        echo '<p><a href="fitur-tambah">Kembali</a></p>';
                                        break;
                            case 2:     echo 'File exceeded max_file_size';
                                        echo '<p><a href="fitur-tambah">Kembali</a></p>';
                                        break;
                            case 3:     echo 'File only partially uploaded';
                                        echo '<p><a href="fitur-tambah">Kembali</a></p>';
                                        break;
                            case 4:     echo 'No file uploaded';
                                        echo '<p><a href="fitur-tambah">Kembali</a></p>';
                                        break;
                            case 6:     echo 'Cannot upload file: No temp directory specified';
                                        echo '<p><a href="fitur-tambah">Kembali</a></p>';
                                        break;
                            case 7:     echo 'Upload failed: Cannot write to disk';
                                        echo '<p><a href="fitur-tambah">Kembali</a></p>';
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
                //proses perubahan ukuran
                $im = imagecreatetruecolor(217,138);
                imagecopyresampled($im, $im_src, 0, 0, 0, 0, 217, 138, $src_width, $src_height);
   
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
                $dst_width2 = 64;
                $dst_height2 = 64;

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
                imagedestroy($im2);
                unlink($vfile_upload);
                }
            $sql="INSERT INTO `fitur` (`id`, `nama`,`deskripsi`,`gambar`,`tanggal`,`iduser`) VALUES ('$id', '$nama','$deskripsi','$ima',now(),'$idu')";
            $result=$db->query($sql);
            echo'
                <div class="row">
                    <div class="col-lg-12">';
            if(!$result){
		echo'
                    <div class="alert bg-danger" role="alert">
			<svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg><a href="fitur-tambah"> Terjadi Kesalahan !</a> <a href="">Coba lagi</a> <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
                            </div>';
		die("Could not query the database: </br>".$db->error);
            }else{
            echo'
                <div class="alert bg-success" role="alert">
                    <svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg><a href="fitur-lihat"> Data Telah Ditambahkan </a><a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
                        </div>';
            }
            echo'
                </div>
                    </div>';
            }else{
                $msg='* Deskripsi Tidak Boleh Kosong';
            }
        }else{
            echo'
                <div class="alert bg-danger" role="alert">
                    <svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg><a href="fitur-tambah"> Data '.$nama.' Telah Ada<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
                        </div>';
        }
	}
?>	
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Fitur</h1>
			</div>
		</div><!--/.row-->
		<div class="row">
			<div class="col-lg-10 col-lg-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading">Tambah Fitur</div>
					<div class="panel-body">
						<div class="col-lg-9 col-lg-offset-1">
							<form role="form" class ="form-horizontal" id="form" action="" method="post" enctype='multipart/form-data'>		
								<div class="form-group">
								<label class="control-label col-sm-2" for="nama">Nama</label>
                                                                <div class="col-sm-10">
                                                                    <input class="form-control nama" id="nama" name="nama" pattern="{1,50}" placeholder="Nama Fitur" autofocus required>
                                                                </div>
                                                                </div>
								<div class="form-group">
									<label class="control-label col-sm-2" for="deskripsi">Deskripsi</label>
                                                                        <div class="col-sm-10">
									<textarea id="deskripsi" class="form-control deskripsi" name="deskripsi" rows="3"></textarea>
                                                                        </div>
								</div>
                                                                 <div class="form-group">
									<label style="color: red;"></label>
								</div>								
								<div class="form-group">
									<label class="control-label col-sm-2" for="gambar">Gambar</label>
                                                                        <div class="col-sm-10">
                                                                            <input type="file" name="fupload" required="">
                                                                        </div>
								</div>
                                                            <div class="col-sm-2"></div>
                                                            <div class="col-sm-10">
								<button type="submit" id="submit" class="btn btn-primary">Submit</button>
                                                                <a class="btn btn-info" href="fitur">Kembali</a>
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
function lihat_fitur() {
	global $db;
	$i=1;?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active"><a href="fitur">Fitur</a></li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Fitur</h1>
			</div>
		</div><!--/.row-->
				
		<?php 
		$sql= "SELECT id,nama,tanggal FROM fitur";
		$result=$db->query($sql);
		?>
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2">
				<div class="panel panel-default">
                                    <div class="panel-heading"><a href = "fitur-tambah" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Tambah</a></div>
					<div class="panel-body">
                                            <div class="col-lg-9 col-lg-offset-2">
                                            <div class='table-responsive'>
                                                <table id='table' class="display table table-striped table-bordered">
						    <thead>
						    <tr>
						        <th class="nosort">No</th>
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
                                                        <a class="btn btn-info open" data-url="fitur.php?aksi=buka&id=" data-id="<?php echo $row->id;?>" data-file="sedang" data-toggle="modal" data-target="#myModal">
							<i class="fa fa-eye" aria-hidden="true"></i>
							</a>
							<a class="btn btn-primary" href="fitur-edit-<?php echo $row->id;?>">
							<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
							</a>
							<a class="btn btn-danger" href="fitur-hapus-<?php echo $row->id;?>" onclick="return confirm('Apakah Anda yakin untuk menghapus data ini ?')">
							<i class="fa fa-trash-o" aria-hidden="true"></i>
							</a>
							</td>
							</tr>
							<?php } ?>
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
	function hapus_fitur($id){
	global $db;
	$sql="select gambar from fitur where id= $id";
	$result=$db->query($sql);
	if(!$result){
		die("Could not query the database: </br>".$db->error);
	}
        if($result->num_rows > 0){
            while($row=$result->fetch_object()){
		unlink('../images/'.$row->gambar);
	}    
        }
	$sql="DELETE FROM `fitur` WHERE `fitur`.`id` = $id";
	$result=$db->query($sql);
	if(!$result){
		die("Could not query the database: </br>".$db->error);
	}
	} 
?>
<?php 
function edit_fitur($id){
	?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active"><a href="fitur">Fitur</a></li>
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
	$deskripsi=($_POST['deskripsi']);
	if(strlen(strip_tags($deskripsi)) > 0){
            $deskripsiok=1;
        }
        $sql="select * from fitur where nama ='$nama' and id != $id";
        $result=$db->query($sql);
        if($result->num_rows < 1){
            if($deskripsiok==1){
                    if ($_FILES['fupload']['error'] > 0 and $_FILES['fupload']['error'] != 4){
                        echo 'Problem: ';
                        switch ($_FILES['fupload']['error'] and $_FILES['fupload']['error']!=4){
                        case 1:  echo 'File exceeded upload_max_filesize';
				echo '<p><a href="fitur-edit-'.$id.'">Kembali</a></p>';
				break;
                        case 2:  echo 'File exceeded max_file_size';
				echo '<p><a href="fitur-edit-'.$id.'">Kembali</a></p>';
				break;
                        case 3:  echo 'File only partially uploaded';
				echo '<p><a href="fitur-edit-'.$id.'">Kembali</a></p>';
				break;
                        case 4:  echo 'No file uploaded';
				echo '<p><a href="fitur-edit-'.$id.'">Kembali</a></p>';
				break;
                        case 6:  echo 'Cannot upload file: No temp directory specified';
				echo '<p><a href="fitur-edit-'.$id.'">Kembali</a></p>';
				break;
                        case 7:  echo 'Upload failed: Cannot write to disk';
				echo '<p><a href="fitur-edit-'.$id.'">Kembali</a></p>';
				break;
                    }
                    exit;
                }
            if($_FILES['fupload']['error']!= 4){
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
            //proses perubahan ukuran
            $im = imagecreatetruecolor(217,138);
            imagecopyresampled($im, $im_src, 0, 0, 0, 0, 217, 138, $src_width, $src_height);
   
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
            $dst_width2 = 64;
            $dst_height2 = 64;
                
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
            }else{
                $ima=$_POST['gambartemp'];
            }
            $sql="UPDATE `fitur` SET `nama` = '$nama',`deskripsi`='$deskripsi',`gambar`='$ima',`tanggal`=now(),`iduser`='$idu' WHERE `fitur`.`id` = '$id'";
            $result=$db->query($sql);
            echo'
                <div class="row">
			<div class="col-lg-12">';
            if(!$result){
		echo'
                    <div class="alert bg-warning" role="alert">
			<a href="fitur-edit-'.$id.'">Terjadi Masalah Silahkan Coba Lagi</a> <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
                            </div>';
                die("Could not query the database: </br>".$db->error);
            }
            else{
                echo'
                    <div class="alert bg-success" role="alert">
			<svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg><a href="index.php?modul=12"> Data Telah Diubah </a><a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
                            </div>';
                }
            echo'
                </div>
                    </div>';
            }else{
                $msg='* Deskripsi Tidak Boleh Kosong';
            }
        }else{
            echo'
                <div class="alert bg-danger" role="alert">
                    <svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg><a href="fitur-edit-'.$id.'"> Data '.$nama.' Telah Ada<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
                        </div>';
        }
	}
	$sql_select= "SELECT * FROM fitur WHERE id='$id'";
	$q= $db->query($sql_select);
	if(!$q){
		die("Could not query the database: </br>".$db->error);
	}
	while($row=$q->fetch_object()){
		$id=$row->id;
		$judul=$row->nama;
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
			<div class="col-lg-10 col-lg-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading">Edit : <?php echo $judul;?></div>
					<div class="panel-body">
						<div class="col-lg-9 col-lg-offset-1">
                                                    <form role="form" class="form-horizontal" action="" method="post" enctype='multipart/form-data'>							
							<input type="hidden" name="id" value="<?php echo $id; ?>">
                                                        <input type="hidden" name="gambartemp" value="<?php echo $gambar; ?>">
                                                                <div class="form-group">
								<label class="control-label col-sm-2" for="nama">Nama</label>
                                                                <div class="col-sm-10">
                                                                    <input class="form-control nama" id="judul" name="nama" pattern="{1,50}" placeholder="Nama Fitur" value="<?php echo $judul;?>" autofocus required>
                                                                </div>
                                                                </div>
								<div class="form-group">
									<label class="control-label col-sm-2" for="deskripsi">Deskripsi</label>
                                                                        <div class="col-sm-10">
									<textarea id="deskripsi" class="form-control deskripsi" name="deskripsi" rows="3"><?php echo $deskripsi;?></textarea>
                                                                        </div>
								</div>
                                                                 <div class="form-group">
									<label style="color: red;"></label>
								</div>								
                                                                <div class="form-group">
									<label class="control-label col-sm-2" for="gambar-prev">Gambar</label>
                                                                        <div class="col-sm-10">
                                                                            <img id="gambar-prev"src="../images/small_<?php echo $gambar;?>"/>
                                                                        </div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-2" for="gambar">Gambar</label>
                                                                        <div class="col-sm-10">
									<input type="file" name="fupload">
                                                                        </div>
								</div>
                                                            <div class="col-sm-2"></div>
                                                            <div class="col-sm-10">
								<button type="submit" id="submit" class="btn btn-primary">Submit</button>
                                                                <a class="btn btn-info" href="fitur">Kembali</a>
                                                            </div>
						</form>
                                                    </div>
					</div>
				</div>
			</div><!-- /.col-->
		</div><!-- /.row -->
		
	</div><!--/.main-->
<?php }?>
<?php 
function open_fitur($id){
	?>
	<div class="col-lg-12 main">		
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active"><a href="fitur">Fitur</a></li>
			</ol>
		</div><!--/.row-->
	<?php
	global $db;
        global $idu;
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
			<div class="col-lg-10 col-lg-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading"><?php echo $nama;?></div>
					<div class="panel-body">
						<div class="col-lg-9 col-lg-offset-1">
                                                    <div class="col-sm-12">
                                                        <div class="col-sm-2">
                                                            <label>Nama</label>
                                                        </div>
                                                        <div class="col-sm-10">
                                                            <p style="margin-left: 25px;"><?php echo $nama;?></p>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <div class="col-sm-2">
                                                            <label>Deskripsi</label>
                                                        </div>
                                                        <div class="col-sm-10">
                                                            <div style="margin-left: 25px;">
                                                                <?php echo html_entity_decode(stripslashes($deskripsi));?>
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
                                                             <a class="btn btn-primary" style="margin-left: 25px;" href="fitur-edit-<?php echo $id;?>">Edit</a>
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
		if ($aksi==null || $aksi=="lihat"){lihat_fitur();}
		else if ($aksi=='tambah'){tambah_fitur();}
		else if ($aksi=='edit'){edit_fitur($_GET['id']);}
                else if ($aksi=='buka'){open_fitur($_GET['id']);}
		else if ($aksi=='hapus'){hapus_fitur($_GET['id']);lihat_fitur();}
?>