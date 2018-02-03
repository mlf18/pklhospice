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
<?php function tambah_user(){
	global $db;
	if($_POST){
	$sql="SELECT id FROM user";
	$result=$db->query($sql);
	if(!$result){
		die("Could not query the database: </br>".$db->error);
	}
	$id=$result->num_rows+1;
	$username=test_input($_POST['username']);
	$pw=md5(test_input($_POST['pw']));
	$sql="INSERT INTO `user` (`id`, `username`, `password`) VALUES ('$id', '$username', '$pw')";
	$result=$db->query($sql);
	if(!$result){
		echo'
		<div class="alert alert-danger">
			<strong>Error!</strong> <a href="body.php?modul=12&aksi=tambah">Try Again</a>
		</div>';
		die("Could not query the database: </br>".$db->error);
	}
	echo'
	<div class="alert alert-success">
		<strong>Success!</strong> <a href="body.php?modul=12">Kembali</a>
	</div>';
	}
?>
	<div class="box-content">	
			<form class="form-horizontal" name="postform" action="" method="post" enctype='multipart/form-data'>
				<fieldset>
				  <div class="control-group">
					<label class="control-label">Username</label>
					<div class="controls">
					  <input id="username" type="text" name="username" pattern="[0-9A-Za-z,-,',., ]*"  class="span6 typehead" required>
					</div>
				  </div>
				  <div class="control-group">
					<label class="control-label">Password</label>
					<div class="controls">
					  <input id="pw" type="password" name="pw" pattern="[0-9A-Za-z,-,',., ]*"  class="span6 typehead" required>
					</div>
				  </div>
				  <div class="form-actions">
					<button type="submit" class="btn btn-primary">Save</button>
				  </div>
				</fieldset>
			  </form>
		
</div> <?php } ?>
<?php 
	function hapus_user($id){
	global $db;
	$sql="DELETE FROM `user` WHERE `user`.`id` = $id";
	$result=$db->query($sql);
	if(!$result){
		die("Could not query the database: </br>".$db->error);
	}
	} 
?>
<?php function lihat_user(){ 
global $db;?>
<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Data user</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<?php
						$sql= "SELECT * FROM user where username='master'";
						$q= $db->query($sql);					
						$n=$q->num_rows;
					?>
					
					<div class="box-content">
					<?php if ($n!=0){?>
					<a href="body.php?modul=12&aksi=tambah" class="btn btn-primary"><i class="halflings-icon white plus-sign"></i>Tambah user</a><?php } ?>
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th style="width:30px;">No</th>
								  <th>Username</th>
							  </tr>
							</thead>
					<tbody>
						<?php
						$sql= "SELECT * FROM user";
						$q= $db->query($sql);
						$n=$q->num_rows;
						if($n > 0) {
							while($row=$q->fetch_object()){
							
						?>
						
							<tr>
								<td><?php echo $n; ?></td>
								<td class="center"><?php echo $row->username; ?></td>
								<td class="center">
									<?php echo '<a class="btn btn-info" href="body.php?modul=12&aksi=edit&id='.$row->id.'">'; ?>
										<i class="halflings-icon white edit"></i>
									</a>
									<?php echo '<a class="btn btn-danger" href="body.php?modul=12&aksi=hapus&id='.$row->id.'"onclick="return confirm (\'Apakah Anda yakin ingin menghapus data?\');" >';?>
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

<?php function edit_user($id){
	global $db;
	if($_POST){
	$id=test_input($_POST['id']);
	$username=test_input($_POST['username']);
	$pw=md5(test_input($_POST['pw']));
	$sql="UPDATE `user` SET `username`='$username',`password` = '$pw' WHERE `user`.`id` = '$id'";
	$result=$db->query($sql);
	if(!$result){
		echo'
		<div class="alert alert-danger">
			<strong>Error!</strong> <a href="body.php?modul=12&aksi=edit">Try Again</a>
		</div>';
		die("Could not query the database: </br>".$db->error);
	}
	echo'
	<div class="alert alert-success">
		<strong>Success!</strong> <a href="body.php?modul=12">Kembali</a>
	</div>';
	}
	$sql_select= "SELECT * FROM user WHERE id='$id'";
	$q= $db->query($sql_select);
	if(!$q){
		die("Could not query the database: </br>".$db->error);
	}
	while($row=$q->fetch_object()){
		$username=$row->username;
		$id=$row->id;
	}
	
?>
	<div class="box-content">	
			<form class="form-horizontal" name="postform" action="" method="post" enctype='multipart/form-data'>
			<input type="hidden" name="id" value="<?php echo $id;?>"/>
				<fieldset>
				  <div class="control-group">
					<label class="control-label">Username</label>
					<div class="controls">
					  <input id="username" type="text" name="username" pattern="[0-9A-Za-z,-,',., ]*"  class="span6 typehead" value="<?php echo $username;?>" required/>
					</div>
				  </div>
				  <div class="control-group">
					<label class="control-label">Password</label>
					<div class="controls">
					  <input id="pw" type="text" name="pw" pattern="[0-9A-Za-z,-,',., ]*"  class="span6 typehead" value="" required/>
					</div>
				  </div>				  
				  <div class="form-actions">
					<button type="submit" class="btn btn-primary">Save changes</button>
					<a class="btn" href="body.php?modul=12">Cancel</a>
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
		if ($aksi==null){lihat_user();}
		else if ($aksi=='tambah'){tambah_user();}
		else if ($aksi=='edit'){edit_user($_GET['id']);}
		else if ($aksi=='hapus'){hapus_user($_GET['id']);lihat_user();}
		?>
		