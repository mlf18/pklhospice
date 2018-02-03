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
<?php 
function lihat_testimoni() {
	global $db;
	$i=1;
	?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Testimoni</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Testimoni</h1>
			</div>
		</div><!--/.row-->
				
		<?php 
		$sql= "SELECT * FROM testimoni";
		$result=$db->query($sql);
		?>
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading"></div>
					<div class="panel-body">
                                            <div class="table-responsive">
                                                <div class="col-md-12">
                                                <table id="tabletesti" class="display table table-bordered table-striped">
						    <thead>
						    <tr>
						        <th>No</th>
						        <th>Nama</th>
						        <th>Testimoni</th>
							<th>Status</th>
                                                        <th>Tanggal</th>
                                                        <th>Aksi</th>
						    </tr>
						    </thead>
							<?php 
							while($row=$result->fetch_object()){
                                                            $id=$row->id;
								?>
                                                        <tr onclick="locaton.href='testimoni-ubah-<?php echo $row->id;?>';">
							<td style='white-space: nowrap;'></td>
							<td style='white-space: nowrap;'><?php echo $row->nama;?></td>
							<?php
							if(strlen($row->testimoni)<10){
                                                            echo "<td>$row->testimoni</td>";
                                                                
                                                        }
								else{
									echo "<td style='white-space: nowrap;'>$row->testimoni</td>";
								}
							?>
							<td style='white-space: nowrap;'>
                                                            <form>
                                                                <select class="form-control tampil">
                                                                <?php 
                                                                if($row->tampil==1){ 
                                                                    echo '<option value="1" data-id="'.$id.'" selected>Tampil</option>
                                                                    <option value="0" data-id="'.$id.'">Tidak</option>';
                                                                }else{
                                                                    echo '<option value="1" data-id="'.$id.'">Tampil</option>
                                                                    <option value="0" data-id="'.$id.'" selected>Tidak</option>';
                                                                };?>    
                                                                </select>
                                                            </form>
                                                        </td>
                                                        <td style='white-space: nowrap;'><?php echo $row->tanggal;?></td>
                                                        <td style='white-space: nowrap;'>
                                                            <a class="btn btn-danger" href="testimoni-hapus-<?php echo $row->id;?>" onclick="return confirm('Apakah Anda yakin untuk menghapus data ini ?')">
							<i class="fa fa-trash-o" aria-hidden="true"></i>
							</a>
                                                        </td>
							</tr>
							<?php $i++;}?>
						</table>
                                                </div>
                                                <!--<table id="example" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th></th>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Salary</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th></th>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Salary</th>
            </tr>
        </tfoot>
    </table>-->
                                            </div>
					</div>
				</div>
			</div>
		</div><!--/.row-->			
	</div><!--/.main-->	

<?php } ?>
<?php 
function update_tampil($id){
	?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Banner</li>
			</ol>
		</div><!--/.row-->
	<?php
	global $db;
	if($_POST){
	$id=$_POST['id'];
	$tampil=test_input($_POST['tampil']);
	$sql="UPDATE `testimoni` SET `tampil` = '$tampil' WHERE `testimoni`.`id` = '$id'";
	$result=$db->query($sql);
	echo'
	<div class="row">
			<div class="col-lg-12">';
if(!$result){
		echo'
		<div class="alert bg-warning" role="alert">
					<a href="testimoni-ubah-'.$id.'">Terjadi Masalah Silahkan Coba Lagi</a> <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
		</div>';
		die("Could not query the database: </br>".$db->error);
	}
	else{
	echo'
		<div class="alert bg-success" role="alert">
			<a href="testimoni"><svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg> Data Telah Diubah</a> <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
		</div>';
	}
	echo'
	</div>
	</div>';
	}
	$sql_select= "SELECT * FROM testimoni WHERE id='$id'";
	$q= $db->query($sql_select);
	if(!$q){
		die("Could not query the database: </br>".$db->error);
	}
	while($row=$q->fetch_object()){
		$id=$row->id;
		$nama=$row->nama;
		$testimoni=$row->testimoni;
		$tampil=$row->tampil;
	}
?>	
	<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Testimoni</h1>
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
									<p><?php echo $nama;?></p>
								</div>
								<div class="form-group">
									<label>Testimoni</label>
									<p><?php echo $testimoni;?></p>
								</div>
								<div class="form-group">
									<label>Status</label>
                                                                        <select class="form-control" name="tampil" required>
										<option value="1" <?php if($tampil==1){echo 'selected';}?>>Tampil</option>
										<option <?php if($tampil==0){echo 'selected';}?>>Tidak</option>
									</select>
								</div>
								<button type="submit" class="btn btn-primary">Submit</button>
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
		if ($aksi==null || $aksi=="lihat" ){lihat_testimoni();}
		else if ($aksi=='update'){update_tampil($_GET['id']);}
		else if ($aksi=='hapus'){hapus_testimoni($_GET['id']);lihat_testimoni();}
		?>
