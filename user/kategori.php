	<?php 
	function tambah_kategori($kategori){
	global $db;
	if($_POST){
	$sql="SELECT id FROM kategori_$kategori";
	$result=$db->query($sql);
	if(!$result){
		die("Could not query the database: </br>".$db->error);
	}
	$id=$result->num_rows+1;
	$kategori=test_input($_POST['kategori']);
	$kat=test_input($_POST['isi']);
	$sql="INSERT INTO `kategori_$kategori` (`id`, `kategori`) VALUES ('$id', '$kat')";
	$result=$db->query($sql);
	if(!$result){
		echo'
		<div class="alert alert-danger">
			<strong>Error!</strong> <a href="body.php?modul=14&aksi=tambah&kategori='.$kategori.'">Try Again</a>
		</div>';
		die("Could not query the database: </br>".$db->error);
	}
	echo'
	<div class="alert alert-success">
		<strong>Success!</strong> <a href="body.php?modul=14&kategori='.$kategori.'">Kembali</a>
	</div>';
	}
?>
	<div class="box-content">	
			<form class="form-horizontal" name="postform" action="" method="post" enctype='multipart/form-data'>
			<input type="hidden" name="kategori" value="<?php echo $kategori;?>"/>
				<fieldset>
				  <div class="control-group">
					<label class="control-label">Kategori</label>
					<div class="controls">
					  <input id="isi" type="text" name="isi" pattern="[0-9A-Za-z,-,',., ]*"  class="span6 typehead" required>
					</div>
				  </div>
				  <div class="form-actions">
					<button type="submit" class="btn btn-primary">Save</button>
				  </div>
				</fieldset>
			  </form>
		
</div> <?php } ?>
<?php 
	function hapus_kategori($kategori,$id){
	global $db;
	$sql="DELETE FROM `kategori_$kategori` WHERE `kategori_$kategori`.`id` = $id";
	$result=$db->query($sql);
	if(!$result){
		die("Could not query the database: </br>".$db->error);
	}
	} 
?>
<?php function lihat_kategori($kategori){ 
global $db;?>
<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Data user</h2>
					</div>
					<div class="box-content">
					<a href="body.php?modul=14&aksi=tambah&kategori=<?php echo $kategori;?>" class="btn btn-primary"><i class="halflings-icon white plus-sign"></i>Tambah user</a>
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th style="width:30px;">No</th>
								  <th>Kategori</th>
								  <th>Aksi</th>
							  </tr>
							</thead>
					<tbody>
						<?php
						$sql= "SELECT * FROM kategori_$kategori order by id asc";
						$q= $db->query($sql);
						$n=1;
						if($n > 0) {
							while($row=$q->fetch_object()){
							
						?>
						
							<tr>
								<td><?php echo $n; ?></td>
								<td class="center"><?php echo $row->kategori; ?></td>
								<td class="center">
									<?php echo '<a class="btn btn-info" href="body.php?modul=14&aksi=edit&id='.$row->id.'&kategori='.$kategori.'">'; ?>
										<i class="halflings-icon white edit"></i>
									</a>
									<?php echo '<a class="btn btn-danger" href="body.php?modul=14&aksi=hapus&id='.$row->id.'&kategori='.$kategori.'"onclick="return confirm (\'Apakah Anda yakin ingin menghapus data?\');" >';?>
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
						
						  
						  <?php $n++;}}
						  ?>
					  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->

	<?php } ?>	

<?php function edit_kategori($kategori,$id){
	global $db;
	if($_POST){
	$kategori=test_input($_POST['kategori']);
	$kat=test_input($_POST['isi']);
	$sql="UPDATE `kategori_$kategori` SET `kategori`='$kat' WHERE `kategori_$kategori`.`id` = '$id'";
	$result=$db->query($sql);
	if(!$result){
		echo'
		<div class="alert alert-danger">
			<strong>Error!</strong> <a href="body.php?modul=14&aksi=edit&kategori='.$kategori.'">Try Again</a>
		</div>';
		die("Could not query the database: </br>".$db->error);
	}
	echo'
	<div class="alert alert-success">
		<strong>Success!</strong> <a href="body.php?modul=14&kategori='.$kategori.'">Kembali</a>
	</div>';
	}
	$sql_select= "SELECT * FROM kategori_$kategori WHERE id='$id'";
	$q= $db->query($sql_select);
	if(!$q){
		die("Could not query the database: </br>".$db->error);
	}
	while($row=$q->fetch_object()){
		$id=$row->id;
		$kat=$row->kategori;
	}
	
?>
	<div class="box-content">	
			<form class="form-horizontal" name="postform" action="" method="post" enctype='multipart/form-data'>
			<input type="hidden" name="id" value="<?php echo $id;?>"/>
			<input type="hidden" name="kategori" value="<?php echo $kategori;?>"/>
				<fieldset>
				  <div class="control-group">
					<label class="control-label">Kategori</label>
					<div class="controls">
					  <input id="isi" type="text" name="isi" pattern="[0-9A-Za-z,-,',., ]*"  class="span6 typehead" value="<?php echo $kat;?>" required/>
					</div>
				  </div>
				  <div class="form-actions">
					<button type="submit" class="btn btn-primary">Save changes</button>
					<a class="btn" href="body.php?modul=14">Cancel</a>
				  </div>
				</fieldset>
			  </form>		
</div><?php } 
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
		if ($aksi==null){lihat_kategori($_GET['kategori']);}
		else if ($aksi=='tambah'){tambah_kategori($_GET['kategori']);}
		else if ($aksi=='edit'){edit_kategori($_GET['kategori'],$_GET['id']);}
		else if ($aksi=='hapus'){hapus_kategori($_GET['kategori'],$_GET['id']);lihat_kategori($_GET['kategori']);}
		?>
		