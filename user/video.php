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
<?php function tambah_video(){
	global $db;
	if($_POST){
	$nama=$_POST['nama'];
	$url=$_POST['url'];
	$sql="INSERT INTO `video` (`id`, `nama`,`judul`, `isi`,`tanggal`) VALUES ('1','video', '$nama','$url',now())";
	$result=$db->query($sql);
	if(!$result){
		echo'
		<div class="alert alert-danger">
			<strong>Error!</strong> <a href="body.php?modul=7&aksi=tambah">Try Again</a>
		</div>';
		die("Could not query the database: </br>".$db->error);
	}
	echo'
	<div class="alert alert-success">
		<strong>Success!</strong> <a href="body.php?modul=7">Kembali</a>
	</div>';
	}
?>
	<div class="box-content">	
			<form class="form-horizontal" name="postform" action="" method="post" enctype='multipart/form-data'>
				<fieldset>
				  <div class="control-group">
					<label class="control-label">Nama</label>
					<div class="controls">
					  <input id="nama" type="text" name="nama" pattern="[0-9A-Za-z,-,',., ]*"  class="span6 typehead">
					</div>
				  </div>
				  <div class="control-group">
					<label class="control-label">Url</label>
					<div class="controls">
					  <input id="url" type="url" name="url" class="span6 typehead">
					</div>
				  </div>
				  <div class="form-actions">
					<button type="submit" class="btn btn-primary">Submit</button>
				  </div>
				</fieldset>
			  </form>
		
</div> <?php } ?>
<?php 
	function hapus_video(){
	global $db;
	$sql="DELETE FROM `video` WHERE `video`.`id` = '1'";
	$result=$db->query($sql);
	if(!$result){
		die("Could not query the database: </br>".$db->error);
	}
	} 
?>	
<?php function lihat_video(){ 
global $db;?>
<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Data event_promo</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<?php							
						$sql= "SELECT judul,isi,tanggal FROM video";
						$q= $db->query($sql);
					?>
					
					<div class="box-content">
					<?php 
					$n=$q->num_rows;
					if($n==0){
						echo '<a href="body.php?modul=7&aksi=tambah" class="btn btn-primary"><i class="halflings-icon white plus-sign"></i>Tambah Video</a>';
					}
					?>
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th style="width:30px;">No</th>
								  <th>Nama</th>
								  <th>Video</th>
								  <th>Tanggal</th>
								  <th style="width:88px;">Aksi</th>
							  </tr>
							</thead>
					<tbody>
						<?php
						if($n > 0) {
							while($row=$q->fetch_object()){
							
						?>
						
							<tr>
								<td><?php echo $n; ?></td>
								<td class="center"><?php echo $row->judul; ?></td>
								<td class="center"><iframe width="100%" src="<?php echo $row->isi; ?>" frameborder="0" allowfullscreen> </iframe></td>
								<td class="center"><?php echo $row->tanggal; ?></td>
								<td class="center">
									<?php echo '<a class="btn btn-info" href="body.php?modul=7&aksi=edit">'; ?>
										<i class="halflings-icon white edit"></i>
									</a>
									<?php echo '<a class="btn btn-danger" href="body.php?modul=7&aksi=hapus"onclick="return confirm (\'Apakah Anda yakin ingin menghapus data?\');" >';?>
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
	
<?php function edit_video(){
	global $db;
	
	if($_POST){
	$nama=$_POST['nama'];
	$url=$_POST['url'];
	$sql="UPDATE `video` SET `judul` = '$nama',`isi`='$url',`tanggal`=now() WHERE `video`.`id` = '1'";
	$result=$db->query($sql);
	if(!$result){
		echo'
		<div class="alert alert-danger">
			<strong>Error!</strong> <a href="body.php?modul=7&aksi=tambah">Try Again</a>
		</div>';
		die("Could not query the database: </br>".$db->error);
	}
	echo'
	<div class="alert alert-success">
		<strong>Success!</strong> <a href="body.php?modul=7">Kembali</a>
	</div>';
	}
	$sql_select= "SELECT judul,isi FROM `video`";
	$q= $db->query($sql_select);
	if(!$q){
		die("Could not query the database: </br>".$db->error);
	}
	while($row=$q->fetch_object()){
		$judul=$row->judul;
		$url=$row->isi;
	}
	
?>
	<div class="box-content">	
			<form class="form-horizontal" name="postform" action="" method="post" enctype='multipart/form-data'>
				<fieldset>
				<input type="hidden" id="id" name="id" value="<?php echo $idp;?>">
				  <div class="control-group">
					<label class="control-label">Nama</label>
					<div class="controls">
					  <input id="nama" type="text" name="nama" pattern="[0-9A-Za-z,-,',., ]*"  class="span6 typehead" value="<?php echo $judul;?>">
					</div>
				  </div>
				  <div class="control-group">
					  <label class="control-label">Video</label>
					  <div class="controls">
						<iframe width="560" height="315" src="<?php echo $url; ?>" frameborder="0" allowfullscreen> </iframe>		
					  </div>
					</div>
				  <div class="control-group">
					<label class="control-label">Url</label>
					<div class="controls">
					  <input id="url" type="url" name="url" class="span6 typehead">
					</div>
				  </div>
				  <div class="form-actions">
					<button type="submit" class="btn btn-primary">Save changes</button>
					<a class="btn" href="body.php?modul=7">Cancel</a>
				  </div>
				</fieldset>
			  </form>
		</div> <?php } 
		if(empty($_GET['aksi'])){
			$aksi='';
		}else{
			$aksi=$_GET['aksi'];
		}
		if ($aksi==null){lihat_video();}
		else if ($aksi=='tambah'){tambah_video();}
		else if ($aksi=='edit'){edit_video();}
		else if ($aksi=='hapus'){hapus_video();lihat_video();}
		?>
		