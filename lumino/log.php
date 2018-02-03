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
function judul_kontent($id){
	global $db;
	$ida=$idc=$idca=$idep=$idf=$idg=$idp=$idse=$ids=$idv=$iduser=$isi="";
	$sql="select * from content where idcontent = $id";
	$result=$db->query($sql);
	if(!$result){
		die("Could not query the database: </br>".$db->error);
	}
	while($row=$result->fetch_object()){
		$ida=$row->idartikel;
		$idc=$row->idcabang;
		$idca=$row->idcareer;
		$idep=$row->idevent_promo;
		$idf=$row->idfitur;
		$idg=$row->idgambar;
		$idp=$row->idproduk;
		$idse=$row->idsejarah;
		$ids=$row->idstaff;
		$idv=$row->idvideo;
		$iduser=$row->iduser;
	}
	if ($ida != NULL){
		$sql="select id,nama from artikel where id = $ida";
		$result=$db->query($sql);
		$isi="artikel";
	}elseif ($idc != NULL){
		$sql="select idcabang as id, lokasi as nama from cabang where idcabang = $idc";
		$result=$db->query($sql);
		$isi="cabang";
	}elseif ($idca != NULL){
		$sql="select * from career where id = $idca";
		$result=$db->query($sql);
		$isi="cabang";
	}elseif ($idep != NULL){
		$sql="select * from event_promo where id = $idep";
		$result=$db->query($sql);
		$isi="banner";
	}elseif ($idf != NULL){
		$sql="select * from fitur where id = $idf";
		$result=$db->query($sql);
		$isi="fitur";
	}elseif ($idg != NULL){
		$sql="select id, judul as nama from gambar where id = $idg";
		$result=$db->query($sql);
		$isi="gambar";
	}elseif ($idp != NULL){
		$sql="select * from produk where id = $idp";
		$result=$db->query($sql);
		$isi="produk";
	}elseif ($idse != NULL){
		$sql="select id, tahun as nama from sejarah where id = $idse";
		$result=$db->query($sql);
		$isi="sejarah";
	}elseif ($ids != NULL){
		$sql="select id_staff as id, nama from staff where id_staff = $idS";
		$result=$db->query($sql);
		$isi="staff";
	}elseif ($idv != NULL){
		$sql="select * from video where id = $idv";
		$result=$db->query($sql);
		$isi="video";
	}
	$sql_user="select * from user where id = $iduser";
	$result_user=$db->query($sql_user);
	//return array($isi,$result->fetch_object(),$result_user->fetch_object());
}
?>
<?php 
function tambah_log($idc,$acti,$nama){
	global $db;
	?>
	<?php 
	$sql="SELECT id FROM log";
	$result=$db->query($sql);
	if(!$result){
		die("Could not query the database: </br>".$db->error);
	}
	if($result->num_rows > 0){
	while($row=$result->fetch_object()){
		$id=$row->id;
	}}else{
		$id=0;
	}
	$id=$id+1;
	$sql="INSERT INTO `log` (`id`, `tanggal`,`idconten`,`aktivitas`,`nama`,iduser) VALUES ('$id', now(),'$idc','$acti','$nama','1')";
	$result=$db->query($sql);
	if(!$result){
		die("Could not query the database: </br>".$db->error);
	}
} 
	?>
<?php 
function lihat_log() {
	global $db;
	$i=1;?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Log</li>
			</ol>
		</div><!--/.row-->
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Log</h1>
			</div>
		</div><!--/.row-->
				
		<?php 
		$sql= "SELECT * FROM log order by tanggal desc";
		$result=$db->query($sql);
		?>
		<div class="row">
			<div class="col-lg-8">
				<div class="panel panel-default chat">
					<div class="panel-heading" id="accordion">
					<svg class="glyph stroked clock"><use xlink:href="#stroked-clock"/></svg> Log Aktivitas
					<a class="btn" style="float:right;" href="index.php?modul=13&aksi=hapus" onclick="return confirm('Apakah Anda yakin untuk menghapus data ini ?')"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"/></svg></a>
					</div>
					<div class="panel-body">
						<ul>
						<?php
						$idk="";
						$isi="";
						$konten="";
						$tanggal="";
						$user="";
						if($result->num_rows > 0){
						while($row=$result->fetch_object()){
								$acti=$row->aktivitas;
								if($acti=="tambah"){
									$gmbr='<svg class="glyph stroked plus sign"><use xlink:href="#stroked-plus-sign"/></svg>';
									$info="Menambahkan";
								}elseif($acti=="edit"){
									$gmbr='<svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"/></svg>';
									$info="Mengubah";
								}else{
									$gmbr='<svg class="glyph stroked trash"><use xlink:href="#stroked-trash"/></svg>';
									$info="Menghapus";
								}
								$idk=$row->idconten;
								$isi=judul_kontent($idk)[0];
								$sql_user="select * from user where id = $row->iduser";
								$result_user=$db->query($sql_user);
								$user=$result->fetch_object();
								$tanggal=$row->tanggal;
								$user=judul_kontent($idk)[2];
						?>
							<li class="left clearfix">
								<div class="chat-body clearfix">
									<div class="header">
										<small class="text-muted"><?php echo $tanggal;?></small>
									</div>
									<p>
										<?php echo "$gmbr $user->username $info $idk $row->nama";?>
									</p>
								</div>
							</li>
						<?php }}
						else{
						?>
						<li class="left clearfix">
								<div class="chat-body clearfix">
									<p>
										Log Kosong
									</p>
								</div>
						</li>
						<?php	
						}
							?>
						</ul>
					</div>
			</div>
		</div><!--/.row-->			
	</div><!--/.main-->	
<?php } ?>
<?php 
	function hapus_log(){
	global $db;
	$sql="TRUNCATE TABLE log";
	$result=$db->query($sql);
	if(!$result){
		die("Could not query the database: </br>".$db->error);
	}
	} 
?>