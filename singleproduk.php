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
	$id=explode("-",$id);
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
				<h3><a href="index.html">HOME</a><span> / <?php echo $isi;?> </span></h3>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 single-page-left" >
				<div class="single-page-info">
					<img src="images/<?php echo $row->gambar;?>" alt="<?php echo $row->nama;?>"/>
					<h5><?php echo $row->nama;?></h5>
					<?php echo htmlspecialchars_decode(stripslashes($row->deskripsi));?>
					<div class="comment-icons">
					<ul>
						<li><div class="fb-share-button" style="height:100px;" data-href="<?php echo $isi;?>-<?php echo $id[0].'-'.$id[1];?>" data-layout="button"></div></li>
						<li><a href="https://twitter.com/share" class="twitter-share-button" data-text="<?php echo $row->nama;?>" data-hashtags="Derma">Tweet</a></li>
						<li><span class="clndr"></span><?php echo $row->tanggal;?></li>
						<li><span class="admin"></span> <a href="#"><?php echo $row->username;?></a></li>
					</ul>
				</div>
				</div>
	</div>	<?php }?>
	</div>
	</div><?php }else{
		include('modul/404/blog.php');
	}?>
	<!--//single-page-->
