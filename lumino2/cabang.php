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
require_once('db_login.php');
function tambah_cabang(){
	global $db;
        global $idu;
	?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active"><a href="cabang">Cabang</a></li>
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
        if(test_input($_POST['kontak'])==''){
            $kontak='';
        }else{
            $kontak=$_POST['kontak'];
        }
	$alamat=test_input($_POST['alamat']);
	$sql="INSERT INTO `cabang` (`idcabang`, `alamat`, `kontak`, `lokasi`,`lat`,`lng`,`tanggal`,`iduser`) VALUES ('$idcabang', '$alamat', '$kontak','$lokasi','$lat','$lng',now(),'$idu')";
	$result=$db->query($sql);
	echo'
	<div class="row">
			<div class="col-lg-12">';
	if(!$result){
		echo'
		<div class="alert bg-danger" role="alert">
			<svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg><a href="cabang-tambah"> Terjadi Kesalahan ! <a href="">Coba lagi</a> </a><a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
		</div>';
		die("Could not query the database: </br>".$db->error);
	}else{
	echo'
	<div class="alert bg-success" role="alert">
		<svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg><a href="cabang-lihat"> Data Telah Ditambahkan </a><a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
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
			<div class="col-lg-10 col-lg-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading">Tambah Cabang</div>
					<div class="panel-body">
						<div class="col-lg-9 col-lg-offset-1">
                                                    <form role="form" class="form-horizontal" action="" method="post" enctype='multipart/form-data'>
								<div class="form-group">
									<label class="control-label col-sm-2" for="lokasi">Lokasi</label>
                                                                        <div class="col-sm-10">
                                                                        <input class="form-control lokasi" name="lokasi" id="lokasi" pattern="{1,50}" required placeholder="Lokasi Cabang" size="50" maxlength="50" autofocus="">
                                                                        </div>
                                                                        
								</div>
								<div class="form-group">
									<label class="control-label col-sm-2" for="latitude">Latitude</label>
                                                                        <div class="col-sm-10">
                                                                        <input type='number' min="-85" max="85" step="any" class="form-control latitude" name="latitude" id="latitude" placeholder="Koordinat Latitude Cabang"/>
                                                                        </div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-2" for="longitude">Longitude</label>
                                                                        <div class="col-sm-10">
                                                                        <input type="number" min="-180" max="180" step="any" class="form-control longitude" name="longitude" id="longitude" placeholder="Masukkan Koordinat Longitude Cabang"/>
                                                                        </div>
								</div>
                                                                <div class="form-group">
									<div class="col-sm-2"></div>
                                                                        <div class="col-sm-10">
                                                                            <span class="label label-info"><a href="http://latlong.net/" target="_blank">Temukan koordinat</a></span>
                                                                        </div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-2" for="kontak">Kontak</label>
                                                                        <div class="col-sm-10">
                                                                            <input type="text" id="kontak" class="form-control kontak" name="kontak" id="kontak" pattern="[0-9]{7,12}" placeholder="Masukkan Informasi Kontak"/>
                                                                        </div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-2" for="alamat">Alamat</label>
                                                                        <div class="col-sm-10">
                                                                        <textarea id="alamat" class="form-control alamat" name="alamat" rows="3" required placeholder="Masukkan Alamat Cabang"></textarea>
                                                                        </div>
								</div>
                                                        <div class="col-sm-2"></div>
                                                        <div class="col-sm-10">
								<button type="submit" class="btn btn-primary">Submit</button>
                                                                <a class="btn btn-info" href="cabang">Kembali</a>
                                                        </div>
                                                        </form>
                                                    </div>
					</div>
				</div>
			</div><!-- /.col-->
                        </div>
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
				<li><a href="index"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active"><a href="cabang">Cabang</a></li>
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
			<div class="col-lg-8 col-lg-offset-2">
				<div class="panel panel-default">
                                    <div class="panel-heading"><a href = "cabang-tambah" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Tambah</a></div>
					<div class="panel-body">
                                            <div class="col-lg-12 ">
                                            <div class='table-responsive'>
                                                <table id='table' class="display table table-striped table-bordered">
						    <thead>
						    <tr>
						        <th>No</th>
						        <th>Lokasi</th>
						        <th>Alamat</th>
						        <th>Aksi</th>
						    </tr>
						    </thead>
							<?php 
                                                        if($result->num_rows > 0){
                                                        while($row=$result->fetch_object()){
                                                            ?>
							<tr>
							<td><?php echo $i;?></td>
							<td><?php echo $row->lokasi;?></td>
							<td><?php echo $row->alamat;?></td>
							<td>
                                                        <a class="btn btn-info open" data-url="cabang.php?aksi=buka&id=" data-id="<?php echo $row->idcabang;?>" data-file="kecil" data-toggle="modal" data-target="#myModal">
							<i class="fa fa-eye" aria-hidden="true"></i>
							</a>
							<a class="btn btn-primary" href="cabang-edit-<?php echo $row->idcabang;?>">
							<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
							</a>
							<a class="btn btn-danger" href="cabang-hapus-<?php echo $row->idcabang;?>" onclick="return confirm('Menghapus data ini akan menghapus gambar pada cabang ini.\nApakah Anda yakin untuk menghapus data ini ?')">
							<i class="fa fa-trash-o" aria-hidden="true"></i>
							</a>
							</td>
							</tr>
                                                        <?php $i++;}}?>
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
	function hapus_cabang($idcabang){
	global $db;
        $sql="DELETE FROM `gambar` WHERE `gambar`.`idcabang` = $idcabang";
	$result=$db->query($sql);
	$sql="DELETE FROM `cabang` WHERE `cabang`.`idcabang` = $idcabang";
	$result=$db->query($sql);
	if(!$result){
		die("Could not query the database: </br>".$db->error);
	}
	} 
?>
<?php 
function edit_cabang($id){
	?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active"><a href="cabang">Cabang</a></li>
			</ol>
		</div><!--/.row-->
	<?php
	global $db;
        global $idu;
	if($_POST){
	$idcabang=test_input($_POST['id']);
	$lokasi=test_input($_POST['lokasi']);
        if(test_input($_POST['kontak'])==''){
            $kontak='';
        }else{
            $kontak=test_input($_POST['kontak']);
        }
	$alamat=test_input($_POST['alamat']);
	$lat=test_input($_POST['latitude']);
	$lng=test_input($_POST['longitude']);
	$sql="UPDATE `cabang` SET `alamat`='$alamat',`kontak` = '$kontak',`lokasi`='$lokasi',`lat`='$lat',`lng`='$lng',`tanggal`=now(),`iduser`='$idu' WHERE `cabang`.`idcabang` = '$idcabang'";
	$result=$db->query($sql);
	echo'
	<div class="row">
			<div class="col-lg-12">';
	if(!$result){
		echo'
		<div class="alert bg-danger" role="alert">
			<svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg><a href="cabang-edit-'.$id.'"> Terjadi Kesalahan ! <a href="">Coba lagi</a> </a><a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
		</div>';
		die("Could not query the database: </br>".$db->error);
	}else{
		echo'
		<div class="alert bg-success" role="alert">
			<svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg><a href="cabang-lihat"> Data Telah Diubah </a><a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
		</div>';
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
			<div class="col-lg-10 col-lg-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading">Edit : <?php echo $lokasi;?></div>
					<div class="panel-body">
						<div class="col-lg-9 col-lg-offset-1">
                                                    <form role="form" class="form-horizontal" action="" method="post" enctype='multipart/form-data'>							
							<input type="hidden" name="id" value="<?php echo $idcabang; ?>">
								<div class="form-group">
									<label class="control-label col-sm-2" for="lokasi">Lokasi</label>
                                                                        <div class="col-sm-10">
									<input class="form-control lokasi" name="lokasi" id="lokasi" value="<?php echo $lokasi;?>" pattern="{1,50}" required>
                                                                        </div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-2" for="latitude">Latitude</label>
                                                                        <div class="col-sm-10">
                                                                        <input type="number" min="-85" max="85" step="any" class="form-control latitude" name="latitude" id="latitude" value="<?php echo $lat;?>">
                                                                        </div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-2" for="longitude">Longitude</label>
                                                                        <div class="col-sm-10">
                                                                        <input type="number" min="-180" max="180" step="any" class="form-control longitude" name="longitude" id="longitude" value="<?php echo $long;?>">
                                                                        </div>
								</div>
                                                                <div class="form-group">
									<div class="col-sm-2"></div>
                                                                        <div class="col-sm-10">
                                                                            <span class="label label-info"><a href="http://latlong.net/" target="_blank">Temukan koordinat</a></span>
                                                                        </div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-2" for="kontak">Kontak</label>
                                                                        <div class="col-sm-10">
                                                                            <input id="kontak" type="text" class="form-control" name="kontak" value ="<?php echo $kontak;?>" pattern="[0-9]{7,12}"/>
                                                                        </div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-2" for="alamat">Alamat</label>
                                                                        <div class="col-sm-10">
									<textarea id="alamat" class="form-control alamat" name="alamat" rows="3" required><?php echo $alamat;?></textarea>
                                                                        </div>
								</div>
                                                        <div class="col-sm-2">
                                                        </div>
                                                        <div class="col-sm-10">
                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                            <a class="btn btn-info" href="cabang">Kembali</a>
                                                        </div>
                                                        </form>
						</div>
					</div>
				</div>
			</div><!-- /.col-->
		</div><!-- /.row -->
	</div><!--/.main-->
<?php } ?>
<?php 
function open_cabang($id){
	?>
	<div class="col-lg-12 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active"><a href="cabang">Cabang</a></li>
			</ol>
		</div><!--/.row-->
	<?php
	global $db;
        global $idu;
	$sql_select= "SELECT * FROM cabang WHERE idcabang='$id'";
	$q= $db->query($sql_select);
	if(!$q){
		die("Could not query the database: </br>".$db->error);
	}
	while($row=$q->fetch_object()){
		$id=$row->idcabang;
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
			<div class="col-lg-10 col-lg-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading">Cabang <?php echo $lokasi;?></div>
					<div class="panel-body">
						<div class="col-lg-9 col-lg-offset-1">
                                                    <div class="col-sm-12">
                                                        <div class="col-sm-2">
                                                        <label>Lokasi</label>
                                                        </div>
                                                        <div class="col-sm-10">
                                                        <p style="margin-left: 35px;"><?php echo $lokasi;?></p>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <div class="col-sm-2">
                                                        <label>Alamat</label>
                                                        </div>
                                                        <div class="col-sm-10">
                                                        <p style="margin-left: 35px;"><?php echo $alamat;?></p>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <div class="col-sm-2">
                                                        <label>Kontak</label>
                                                        </div>
                                                        <div class="col-sm-10">
                                                        <p style="margin-left: 35px;"><?php echo $kontak;?></p>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <div class="col-sm-2">
                                                        <label>Latitude</label>
                                                        </div>
                                                        <div class="col-sm-10">
                                                        <p style="margin-left: 35px;"><?php echo $lat;?></p>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <div class="col-sm-2">
                                                        <label>Longitude</label>
                                                        </div>
                                                        <div class="col-sm-10">
                                                        <p style="margin-left: 35px;"><?php echo $long;?></p>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <div class="col-sm-2">
                                                        </div>
                                                        <div class="col-sm-10">
                                                        <p style="margin-left: 35px;"><a class="btn btn-primary" href="cabang-edit-<?php echo $id;?>">Edit</a></p>
                                                        </div>
                                                        <div class="clearfix"></div>
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
		if ($aksi=="" || $aksi=="lihat"){lihat_cabang();}
		else if ($aksi=='tambah'){tambah_cabang();}
		else if ($aksi=='edit'){
		if(!empty($_GET['id'])){
			edit_cabang($_GET['id']);}
		}
                else if ($aksi=='buka'){
		if(!empty($_GET['id'])){
			open_cabang($_GET['id']);}
		}
		else if ($aksi=='hapus'){
		if(!empty($_GET['id'])){
			hapus_cabang($_GET['id']);lihat_cabang();}
		}
?>