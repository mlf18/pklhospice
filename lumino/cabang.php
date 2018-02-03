<script type="text/javascript">
	function konfirmasi(){
		var pilihan = confirm("Apakh Anda yakin untuk menghapus data ini ?");		
		if(pilihan){
			return true;
		}else{
			return false;
		}
	}
</script>
<?php 
function tambah_cabang(){
	global $db;
	?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Cabang</li>
			</ol>
		</div><!--/.row-->
	<?php 
	if($_POST){
	$sql="SELECT idcabang FROM cabang";
	$result=$db->query($sql);
	if(!$result){
		die("Could not query the database: </br>".$db->error);
	}
	if($result->num_rows>0){
	while($row=$result->fetch_object()){
		$idcabang=$row->idcabang+1;
	}
	}else{
		$idcabang=1;
	}
	$lokasi=test_input($_POST['lokasi']);
	$lat=test_input($_POST['latitude']);
	$lng=test_input($_POST['longitude']);
	$kontak=test_input($_POST['kontak']);
	$alamat=test_input($_POST['alamat']);
	$sql="INSERT INTO `cabang` (`idcabang`, `alamat`, `kontak`, `lokasi`,`lat`,`lng`) VALUES ('$idcabang', '$alamat', '$kontak','$lokasi','$lat','$lng')";
	$result=$db->query($sql);
	echo'
	<div class="row">
			<div class="col-lg-12">';
	if(!$result){
		echo'
		<div class="alert bg-danger" role="alert">
			<svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg><a href="index.php?modul=2&aksi=tambah"> Terjadi Kesalahan ! <a href="">Coba lagi</a> </a><a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
		</div>';
		die("Could not query the database: </br>".$db->error);
	}else{
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
	$sql="INSERT INTO `content` (`idcontent`, `idartikel`, `idcabang`, `idcareer`, `idevent_promo`, `idfitur`, `idgambar`, `idproduk`, `idsejarah`, `idstaff`, `idvideo`, `iduser`) VALUES ('$idc', NULL, $idcabang, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1')";
	$result=$db->query($sql);
	tambah_log($idc,"tambah",$lokasi);
	echo'
	<div class="alert bg-success" role="alert">
		<svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg><a href="index.php?modul=2"> Data Telah Ditambahkan </a><a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
	</div>';
	}
	echo'
	</div>
	</div>';
	}
?>	
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Cabang</h1>
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
									<label>Lokasi</label>
									<input class="form-control" name="lokasi" required>
								</div>
								<div class="form-group">
									<label>Latitude</label>
									<input class="form-control" name="latitude" required>
								</div>
								<div class="form-group">
									<label>Longitude</label>
									<input class="form-control" name="longitude" required>
								</div>
								<div class="form-group">
									<label>Kontak</label>
									<textarea id="kontak" class="form-control" name="kontak" rows="3" required></textarea>
								</div>
								<div class="form-group">
									<label>Alamat</label>
									<textarea id="kontak" class="form-control" name="alamat" rows="3" required></textarea>
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
function lihat_cabang() {
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
				<h1 class="page-header">Cabang</h1>
			</div>
		</div><!--/.row-->	
		<?php 
		$sql= "SELECT idcabang,lokasi,alamat,kontak FROM cabang";
		$result=$db->query($sql);
		?>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading"><a href = "index.php?modul=2&aksi=tambah" class="btn btn-primary"><svg class="glyph stroked plus sign"><use xlink:href="#stroked-plus-sign"/></svg> Tambah</a></div>
					<div class="panel-body">
						<table data-toggle="table" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="asc">
						    <thead>
						    <tr>
						        <th>No</th>
						        <th>Lokasi</th>
						        <th>Alamat</th>
								<th>Kontak</th>
						        <th>aksi</th>
						    </tr>
						    </thead>
							<?php while($row=$result->fetch_object()){?>
							<tr>
							<td><?php echo $i;?></td>
							<td><?php echo $row->lokasi;?></td>
							<td><?php echo $row->alamat;?></td>
							<td><?php echo $row->kontak;?></td>
							<td>
							<a class="btn btn-primary" href="index.php?modul=2&aksi=edit&id=<?php echo $row->idcabang;?>">
							<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
							</a>
							&nbsp;
							<a class="btn btn-danger" href="index.php?modul=2&aksi=hapus&id=<?php echo $row->idcabang;?>" onclick="return confirm('Apakah Anda yakin untuk menghapus data ini ?')">
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
	function hapus_cabang($idcabang){
	global $db;
	$sql="select lokasi FROM `cabang` WHERE `cabang`.`idcabang` = $idcabang";
	$result=$db->query($sql);
	$row=$result->fetch_object();
	$lokasi=$row->lokasi;
	$sql="select idcontent FROM `content` WHERE `content`.`idevent_promo` = $idcabang";
	$result=$db->query($sql);
	$idk=$result->idcontent;
	$sql="DELETE FROM `content` WHERE `content`.`idcabang` = $idcabang";
	$result=$db->query($sql);
	$sql="DELETE FROM `cabang` WHERE `cabang`.`idcabang` = $idcabang";
	$result=$db->query($sql);
	if(!$result){
		die("Could not query the database: </br>".$db->error);
	}else{
		tambah_log($idk,"hapus",$lokasi);
	}
	} 
?>
<?php 
function edit_cabang($id){
	?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Cabang</li>
			</ol>
		</div><!--/.row-->
	<?php
	global $db;
	if($_POST){
	$idcabang=test_input($_POST['id']);
	$lokasi=test_input($_POST['lokasi']);
	$kontak=test_input($_POST['kontak']);
	$alamat=test_input($_POST['alamat']);
	$lat=test_input($_POST['latitude']);
	$lng=test_input($_POST['longitude']);
	$sql="UPDATE `cabang` SET `alamat`='$alamat',`kontak` = '$kontak',`lokasi`='$lokasi',`lat`='$lat',`lng`='$lng' WHERE `cabang`.`idcabang` = '$idcabang'";
	$result=$db->query($sql);
	echo'
	<div class="row">
			<div class="col-lg-12">';
	if(!$result){
		echo'
		<div class="alert bg-danger" role="alert">
			<svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg><a href="index.php?modul=2&aksi=edit&id='.$id.'"> Terjadi Kesalahan ! <a href="">Coba lagi</a> </a><a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
		</div>';
		die("Could not query the database: </br>".$db->error);
	}else{
		echo'
		<div class="alert bg-success" role="alert">
			<svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg><a href="index.php?modul=2"> Data Telah Diubah </a><a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
		</div>';
	$sql="SELECT idcontent FROM `content` where idcabang = $id";
	$result=$db->query($sql);
	if(!$result){
	die("Could not query the database: </br>".$db->error);
	}
	$row=$result->fetch_object();
	tambah_log($row->idcontent,"edit",$lokasi);
	}
	echo'
	</div>
	</div>';
	}
	$sql_select= "SELECT * FROM cabang WHERE idcabang='$id'";
	$q= $db->query($sql_select);
	if(!$q){
		die("Could not query the database: </br>".$db->error);
	}
	while($row=$q->fetch_object()){
		$idcabang=$row->idcabang;
		$alamat=$row->alamat;
		$kontak=$row->kontak;
		$lokasi=$row->lokasi;
		$lat=$row->lat;
		$long=$row->lng;
	}
	
?>	
	<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Cabang</h1>
			</div>
		</div><!--/.row-->
				
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Form</div>
					<div class="panel-body">
						<div class="col-md-8">
							<form role="form" action="" method="post" enctype='multipart/form-data'>							
							<input type="hidden" name="id" value="<?php echo $idcabang; ?>">
								<div class="form-group">
									<label>Lokasi</label>
									<input class="form-control" name="lokasi" value="<?php echo $lokasi;?>" required>
								</div>
								<div class="form-group">
									<label>Latitude</label>
									<input class="form-control" name="latitude" value="<?php echo $lat;?>" required>
								</div>
								<div class="form-group">
									<label>Longitude</label>
									<input class="form-control" name="longitude" value="<?php echo $long;?>" required>
								</div>
								<div class="form-group">
									<label>Kontak</label>
									<textarea id="kontak" class="form-control" name="kontak" rows="3" required><?php echo $kontak;?></textarea>
								</div>
								<div class="form-group">
									<label>Alamat</label>
									<textarea id="alamat" class="form-control" name="alamat" rows="3" required><?php echo $alamat;?></textarea>
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
		if ($aksi=="" || $aksi=="lihat"){lihat_cabang();}
		else if ($aksi=='tambah'){tambah_cabang();}
		else if ($aksi=='edit'){
		if(!empty($_GET['id'])){
			edit_cabang($_GET['id']);}
		}
		else if ($aksi=='hapus'){
		if(!empty($_GET['id'])){
			hapus_cabang($_GET['id']);lihat_cabang();}
		}
?>