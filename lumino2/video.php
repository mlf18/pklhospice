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
function tambah_video(){
	?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Video</li>
			</ol>
		</div><!--/.row-->
	<?php
	global $db;
        global $idu;
	if($_POST){
	$id=$_POST['id'];
	$judul=test_input($_POST['judul']);
	$isi=test_input($_POST['isi']);
	$sql="INSERT INTO `video` (`id`, `nama`,`judul`, `isi`,`tanggal`,`iduser`) VALUES ('1','video', '$judul','$isi',now(),'$idu')";
	$result=$db->query($sql);
	echo'
	<div class="row">
			<div class="col-lg-12">';
	if(!$result){
		echo'
		<div class="alert bg-warning" role="alert">
					<a href="video-edit-'.$id.'">Terjadi Masalah Silahkan Coba Lagi</a> <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
		</div>';
		die("Could not query the database: </br>".$db->error);
	}
	else{
	echo'
		<div class="alert bg-success" role="alert">
			<svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg><a href="video-lihat"> Data Telah Diubah </a><a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
		</div>';
	}
	echo'
	</div>
	</div>';
	}
?>	
	<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Video</h1>
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
                                                                        <input class="form-control" name="judul" pattern="{1,50}" required>
								</div>
								<div class="form-group">
									<label>Url</label>
                                                                        <input type="url" class="form-control" name="isi" required>
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
function lihat_video() {
	global $db;
	$i=1;?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Video</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Video</h1>
			</div>
		</div><!--/.row-->
				
		<?php 
		$sql= "SELECT id,judul,tanggal FROM video";
		$result=$db->query($sql);
		?>
		<div class="row">
			<div class="col-md-12 col-xs-12">
				<div class="panel panel-default">	
				<?php 
                                $_SESSION['tambah']=0;
				if ($result->num_rows < 1){
                                    $_SESSION['tambah']=1;
				?>
					<div class="panel-heading"><a href = "video-tambah" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Tambah</a></div>
				<?php } ?>
                                            <div class="panel-body">
                                            <div class="col-lg-12 col-md-12 col-xs-12">
                                            <div class='table-responsive'>
                                                <table id='table' class="display table table-striped table-bordered">
						    <thead>
						    <tr>
						        <th>No</th>
						        <th>Judul</th>
						        <th>Tanggal</th>
						        <th>Aksi</th>
						    </tr>
						    </thead>
							<?php while($row=$result->fetch_object()){?>
							<tr>
							<td></td>
							<td><?php echo $row->judul;?></td>
							<td><?php echo $row->tanggal;?></td>
							<td>
                                                        <a class="btn btn-info" href="video-buka-<?php echo $row->id;?>">
							<i class="fa fa-eye" aria-hidden="true"></i>
							</a>    
							<a class="btn btn-primary" href="video-edit-<?php echo $row->id;?>">
							<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
							</a>
							<a class="btn btn-danger" href="video-hapus-<?php echo $row->id;?>" onclick="return confirm('Apakah Anda yakin untuk menghapus data ini ?')">
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
	function hapus_video($id){
	global $db;
	$sql="DELETE FROM `video` WHERE `video`.`id` = $id";
	$result=$db->query($sql);
	if(!$result){
		die("Could not query the database: </br>".$db->error);
	}
	} 
?>
<?php 
function edit_video($id){
	?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Video</li>
			</ol>
		</div><!--/.row-->
	<?php
	global $db;
        global $idu;
	if($_POST){
	$id=$_POST['id'];
	$judul=test_input($_POST['judul']);
	$isi=test_input($_POST['isi']);
	$sql="UPDATE `video` SET `judul` = '$judul',`isi`='$isi',`tanggal`=now(),`iduser`='$idu' WHERE `video`.`id` = '$id'";
	$result=$db->query($sql);
	echo'
	<div class="row">
			<div class="col-lg-12">';
	if(!$result){
		echo'
		<div class="alert bg-warning" role="alert">
					<a href="video-edit-'.$id.'">Terjadi Masalah Silahkan Coba Lagi</a> <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
		</div>';
		die("Could not query the database: </br>".$db->error);
	}
	else{
	echo'
		<div class="alert bg-success" role="alert">
			<svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg><a href="video-lihat"> Data Telah Diubah </a><a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
		</div>';
	}
	echo'
	</div>
	</div>';
	}
	$sql_select= "SELECT * FROM video WHERE id='$id'";
	$q= $db->query($sql_select);
	if(!$q){
		die("Could not query the database: </br>".$db->error);
	}
	while($row=$q->fetch_object()){
		$id=$row->id;
		$judul=$row->judul;
		$isi=$row->isi;
	}
?>	
	<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Video</h1>
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
									<input class="form-control" name="judul" value="<?php echo $judul;?>" required>
								</div>
								<div class="form-group">
									<label>Video</label>
									<iframe width="100%" src="<?php echo $isi; ?>" frameborder="0" allowfullscreen> </iframe>
								</div>
								<div class="form-group">
									<label>Isi</label>
                                                                        <input class="form-control" type="url" name="isi" value="<?php echo $isi;?>" required>
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
function open_video($id){
	?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Video</li>
			</ol>
		</div><!--/.row-->
	<?php
	global $db;
        global $idu;
	$sql_select= "SELECT * FROM video WHERE id='$id'";
	$q= $db->query($sql_select);
	if(!$q){
		die("Could not query the database: </br>".$db->error);
	}
	while($row=$q->fetch_object()){
		$id=$row->id;
		$judul=$row->judul;
		$isi=$row->isi;
	}
?>	
	<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Produk</h1>
			</div>
		</div><!--/.row-->
				
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading"><?php echo $judul;?></div>
					<div class="panel-body">
						<div class="col-md-8">
								<div class="form-group">
									<label>Judul</label>
                                                                        <p><?php echo $judul;?></p>
								</div>
								<div class="form-group">
									<label>Video</label>
                                                                        <iframe width="100%" src="<?php echo $isi; ?>" frameborder="0" allowfullscreen> </iframe>
								</div>
                                                                <div class="form-group">
								<a class="btn btn-primary" href="video-edit-<?php echo $id;?>">Edit</a>
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
		if ($aksi==null || $aksi=="lihat"){lihat_video();}
		else if ($aksi=='tambah' && $_SESSION['tambah']==1){tambah_video();}
		else if ($aksi=='edit'){edit_video($_GET['id']);}
                else if ($aksi=='buka'){open_video($_GET['id']);}
		else if ($aksi=='hapus'){hapus_video($_GET['id']);lihat_video();}
?>