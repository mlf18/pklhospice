<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
	<!--single-page-->
	<div class="single-page">
		<div class="container">
		
	<?php 
	require_once('config/db_login.php');
	$id=$_GET['id'];
	$id=explode("_",$id,2);
	$isi=$_GET['isi'];
	$sql="select * from $isi join user on $isi.iduser=user.id where $isi.id='$id[0]' and $isi.nama='$id[1]'";
	$result = $db->query($sql);
	if(!$result){
		die("Could not query the database: </br>".$db->error);
	}
	if($result->num_rows>0){
	while($row=$result->fetch_object()){
	?>
			<div class="work-title sngl-title">
				<h3><a href="index">HOME</a><span> / <?php echo $isi;?> </span></h3>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 single-page-left" >
				<div class="single-page-info">
					<h5><?php echo $row->nama;?></h5>
					<div class="clearfix"></div>
					<div class="col-md-6">
						<img src="images/<?php echo $row->gambar;?>" alt="<?php echo $row->nama;?>"/>
					</div>
					<div class="clearfix"></div>
					<div class="isi" style="color:#5f5f5f;">
					<?php echo htmlspecialchars_decode(stripslashes($row->deskripsi));?>
					</div>
					
					<div class="comment-icons">
					<div class="addthis_native_toolbox"></div>
					<ul>

						<li><span class="clndr"></span><?php echo $row->tanggal;?></li>
						<li><span class="admin"></span> <?php echo $row->username;?></li>
					</ul>
				</div>
				</div>
	</div>	<?php }?>
	</div>
	</div><?php }else{
		include('modul/404/blog.php');
	}?>
	<!--//single-page-->
