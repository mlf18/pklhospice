<?php
require_once('config/db_login.php');
if(!empty($_GET['tanggal'])){
$tanggal=$_GET['tanggal'];
$clearfix=1;
if($tanggal ==0){
}
else{
$alert="";
$sql="select * from artikel where timediff('$tanggal',tanggal) > 0 ORDER BY tanggal DESC limit 4";
$result=$db->query($sql);
if(!$result){
	echo $db->error;
}
$ro=$result->num_rows;
if($ro > 0){
	echo '<div id="isi_berita">';
while($row=$result->fetch_object()){
						$tanggal=$row->tanggal;
						$di=$row->id;
						$isi=htmlspecialchars_decode(stripslashes($row->deskripsi));
						$isi=strip_tags($isi);
						if(strlen($isi)>50){
						
						$isi = substr_replace($isi,'.....',50);}
						else{
						}
						if(strlen($row->nama)>25){
						$nama=strip_tags($row->nama);
						$nama = substr_replace($nama,'.....',25);}
						else{
							$nama=$row->nama;
						}
					?>
					<div class="col-md-6 col-xs-6">
						<div class="content-left">
							<a href="images/small_<?php echo $row->gambar;?>" class="b-link-stripe b-animate-go   swipebox"  title="">
								<img class="img-responsive" src="images/small_<?php echo $row->gambar;?>" alt="" />
							</a>
							<h4 title="<?php echo $row->nama;?>"><?php echo "$nama";?></h4>
							<p><?php echo "$isi";?></p>
							<div class="text-center">
							<a class="rd-more" href="artikel_<?php echo $di;?>_<?php echo $row->nama;?>">Read More</a>
							</div>
						</div>
					</div>
					<?php 
					if ($clearfix==2){
						echo '<div class="clearfix"> </div>';
						$clearfix=0;
					}
					?>
					<?php $clearfix++;} ?>
					<input type="hidden" id="laast_loaded" name="last_loaded" value="<?php echo $tanggal;?>"></input>
					</div>
					<?php
}
else{
	$tanggal="a";
	echo "
	<p class='text-center'><strong></strong></p>
	<div class='col-md-6'>
	</div>
	<input type='hidden' id='laast_loaded' name='last_loaded' value=''></input>";
}
}
}
else{
	echo "<input type='hidden' id='laast_loaded' name='last_loaded' value='habis'></input>";
}
?>