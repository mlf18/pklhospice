<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
<title>Hospice a Medical Category Flat bootstrap Responsive website Template | Contact :: w3layouts</title>
<link href="css/bootstrap.css" type="text/css" rel="stylesheet" media="all">
<link href="css/style.css" type="text/css" rel="stylesheet" media="all">
<!--web-font-->
<link href='//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!--//web-font-->
<!-- Custom Theme files -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Hospice Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
	Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //Custom Theme files -->
<!-- js -->
<script src="js/jquery.min.js"></script>
<script src="js/modernizr.custom.js"></script>
<!-- //js -->	
<!-- start-smoth-scrolling-->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>	
<script type="text/javascript">
		jQuery(document).ready(function($) {
			$(".scroll").click(function(event){		
				event.preventDefault();
				$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
			});
		});
</script>
<!--//end-smoth-scrolling-->
</head>
<body>
	<!--header-->
	<div class="header">
		<div class="container">
			<div class="top-middle">
				<a href="index.html">
					<h3>Hospice</h3>
				</a>	
			</div>
			<div class="top-nav">
				<span class="menu"><img src="images/menu-icon.png" alt=""/></span>		
				<ul class="nav1">
					<li><a href="index.html">Home</a></li>
					<li><a href="about.html">About Us</a></li>
					<li><a href="features.html">Features</a></li>
					<li><a href="blog.html">Blog</a></li>
					<li><a href="portfolio.html">Portfolio</a></li>
					<li><a href="contact.html" class="active" >Contact Us</a></li>
				</ul>
				<!-- script-for-menu -->
				 <script>
				   $( "span.menu" ).click(function() {
					 $( "ul.nav1" ).slideToggle( 300, function() {
					 // Animation complete.
					  });
					 });
				</script>
				<!-- /script-for-menu -->
			</div>	
			<div class="clearfix"> </div>
		</div>	
	</div>
	<!--//header-->
	<!--contact-->
	<div class="single-page">
		<div class="container">
			<div class="work-title">
				<h3>CONTACT<span>US</span></h3>
			</div>
			<div class="col-md-8 single-page-left" >
					<br/>
					<h4>RECENT COMMENTS</h4>
					<?php
					include('config/db_login.php');
					$id=$_GET['idt'];
					$sql="select * from thread where idthread='$id'";
					$result=$db->query($sql);
					if(!$result){
						die("Could not query the database: </br>".$db->error);
					}
					while($row=$result->fetch_object()){
						$sql1="select * from `post` where `post`.`idthread`=$row->idthread order by tgl_post asc";
						$result1=$db->query($sql1);	
						if(!$result1){
							die("Could not query the database: </br>".$db->error);
						}
						while($row1=$result1->fetch_object()){
							if($row1->user=='admin'){
									$user='Admin';
							}else{	
								$user=$row1->user;
							}
						echo'
							<div class="response">
								<h4>RESPONSES</h4>
							<div class="response-info">
							<div class="response-text-left">
							<a href="#"><img src="images/icon11.png" alt=""/></a>
							<h5><a href="#">'.$user.'</a></h5>
							</div>
						<div class="response-text-right">
							<p>'.$row1->isipost.'</p>
							<ul>
								<li>'.$row1->tgl_post.'</li>
								<li><a href="#">Reply</a></li>
							</ul>
						</div>
						<div class="clearfix"> </div></div></div>';
						}
					}
					?>
		</div>
		</div>
	</div>
	<!--//contact-->
	<!--footer-->
	<div class="footer">
		<div class="container">
			<div class="footer-left">
				<a href="index.html">Hospice</a>
			</div>
			<div class="footer-right">
				<p>© 2015 Hospice . All rights reserved | Template by <a href="http://w3layouts.com/"> W3layouts</a></p>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
	<!--//footer-->
	<!--smooth-scrolling-of-move-up-->
		<script type="text/javascript">
			$(document).ready(function() {
				/*
				var defaults = {
					containerID: 'toTop', // fading element id
					containerHoverID: 'toTopHover', // fading element hover id
					scrollSpeed: 1200,
					easingType: 'linear' 
				};
				*/
				
				$().UItoTop({ easingType: 'easeOutQuart' });
				
			});
		</script>
		<a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
	<!--//smooth-scrolling-of-move-up-->
</body>
</html>	