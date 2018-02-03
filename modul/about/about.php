<div class="container">
<div class="about" style="background:#FFF;">
			<div class="work-title">
				<h3>ABOUT<span>US</span></h3>
			</div>
<?php
$sql="select * from sejarah order by tanggal desc";
$result=$db->query($sql);
if(!$result){
	die("Could not query the database: </br>".$db->error);
}
while($row=$result->fetch_object()){
	$judul=$row->judul;
	$isi=$row->deskripsi;
	$isi=($isi);

?>
			<div class="about-text">
				<div class="col-md-12 about-text-right">
					<div class="work-title">
					<div class="col-md-12">
					<h4><?php echo $judul; ?> </h4>
					</div>
					<div class="clearfix"></div>
					</div>
					<div align="justify">
					<?php echo htmlspecialchars_decode(stripslashes($row->deskripsi));
					//htmlspecialchars_decode(stripslashes($row->deskripsi)); ?>
					</div>					
				</div>
			</div>
<?php } ?>
<div class="clearfix"> </div>
<!--
			<div class="work-title">
				<h3>OUR<span>TEAM</span></h3>
			</div>
			<div class="about-team">
				<?php
				$sql="select * from staff";
				$result=$db->query($sql);
				if(!$result){
					die("Could not query the database: </br>".$db->error);
				}
				while($row=$result->fetch_object()){
					?>
					<div class="col-lg-4 col-md-9 col-xs-6 about-team-grids">
					<img src="images/<?php echo $row->gambar;?>" alt=""/>
					<div class="team-text">
					<div class="col-lg-12">
						<h4><a href="#"><?php echo"$row->nama";?></a></h4>
					</div>
						<p><?php echo htmlspecialchars_decode(stripslashes($row->deskripsi));?></p>
					</div>
					</div>
				<?php
				} ?>
				<div class="clearfix"> </div>
			</div>/-->
		</div>
	</div>
