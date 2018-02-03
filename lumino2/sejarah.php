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
require_once 'db_login.php';
function tambah_sejarah(){
	global $db;
        global $idu;
	?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active"><a href="sejarah">Sejarah</a></li>
			</ol>
		</div><!--/.row-->
	<?php
        $deskripsiok=0;
        $msg="";
	if($_POST){
	$sql="SELECT id FROM sejarah";
	$result=$db->query($sql);
	if(!$result){
		die("Could not query the database: </br>".$db->error);
	}
	if($result->num_rows > 0){
	while($row=$result->fetch_object()){
		$id=$row->id;
	}}else{$id=0;}
	$id=$id+1;
	$judul=test_input($_POST['judul']);
	$deskripsi=  test_input($_POST['deskripsi']);
        if(strlen(strip_tags($deskripsi))>0){
            $deskripsiok=1;
        }
	$sql="select * from sejarah where judul='$judul'";
        $result=$db->query($sql);
        if($result->num_rows < 1){
            if($deskripsiok==1){
	$sql="INSERT INTO `sejarah` (`id`, `judul`, `deskripsi`,`tanggal`, `iduser`) VALUES ('$id', '$judul', '$deskripsi',now(), '$idu')";
	$result=$db->query($sql);
	echo'
	<div class="row">
			<div class="col-lg-12">';
	if(!$result){
		echo'
		<div class="alert bg-danger" role="alert">
					<a href="sejarah-tambah">Terjadi Masalah Silahkan Coba Lagi</a> <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
		</div>';
		die("Could not query the database: </br>".$db->error);
	}
	else{
	echo'
		<div class="alert bg-success" role="alert">
			<svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg><a href="index.php?modul=4"> Data Telah Diubah</a> <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
		</div>';
	}
	echo'
	</div>
	</div>';
	}else{
            $msg="* Deskripsi tidak boleh kosong";
        }
        }else{
            echo'
		<div class="alert bg-danger" role="alert">
					<a href="sejarah-tambah">Data '.$judul.' Telah Ada</a> <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
		</div>';
        }
        }
?>	
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Sejarah</h1>
			</div>
		</div><!--/.row-->
		<div class="row">
			<div class="col-lg-10 col-lg-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading">Tambah Sejarah</div>
					<div class="panel-body">
						<div class="col-lg-9 col-lg-offset-1">
							<form role="form" class ="form-horizontal" id="form" action="" method="post" enctype='multipart/form-data'>		
								<div class="form-group">
								<label class="control-label col-sm-2" for="judul">Judul</label>
                                                                <div class="col-sm-10">
                                                                    <input class="form-control nama" id="judul" name="judul" pattern="{1,50}" placeholder="Judul Sejarah" autofocus required>
                                                                </div>
                                                                </div>
								<div class="form-group">
									<label class="control-label col-sm-2" for="deskripsi">Deskripsi</label>
                                                                        <div class="col-sm-10">
									<textarea id="deskripsi" class="form-control deskripsi" name="deskripsi" rows="3"></textarea>
                                                                        <label style="color: red;"><?php echo $msg;?></label>
                                                                        </div>
								</div>
                                                            <div class="col-sm-2"></div>
                                                            <div class="col-sm-10">
								<button type="submit" id="submit" class="btn btn-primary">Submit</button>
                                                                <a class="btn btn-info" href="sejarah">Kembali</a>
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
function lihat_sejarah() {
	global $db;
	$i=1;?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active"><a href="sejarah">Sejarah</a></li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Sejarah</h1>
			</div>
		</div><!--/.row-->
				
		<?php 
		$sql= "SELECT id,judul,deskripsi FROM sejarah";
		$result=$db->query($sql);
		?>
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2">
				<div class="panel panel-default">
                                    <div class="panel-heading"><a href = "sejarah-tambah" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Tambah</a></div>
					<div class="panel-body">
                                            <div class="col-lg-12">
                                            <div class='table-responsive'>
                                                <table id='table' class="display table table-striped table-bordered">
						    <thead>
						    <tr>
						        <th>No</th>
						        <th>Tahun</th>
						        <th>Deskripsi</th>
						        <th>Aksi</th>
						    </tr>
						    </thead>
							<?php while($row=$result->fetch_object()){?>
							<tr>
							<td><?php echo $i;?></td>
							<td><?php echo $row->judul;?></td>
							<td>
							<?php
							if(strlen($row->deskripsi)>50){
                                                            $row->deskripsi=  htmlspecialchars_decode(stripslashes($row->deskripsi));
                                                            $row->deskripsi=  strip_tags($row->deskripsi);
								$isi = substr_replace($row->deskripsi,'.....',50);}
								else{
									$isi=$row->deskripsi;
								}
							echo strip_tags(htmlspecialchars_decode(stripslashes($isi)));
							?>
							</td>
							<td>
                                                        <a class="btn btn-info open" data-url="sejarah.php?aksi=buka&id=" data-id="<?php echo $row->id;?>" data-file="sedang" data-toggle="modal" data-target="#myModal">
							<i class="fa fa-eye" aria-hidden="true"></i>
							</a>    
							<a class="btn btn-primary" href="sejarah-edit-<?php echo $row->id;?>">
							<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
							</a>
							<a class="btn btn-danger" href="sejarah-hapus-<?php echo $row->id;?>" onclick="return confirm('Apakah Anda yakin untuk menghapus data ini ?')">
							<i class="fa fa-trash-o" aria-hidden="true"></i>
							</a>
							</td>
							</tr>
							<?php $i++;}?>
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
	function hapus_sejarah($id){
	global $db;
	$sql="DELETE FROM `sejarah` WHERE `sejarah`.`id` = $id";
	$result=$db->query($sql);
	if(!$result){
		die("Could not query the database: </br>".$db->error);
	}
	} 
?>
<?php 
function edit_sejarah($id){
	?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active"><a href="sejarah">Sejarah</a></li>
			</ol>
		</div><!--/.row-->
	<?php
        $deskripsiok=0;
        $msg="";
	global $db;
        global $idu;
	if($_POST){
	$id=$_POST['id'];
	$judul=test_input($_POST['nama']);
	$deskripsi=  test_input($_POST['deskripsi']);
        if(strlen(strip_tags($deskripsi))>1){
            $deskripsiok=1;
        }
	$sql="select * from sejarah where judul='$judul' and id!=$id";
        $result=$db->query($sql);
        if($result->num_rows < 1){
            if($deskripsiok==1){
	$sql="UPDATE `sejarah` SET `judul` = '$judul',`deskripsi`='$deskripsi',`iduser`='$idu' WHERE `sejarah`.`id` = '$id'";
	$result=$db->query($sql);
	echo'
	<div class="row">
			<div class="col-lg-12">';
	if(!$result){
		echo'
		<div class="alert bg-danger" role="alert">
					<a href="sejarah-edit-'.$id.'">Terjadi Masalah Silahkan Coba Lagi</a> <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
		</div>';
		die("Could not query the database: </br>".$db->error);
	}
	else{
	echo'
		<div class="alert bg-success" role="alert">
			<svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg><a href="index.php?modul=4"> Data Telah Diubah</a> <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
		</div>';
	}
	echo'
	</div>
	</div>';
	}else{
            $msg="* Deskripsi tidak boleh kosong";
        }
        }else{
            echo'
		<div class="alert bg-danger" role="alert">
					<a href="sejarah-edit-'.$id.'">Data '.$judul.' Telah Ada</a> <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
		</div>';
        }
        }
	$sql_select= "SELECT * FROM sejarah WHERE id='$id'";
	$q= $db->query($sql_select);
	if(!$q){
		die("Could not query the database: </br>".$db->error);
	}
	while($row=$q->fetch_object()){
		$id=$row->id;
		$judul=$row->judul;
		$deskripsi=$row->deskripsi;
	}
?>	
	<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Sejarah</h1>
			</div>
		</div><!--/.row-->
		<div class="row">
			<div class="col-lg-10 col-lg-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading">Edit : <?php echo $judul;?></div>
					<div class="panel-body">
						<div class="col-lg-9 col-lg-offset-1">
                                                    <form role="form" class="form-horizontal" action="" method="post" enctype='multipart/form-data'>						
							<input type="hidden" name="id" value="<?php echo $id; ?>">
                                                        <input type="hidden" name="gambartemp" value="<?php echo $gambar; ?>">
								<div class="form-group">
									<label class="control-label col-sm-2" for="nama">Nama</label>
                                                                <div class="col-sm-10">
                                                                    <input class="form-control nama" id="judul" name="nama" pattern="{1,50}" placeholder="Nama Sejarah" value="<?php echo $judul;?>" autofocus required>
                                                                </div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-2" for="deskripsi">Deskripsi</label>
                                                                        <div class="col-sm-10">
									<textarea id="deskripsi" class="form-control deskripsi" name="deskripsi" rows="3"><?php echo $deskripsi;?></textarea>
                                                                        </div>
								</div>
                                                                  <div class="form-group">
									<label style="color: red;"><?php echo $msg;?></label>
								</div>
                                                            <div class="col-sm-2"></div>
                                                            <div class="col-sm-10">
								<button type="submit" id="submit" class="btn btn-primary">Submit</button>
                                                                <a class="btn btn-info" href="sejarah">Kembali</a>
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
function open_sejarah($id){
	?>
	<div class="col-lg-12 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active"><a href="sejarah">Sejarah</a></li>
			</ol>
		</div><!--/.row-->
	<?php
	global $db;
	$sql_select= "SELECT * FROM sejarah WHERE id='$id'";
	$q= $db->query($sql_select);
	if(!$q){
		die("Could not query the database: </br>".$db->error);
	}
	while($row=$q->fetch_object()){
		$id=$row->id;
		$judul=$row->judul;
		$deskripsi=$row->deskripsi;
	}
?>	
	<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Sejarah</h1>
			</div>
		</div><!--/.row-->	
		<div class="row">
			<div class="col-lg-10 col-lg-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading">Sejarah <?php echo $judul;?></div>
					<div class="panel-body">
						<div class="col-lg-9 col-lg-offset-1">
                                                    <div class="col-sm-12">
                                                        <div class="col-sm-2">
                                                            <label>Nama</label>
                                                        </div>
                                                        <div class="col-sm-10">
                                                            <p style="margin-left: 25px;"><?php echo $judul;?></p>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <div class="col-sm-2">
                                                            <label>Deskripsi</label>
                                                        </div>
                                                        <div class="col-sm-10">
                                                            <div style="margin-left: 25px;">
                                                                <?php echo html_entity_decode(stripslashes($deskripsi));?>
                                                            </div>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <div class="col-sm-2"></div>
                                                        <div class="col-sm-10">
                                                             <a class="btn btn-primary" style="margin-left: 25px;" href="sejarah-edit-<?php echo$id;?>">Edit</a>
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
		if ($aksi==null || $aksi=="lihat"){lihat_sejarah();}
		else if ($aksi=='tambah'){tambah_sejarah();}
		else if ($aksi=='edit'){edit_sejarah($_GET['id']);}
                else if ($aksi=='buka'){open_sejarah($_GET['id']);}
		else if ($aksi=='hapus'){hapus_sejarah($_GET['id']);lihat_sejarah();}
?>