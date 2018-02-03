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
function tambah_kategori($kat){
	global $db;
	?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
                                <li class="active"><a href="kategori_<?php echo $kat;?>">Kategori <?php echo $kat;?></a></li>
			</ol>
		</div><!--/.row-->
	<?php 
	if($_POST){
	$sql="SELECT id FROM kategori_$kat";
	$result=$db->query($sql);
	if(!$result){
		die("Could not query the database: </br>".$db->error);
	}
	if($result->num_rows > 0){
	while($row=$result->fetch_object()){
		$id=$row->id;
	}}else{$id=0;}
	$id=$id+1;
	$kategori=test_input($_POST['kategori']);
        $sql="select * from kategori_$kat where kategori='$kategori' and id!=$id";
        $result=$db->query($sql);
        if($result->num_rows < 1){
            $sql="INSERT INTO `kategori_$kat` (`id`, `kategori`) VALUES ('$id','$kategori')";
	$result=$db->query($sql);
	if(!$result){
		echo'
		<div class="alert bg-danger" role="alert">
			<svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg><a href="kategori_'.$kat.'-tambah"> Terjadi Kesalahan ! <a href="">Coba lagi</a></a><a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
		</div>';
		die("Could not query the database: </br>".$db->error);
	}else{
	echo'
	<div class="alert bg-success" role="alert">
		<svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg><a href="kategori_'.$kat.'"> Data Telah Ditambahkan </a><a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
	</div>';
        }
        }else{
            echo'
		<div class="alert bg-danger" role="alert">
			<svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg><a href="kategori_'.$kat.'-tambah"> Data '.$kategori.' Telah Ada <a href="">Coba lagi</a> </a><a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
		</div>';
        }
	
	}
?>	
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Kategori <?php $kat;?></h1>
			</div>
		</div><!--/.row-->
				
		
		<div class="row">
			<div class="col-lg-10 col-lg-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading">Tambah Kategori <?php echo $kat;?></div>
					<div class="panel-body">
						<div class="col-lg-9 col-lg-offset-1">
                                                    <form role="form" class="form-horizontal" action="" method="post" enctype='multipart/form-data'>		
								<div class="form-group">
									<label class="control-label col-sm-2" for="kategori">Kategori</label>
                                                                        <div class="col-sm-10">
                                                                            <input class="form-control nama" name="kategori" id="kategori" required autofocus="">
                                                                        </div>
								</div>
								<div class="col-sm-2"></div>
                                                                <div class="col-sm-10">
        								<button type="submit" id="submit" class="btn btn-primary">Submit</button>
                                                                        <a class="btn btn-info" href="kategori_<?php echo $kat.'-lihat';?>">Kembali</a>
                                                                </div>
                                                                </form>
                                                    </form>
						</div>
					</div>
				</div>
			</div><!-- /.col-->
		</div><!-- /.row -->
		
	</div><!--/.main-->
<?php } ?>
<?php 
function lihat_kategori($kat) {
	global $db;
	$i=1;?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active"><a href="kategori_<?php echo $kat;?>">Kategori <?php echo $kat;?></a></li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Kategori <?php echo $kat;?></h1>
			</div>
		</div><!--/.row-->
				
		<?php 
		$sql= "SELECT id,kategori FROM kategori_$kat";
		$result=$db->query($sql);
		?>
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2">
				<div class="panel panel-default">
                                    <div class="panel-heading"><a href = "kategori_<?php echo $kat;?>-tambah" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Tambah</a></div>
					<div class="panel-body">
                                            <div class="col-lg-12">
                                            <div class='table-responsive'>
                                                <table id='table' class="display table table-striped table-bordered">
						    <thead>
						    <tr>
						        <th>No</th>
						        <th>Kategori</th>
						        <th>Aksi</th>
						    </tr>
						    </thead>
							<?php while($row=$result->fetch_object()){
								?>
							<tr>
							<td></td>
							<td><?php echo $row->kategori;?></td>
							<td>
							<a class="btn btn-primary" href="kategori_<?php echo $kat;?>-edit-<?php echo $row->id;?>">
							<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
							</a>
							<a class="btn btn-danger" href="kategori_<?php echo $kat;?>-hapus-<?php echo $row->id;?>" onclick="return confirm('Apakah Anda yakin untuk menghapus data ini ?')">
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
	function hapus_kategori($id,$kat){
	global $db;
	$sql="DELETE FROM `kategori_$kat` WHERE `kategori_$kat`.`id` = $id";
	$result=$db->query($sql);
	if(!$result){
		die("Could not query the database: </br>".$db->error);
	}
	} 
?>
<?php 
function edit_kategori($id,$kat){
	?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active"><a href="kategori_<?php echo $kat;?>">Kategori <?php echo $kat;?></a></li>
			</ol>
		</div><!--/.row-->
	<?php
	global $db;
	if($_POST){
	$id=$_POST['id'];
	$kategori=test_input($_POST['kategori']);
        $sql="select * from kategori_$kat where kategori='$kategori' and `kategori_$kat`.`id` != '$id'";
        $result=$db->query($sql);
        if($result->num_rows < 1){
            $sql="UPDATE `kategori_$kat` SET `kategori` = '$kategori' WHERE `kategori_$kat`.`id` = '$id'";
	$result=$db->query($sql);
	echo'
	<div class="row">
			<div class="col-lg-12">';
        if(!$result){
		echo'
		<div class="alert bg-danger" role="alert">
					<a href="kategori_'.$kat.'&aksi=edit&id='.$id.'">Terjadi Masalah Silahkan Coba Lagi</a> <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
		</div>';
		die("Could not query the database: </br>".$db->error);
	}
	else{
	echo'
		<div class="alert bg-success" role="alert">
			<svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg><a href="kategori_'.$kat.'"> Data Telah Diubah </a><a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
		</div>';
	}
	echo'
	</div>
	</div>';
        }else{
            echo'
		<div class="alert bg-danger" role="alert">
					<a href="kategori_'.$kat.'&aksi=edit&id='.$id.'">Data '.$kategori.' Telah Ada</a> <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
		</div>';
        }
	}
	$sql_select= "SELECT * FROM kategori_$kat WHERE id='$id'";
	$q= $db->query($sql_select);
	if(!$q){
		die("Could not query the database: </br>".$db->error);
	}
	while($row=$q->fetch_object()){
		$id=$row->id;
		$kategori=$row->kategori;
	}
?>	
	<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Kategori <?php echo $kat;?></h1>
			</div>
		</div><!--/.row-->	
		<div class="row">
			<div class="col-lg-10 col-lg-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading">Edit : <?php echo $kategori;?></div>
					<div class="panel-body">
						<div class="col-lg-9 col-lg-offset-1">
                                                    <form role="form" class="form-horizontal" action="" method="post" enctype='multipart/form-data'>							
							<input type="hidden" name="id" value="<?php echo $id; ?>">
								<div class="form-group">
									<label class="control-label col-sm-2" for="kategori">Kategori</label>
                                                                        <div class="col-sm-10">
									<input class="form-control nama" name="kategori" value="<?php echo $kategori;?>" required autofocus="">
                                                                        </div>
								</div>
								<div class="col-sm-2"></div>
                                                                <div class="col-sm-10">
        								<button type="submit" id="submit" class="btn btn-primary">Submit</button>
                                                                        <a class="btn btn-info" href="kategori_<?php echo $kat.'-lihat';?>">Kembali</a>
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
function open_kategori($id,$kat){
	?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active"><a href="kategori_<?php echo $kat;?>">Kategori <?php echo $kat;?></a></li>
			</ol>
		</div><!--/.row-->
	<?php
	global $db;
	$sql_select= "SELECT * FROM kategori_$kat WHERE id='$id'";
	$q= $db->query($sql_select);
	if(!$q){
		die("Could not query the database: </br>".$db->error);
	}
	while($row=$q->fetch_object()){
		$id=$row->id;
		$kategori=$row->kategori;
	}
?>	
	<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Kategori <?php echo $kat;?></h1>
			</div>
		</div><!--/.row-->	
		<div class="row">
			<div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
				<div class="panel panel-default">
					<div class="panel-heading"><?php echo $kategori;?></div>
					<div class="panel-body">
						<div class="col-md-8">
								<div class="form-group">
									<label>Kategori</label>
                                                                        <p><?php echo $kategori;?></p>
								</div>
                                                        <a class="btn btn-primary" href="kategori_<?php echo $kat.'-edit-'.$id;?>">Edit</a>
                                                        
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
		if(!empty($_GET['kategori'])){
		if ($aksi==null){lihat_kategori($_GET['kategori']);}
		else if ($aksi=='tambah'){tambah_kategori($_GET['kategori']);}
		else if ($aksi=='edit'){edit_kategori($_GET['id'],$_GET['kategori']);}
                else if ($aksi=='buka'){open_kategori($_GET['id'],$_GET['kategori']);}
		else if ($aksi=='hapus'){hapus_kategori($_GET['id'],$_GET['kategori']);lihat_kategori($_GET['kategori']);}
		}
?>