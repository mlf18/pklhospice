<?php
require_once('config/db_login.php');
if(!empty($_GET['tanggal'])){
$tanggal=$_GET['tanggal'];
$idcabang=$_GET['idcabang'];
$clearfix=1;
if($tanggal ==0){
}
else{
$alert="";
if($idcabang=="semua"){
	$sql="select * from gambar where timediff('$tanggal',tanggal) > 0 order by tanggal desc limit 3";
}elseif($idcabang=="other"){
	$sql="select * from gambar where idcabang is NULL && timediff('$tanggal',tanggal) > 0 order by tanggal desc limit 3";
}else{
	$sql="select * from gambar where idcabang = $idcabang && timediff('$tanggal',tanggal) > 0 order by tanggal desc limit 3";
}
$result=$db->query($sql);
if(!$result){
	echo $db->error;
}
$ro=$result->num_rows;
if($ro > 0){
	echo '<div id="isi_gambar">';
while($row1=$result->fetch_object()){
						$tanggal=$row1->tanggal;
					?>
					<div class="col-md-4 img-top ">
					   		  			   <a href="images/<?php echo $row1->gambar;?>" rel="title" class="b-link-stripe b-animate-go  swipebox">
					   		  			   	<img src="images/small_<?php echo $row1->gambar;?>" class="img-responsive" alt=""/>
												 <div class="link-top">
												 <i class="link"> </i>
												 </div>
					   		  			   </a>
										</div>
					<?php } 
					if($ro < 3){
					$tanggal="";}?>
					
					<input type="hidden" id="laast_loaded" name="last_loaded" value="<?php echo $tanggal;?>"></input>
					</div>
					<?php
}
else{
	echo "
	<div class='clearfix'></div>
	<div class='col-md-12'>
	<p class='text-center'><strong></strong></p><input type='hidden' id='laast_loaded' name='last_loaded' value='kosong'></input>
	</div>";
}
}
}
else{
	echo "
	<div class='clearfix'></div>
	<div class='col-md-12'>
	<p class='text-center'><strong></strong></p><input type='hidden' id='laast_loaded' name='last_loaded' value='kosong'></input>
	</div>";
}
?>