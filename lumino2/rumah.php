<?php 
function rumah(){
	global $db;
?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Home</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Home</h1>
			</div>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-xs-6 col-md-6 col-lg-3">
				<div class="panel panel-blue panel-widget ">
					<div class="row no-padding">
					<a href="artikel">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"/></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large">Tambah</div>
							<div class="text-muted">Artikel</div>
						</div>
					</a>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-6 col-lg-3">
				<div class="panel panel-teal panel-widget">
					<div class="row no-padding">
					<a href="galeri">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked landscape"><use xlink:href="#stroked-landscape"/></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large">Tambah</div>
							<div class="text-muted">Galeri</div>
						</div>
					</a>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-6 col-lg-3">
				<div class="panel panel-orange panel-widget">
					<div class="row no-padding">
					<a href="testimoni">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked empty-message"><use xlink:href="#stroked-empty-message"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large">
							<?php
							$sql="SELECT count(id) as jmlh FROM testimoni";
							$result=$db->query($sql);
							if(!$result){
								die("Could not query the database: </br>".$db->error);
							}
							$row=$result->fetch_object();
							echo "$row->jmlh";
							?>
							</div>
							<div class="text-muted">Testimoni</div>
						</div>
					</div>
					</a>
				</div>
			</div>
			<div class="col-xs-6 col-md-6 col-lg-3">
				<div class="panel panel-red panel-widget">
					<div class="row no-padding">
					<a href="hapus-counter" onclick="return confirm('Apakah Anda yakin untuk menghapus data ini ?')">
						<div class="col-sm-3 col-lg-3 widget-left">
							<svg class="glyph stroked trash"><use xlink:href="#stroked-trash"></use></svg>Hapus
						</div>
					</a>
						<div class="col-sm-6 col-lg-6 widget-right">
							<div class="large">
							<?php 
							$open = fopen("hits.txt", "r+");
							$value = fgets($open);
							$close = fclose($open);
							if($value >= 1000){
								$value=($value-1000);
								echo "1.$value K";
							}else{
								echo"$value";
							}
							
							?>
							
							</div>
							<div class="text-muted">
							Page Views
							</div>
						</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->
	</div>	<!--/.main-->
<?php }
function delete_counter(){
$open = fopen("hits.txt", "r+");
$value = fgets($open);
$close = fclose($open);
$value=0;
$open = fopen("hits.txt", "w+");
fwrite($open,$value);
}
if(!empty($_GET['aksi'])){
	$aksi=$_GET['aksi'];
}else{
	$aksi="";
}
if($aksi=="hapus" && $aksi !=""){
	delete_counter();
	rumah();
}else{
	rumah();
}