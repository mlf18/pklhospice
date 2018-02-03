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
	if($_POST){
	$id=$_POST['id'];
	$judul=test_input($_POST['judul']);
	$isi=test_input($_POST['isi']);
	$sql="INSERT INTO `video` (`id`, `nama`,`judul`, `isi`) VALUES ('1','video', '$judul','$isi')";
	$result=$db->query($sql);
	echo'
	<div class="row">
			<div class="col-lg-12">';
	if(!$result){
		echo'
		<div class="alert bg-warning" role="alert">
					<a href="index.php?modul=6&aksi=edit&id='.$id.'">Terjadi Masalah Silahkan Coba Lagi</a> <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
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
	$sql="INSERT INTO `content` (`idcontent`, `idartikel`, `idcabang`, `idcareer`, `idevent_promo`, `idfitur`, `idgambar`, `idproduk`, `idsejarah`, `idstaff`, `idvideo`, `iduser`) VALUES ('$idc', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$id', NULL, '1')";
	$result=$db->query($sql);
	tambah_log($idc,"tambah",$judul);
	echo'
		<div class="alert bg-success" role="alert">
			<svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg><a href="index.php?modul=6"> Data Telah Diubah </a><a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
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
									<input class="form-control" name="judul" required>
								</div>
								<div class="form-group">
									<label>Isi</label>
									<input class="form-control" name="isi" required>
								</div>
								<button type="submit" class="btn btn-primary">Submit</button>
								<button type="reset" class="btn btn-default">Reset</button>
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
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Icons</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Video</h1>
			</div>
		</div><!--/.row-->
				
		<?php 
		$sql= "SELECT id,judul,isi FROM video";
		$result=$db->query($sql);
		?>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
				<?php 
				if ($result->num_rows < 1){
				?>
					<div class="panel-heading"><a href = "index.php?modul=6&aksi=tambah" class="btn btn-primary"><svg class="glyph stroked plus sign"><use xlink:href="#stroked-plus-sign"/></svg> Tambah</a></div>
					<div class="panel-body">
				<?php } ?>
						<table data-toggle="table" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="asc">
						    <thead>
						    <tr>
						        <th>No</th>
						        <th>Judul</th>
						        <th>Video</th>
						        <th>Aksi</th>
						    </tr>
						    </thead>
							<?php while($row=$result->fetch_object()){?>
							<tr>
							<td><?php echo $i;?></td>
							<td><?php echo $row->judul;?></td>
							<td><iframe width="100%" src="<?php echo $row->isi; ?>" frameborder="0" allowfullscreen> </iframe></td>
							<td>
							<a class="btn btn-primary" href="index.php?modul=6&aksi=edit&id=<?php echo $row->id;?>">
							<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
							</a>
							&nbsp;
							<a class="btn btn-danger" href="index.php?modul=6&aksi=hapus&id=<?php echo $row->id;?>" onclick="return confirm('Apakah Anda yakin untuk menghapus data ini ?')">
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
	function hapus_video($id){
	global $db;
	$sql="select judul FROM `video` WHERE `video`.`id` = $id";
	$result=$db->query($sql);
	$row=$result->fetch_object();
	$judul=$row->judul;
	$sql="select idcontent FROM `content` WHERE `content`.`idvideo` = $id";
	$result=$db->query($sql);
	$row=$result->fetch_object();
	$idc=$row->idcontent;
	$sql="DELETE FROM `content` WHERE `content`.`idvideo` = $id";
	$result=$db->query($sql);
	$sql="DELETE FROM `video` WHERE `video`.`id` = $id";
	$result=$db->query($sql);
	if(!$result){
		die("Could not query the database: </br>".$db->error);
	}else{
		tambah_log($idc,"hapus",$judul);
	}
	} 
?>
<?php 
function edit_video($id){
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
	if($_POST){
	$id=$_POST['id'];
	$judul=test_input($_POST['judul']);
	$isi=test_input($_POST['isi']);
	$sql="UPDATE `video` SET `judul` = '$judul',`isi`='$isi' WHERE `video`.`id` = '$id'";
	$result=$db->query($sql);
	echo'
	<div class="row">
			<div class="col-lg-12">';
	if(!$result){
		echo'
		<div class="alert bg-warning" role="alert">
					<a href="index.php?modul=6&aksi=edit&id='.$id.'">Terjadi Masalah Silahkan Coba Lagi</a> <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
		</div>';
		die("Could not query the database: </br>".$db->error);
	}
	else{
	echo'
		<div class="alert bg-success" role="alert">
			<svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg><a href="index.php?modul=6"> Data Telah Diubah </a><a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
		</div>';
	$sql="SELECT idcontent FROM `content` where idvideo = $id";
	$result=$db->query($sql);
	if(!$result){
	die("Could not query the database: </br>".$db->error);
	}
	$row=$result->fetch_object();
	tambah_log($row->idcontent,"edit",$judul);
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
									<input class="form-control" name="isi" value="<?php echo $isi;?>" required>
								</div>
								<button type="submit" class="btn btn-primary">Submit</button>
								<button type="reset" class="btn btn-default">Reset</button>
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
		if ($aksi==null){lihat_video();}
		else if ($aksi=='tambah'){tambah_video();}
		else if ($aksi=='edit'){edit_video($_GET['id']);}
		else if ($aksi=='hapus'){hapus_video($_GET['id']);lihat_video();}
?>