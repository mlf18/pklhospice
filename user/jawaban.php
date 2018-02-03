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
<?php function jawab_pertanyaan($idt){
	global $db;
	if($_POST){
	$sql="SELECT id FROM jawab";
	$result=$db->query($sql);
	if(!$result){
		die("Could not query the database: </br>".$db->error);
	}
	$id=$result->num_rows+1;
	$jawab=test_input($_POST['deskripsi']);
	$sql="INSERT INTO `jawab` (`id`, `idthread`, `jawab`, `user`) VALUES ('$id', '$idt', '$jawab', 'admin')";
	$result=$db->query($sql);
	if(!$result){
		echo'
		<div class="alert alert-danger">
			<strong>Error!</strong> <a href="body.php?modul=8&aksi=edit">Try Again</a>
		</div>';
		die("Could not query the database: </br>".$db->error);
	}
	echo'
	<div class="alert alert-success">
		<strong>Success!</strong> <a href="body.php?modul=8">Kembali</a>
	</div>';
	}
	$sql="select * from pertanyaan where idthread='$idt'";
	$result=$db->query($sql);
	if(!$result){
		die("Could not query the database: </br>".$db->error);
	}
	while($row=$result->fetch_object()){
		$tanya=$row->isipost;
	}
?>
	<div class="box-content">	
			<form class="form-horizontal" name="postform" action="" method="post" enctype='multipart/form-data'>
				<fieldset>
				  <div class="control-group">
				  <label class="control-label">Pertanyaan</label>
				  <div class="controls">
					<?php echo $tanya;?>
				  </div>
				  </div>
				  <div class="control-group">
				  <label class="control-label">Jawaban</label>
					<div class="controls">
					  <textarea class="span6 typehead" id="deskripsi" name="deskripsi" required></textarea>
					</div>
				  </div>
				  <div class="form-actions">
					<button type="submit" class="btn btn-primary">Submit</button>
				  </div>
				</fieldset>
			  </form>
		
</div> <?php } ?>
<?php 
	function hapus_jawaban($id){
	global $db;
	$sql="DELETE FROM `jawab` WHERE `jawab`.`id` = $id";
	$result=$db->query($sql);
	if(!$result){
		die("Could not query the database: </br>".$db->error);
	}
	} 
?>
<?php function lihat_pertanyaan(){ 
global $db;?>
<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Data</h2>
						<div class="box-icon">
							<a href="body.php?modul=14&kategori=pertanyaan" class="btn-sett"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<?php							
						$sql= "SELECT idthread,judul FROM thread";
						$q= $db->query($sql);
					?>
					
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th style="width:30px;">No</th>
								  <th>Judul</th>
								  <th>Aksi</th>
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
								<td class="center"><a href ="body.php?modul=11&aksi=jawab&idt=<?php echo $row->idthread; ?>"><?php echo $row->judul; ?></a></td>
								<td><a href="body.php?modul=11&aksi=jawab&idt=<?php echo $row->idthread; ?>">balas &nbsp;</a><?php echo '<a class="btn btn-danger" href="body.php?modul=11&aksi=hapus&idt='.$row->idthread.'"onclick="return confirm (\'Apakah Anda yakin ingin menghapus data?\');" >';?>
										<i class="halflings-icon white trash"></i> 
									</a></td>
							</tr>
						
						  
						  <?php $n--;}}
						  ?>
					  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->

	<?php } ?>	

<?php
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
		if ($aksi==null){lihat_pertanyaan();}
		else if ($aksi=='jawab'){jawab_pertanyaan($_GET['idt']);}
		else if ($aksi=='hapus'){hapus_pertanyaan($_GET['idt']);lihat_pertanyaan();}
		?>
		