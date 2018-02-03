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
<?php function tambah_cabang(){
	global $db;
	if($_POST){
	$sql="SELECT idcabang FROM cabang";
	$result=$db->query($sql);
	if(!$result){
		die("Could not query the database: </br>".$db->error);
	}
	if($result->num_rows>0){
	while($row=$result->fetch_object()){
		$idcabang=$row->idcabang;
	}
	}else{
		$idcabang=0;
	}
	$lokasi=test_input($_POST['lokasi']);
	$lat=test_input($_POST['lat']);
	$lng=test_input($_POST['long']);
	$kontak=test_input($_POST['kontak']);
	$alamat=test_input($_POST['alamat']);
	$sql="INSERT INTO `cabang` (`idcabang`, `alamat`, `kontak`, `lokasi`,`posisi`,`lat`,`lng`) VALUES ('$idcabang', '$alamat', '$kontak','$lokasi','$posisi','$lat','$lng')";
	$result=$db->query($sql);
	if(!$result){
		echo'
		<div class="alert alert-danger">
			<strong>Error!</strong> <a href="body.php?modul=6&aksi=edit">Try Again</a>
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
			$id=$row->idcontent+1;
		}
	}else{
		$id=0;
	}
	$sql="INSERT INTO `content` (`idcontent`, `idartikel`, `idcabang`, `idcareer`, `idevent_promo`, `idfitur`, `idgambar`, `idproduk`, `idsejarah`, `idstaff`, `iduser`) VALUES ("", NULL, '$idcabang', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1')";
	$result=$db->query($sql);
	}
	echo'
	<div class="alert alert-success">
		<strong>Success!</strong> <a href="body.php?modul=6">Kembali</a>
	</div>';
	}
?>
	<div class="box-content">	
			<form class="form-horizontal" name="postform" action="" method="post" enctype='multipart/form-data'>
				<fieldset>
				  <div class="control-group">
					<label class="control-label">Lokasi</label>
					<div class="controls">
					  <input id="lokasi" type="text" name="lokasi" pattern="[0-9A-Za-z,-,',., ]*"  class="span6 typehead" required>
					</div>
				  </div>
				  <iframe src="http://www.latlong.net/" height="100px" width="300px"></iframe>
				  <div class="control-group">
					<label class="control-label">Latitude</label>
					<div class="controls">
					  <input id="lat" type="text" name="lat" pattern="[0-9,-,',., ]*" class="span6 typehead" required>
					</div>
				  </div>				  
				  <div class="control-group">
					<label class="control-label">Longitude</label>
					<div class="controls">
					  <input id="long" type="text" name="long" pattern="[0-9,-,',., ]*" class="span6 typehead" required>
					</div>
				  </div>		
				  <div class="control-group">
					<label class="control-label">Kontak</label>
					<div class="controls">
					  <textarea class="span6 typehead" id="kontak" name="kontak" required></textarea>
					</div>
				  </div>				  
				  <div class="control-group">
					<label class="control-label">Alamat</label>
					<div class="controls">
					  <textarea class="span6 typehead" id="alamat" name="alamat" required></textarea>
					</div>
				  </div>
				  <div class="form-actions">
					<button type="submit" class="btn btn-primary">Submit</button>
				  </div>
				</fieldset>
			  </form>
		
</div> <?php } ?>
<?php 
	function hapus_cabang($idcabang){
	global $db;
	$sql="DELETE FROM `content` WHERE `content`.`idartikel` = $idcabang";
	$result=$db->query($sql);
	$sql="DELETE FROM `cabang` WHERE `cabang`.`idcabang` = $idcabang";
	$result=$db->query($sql);
	if(!$result){
		die("Could not query the database: </br>".$db->error);
	}
	} 
?>
<?php function lihat_cabang(){ 
global $db;?>
<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Data cabang</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<?php							
						$sql= "SELECT * FROM cabang";
						$q= $db->query($sql);
					?>
					
					<div class="box-content">
					<a href="body.php?modul=6&aksi=tambah" class="btn btn-primary"><i class="halflings-icon white plus-sign"></i>Tambah cabang</a>
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th style="width:30px;">No</th>
								  <th>Lokasi</th>
								  <th>Alamat</th>
								  <th>Kontak</th>
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
								<td class="center"><?php echo $row->lokasi; ?></td>
								<td class="center"><?php echo $row->alamat; ?></td>
								<td class="center"><?php echo $row->kontak; ?></td>
								<td class="center">
									<?php echo '<a class="btn btn-info" href="body.php?modul=6&aksi=edit&id='.$row->idcabang.'">'; ?>
										<i class="halflings-icon white edit"></i>
									</a>
									<?php echo '<a class="btn btn-danger" href="body.php?modul=6&aksi=hapus&id='.$row->idcabang.'"onclick="return confirm (\'Apakah Anda yakin ingin menghapus data?\');" >';?>
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

<?php function edit_cabang($idcabang){
	global $db;
	if($_POST){
	$lokasi=test_input($_POST['lokasi']);
	$kontak=test_input($_POST['kontak']);
	$alamat=test_input($_POST['alamat']);
	$lat=test_input($_POST['lat']);
	$lng=test_input($_POST['long']);
	$sql="UPDATE `cabang` SET `alamat`='$alamat',`kontak` = '$kontak',`lokasi`='$lokasi',`lat`='$lat',`lng`='$lng' WHERE `cabang`.`idcabang` = '$idcabang'";
	$result=$db->query($sql);
	if(!$result){
		echo'
		<div class="alert alert-danger">
			<strong>Error!</strong> <a href="body.php?modul=6&aksi=edit">Try Again</a>
		</div>';
		die("Could not query the database: </br>".$db->error);
	}
	echo'
	<div class="alert alert-success">
		<strong>Success!</strong> <a href="body.php?modul=6">Kembali</a>
	</div>';
	}
	$sql_select= "SELECT * FROM cabang WHERE idcabang='$idcabang'";
	$q= $db->query($sql_select);
	if(!$q){
		die("Could not query the database: </br>".$db->error);
	}
	while($row=$q->fetch_object()){
		$alamat=$row->alamat;
		$kontak=$row->kontak;
		$lokasi=$row->lokasi;
	}
	
?>
	<div class="box-content">	
			<form class="form-horizontal" name="postform" action="" method="post" enctype='multipart/form-data'>
				<fieldset>
				  <div class="control-group">
					<label class="control-label">Lokasi</label>
					<div class="controls">
					  <input id="lokasi" type="text" name="lokasi" pattern="[0-9A-Za-z,-,',., ]*"  class="span6 typehead" value="<?php echo $lokasi;?>" required/>
					</div>
				  </div>
				  <div class="control-group">
					<label class="control-label">Latitude</label>
					<div class="controls">
					  <input id="lat" type="text" name="lat" pattern="[0-9,-,',., ]*" class="span6 typehead" required>
					</div>
				  </div>				  
				  <div class="control-group">
					<label class="control-label">Longitude</label>
					<div class="controls">
					  <input id="long" type="text" name="long" pattern="[0-9,-,',., ]*" class="span6 typehead" required>
					</div>
				  </div>				  
				  <div class="control-group">
					<label class="control-label">Kontak</label>
					<div class="controls">
					  <textarea class="span6 typehead" id="kontak" name="kontak" required><?php echo $kontak;?></textarea>
					</div>
				  </div>				  
				  <div class="control-group">
					<label class="control-label">Alamat</label>
					<div class="controls">
					  <textarea class="span6 typehead" id="alamat" name="alamat" required><?php echo $alamat;?></textarea>
					</div>
				  </div>
				  <div class="form-actions">
					<button type="submit" class="btn btn-primary">Save changes</button>
					<a class="btn" href="body.php?modul=6">Cancel</a>
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
		if ($aksi==null){lihat_cabang();}
		else if ($aksi=='tambah'){tambah_cabang();}
		else if ($aksi=='edit'){edit_cabang($_GET['id']);}
		else if ($aksi=='hapus'){hapus_cabang($_GET['id']);lihat_cabang();}
		?>
		