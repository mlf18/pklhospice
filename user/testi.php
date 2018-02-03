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
	function hapus_testimoni($id){
	global $db;
	$sql="DELETE FROM `testimoni` WHERE `testimoni`.`id` = $id";
	$result=$db->query($sql);
	if(!$result){
		die("Could not query the database: </br>".$db->error);
	}
	} 
?>
<?php function lihat_testimoni(){ 
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
						$sql= "SELECT * FROM testimoni";
						$q= $db->query($sql);
					?>
					
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th style="width:30px;">No</th>
								  <th>Nama</th>
								  <th>Testimoni</th>
								  <th>Tampilkan</th>
								  <th>Hapus</th>
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
								<td class="center"><?php echo $row->nama; ?></td>
								<td class="center"><?php echo $row->testimoni; ?></td>
								<td>
								<form class="form-inline" id="mform">
								<label class="radio-inline"><input type="radio" name="optradio1" class="optradio" value="1" data-id="<?php echo $row->id;?>" <?php if($row->tampil==true){ echo "checked";}?>>Ya</label>
								<label class="radio-inline"><input type="radio" name="optradio1" class="optradio" value="0" data-id="<?php echo $row->id;?>" <?php if($row->tampil==false){ echo "checked";}?>>Tidak</label>
								</form>
								</td>
								<td class="center">
									<?php echo '<a class="btn btn-danger" href="body.php?modul=13&aksi=hapus"onclick="return confirm (\'Apakah Anda yakin ingin menghapus data?\');" >';?>
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
		if ($aksi==null || $aksi="lihat" ){lihat_testimoni();}
		else if ($aksi=='hapus'){hapus_testimoni($_GET['id']);lihat_testimoni();}
		?>
		