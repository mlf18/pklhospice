<?php
include('config/db_login.php');
include('config/fungsi_select.php');
include('counter.php');
	$judul="";
	if(!empty($_GET['isi'])){
	$id=$_GET['id'];
	$isi=$_GET['isi'];
	$sql="select * from $isi where id='$id'";
	$result = $db->query($sql);
	if(!$result){
		die("Could not query the database: </br>".$db->error);
	}
	$row=$result->fetch_object();
	$judul='| '.$row->nama;
	}elseif(!empty($_GET['modul'])){
		$mod=$_GET['modul'];
	if ($mod==1 || empty($mod)){
		$judul="| Home";
	}else if($mod==2){
		$judul="| About Us";
	}elseif($mod==3){
		$judul="| Features";
	}elseif($mod==4){
		$judul="| Career";
	}elseif($mod==5){
		$judul="| Gallery";
	}elseif($mod==6){
		$judul="| Contact";
	}
	}
?>
<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
<title>Derma <?php echo "$judul";?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Klinik Kesehatan, Klinik kecantikan, klinik kulit" />
<meta property="og:url"           content="index" />
<meta property="og:type"          content="website" />
<meta property="og:title"         content="Derma" />
<meta property="og:description"   content="Klinik Kesehatan, Klinik kecantikan, klinik kulit" />
<meta property="og:image"         content="images/Logo.png" />
<link href="css/bootstrap.css" type="text/css" rel="stylesheet" media="all">
<link href="css/style.css" type="text/css" rel="stylesheet" media="all">
<!--web-font-->
<link href='css/font.css' rel='stylesheet' type='text/css'>
<link href='css/fontroboto.css' rel='stylesheet' type='text/css'>
<style>
#map{
width:100%;
height:380px;
margin-bottom:1em;}
</style>
<!--//web-font-->
<!-- Custom Theme files -->
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<!-- //Custom Theme files -->
<!-- js -->
<script src="js/jquery.min.js"></script>
	<script src="config/script.js"></script>
<script src="js/modernizr.custom.js"></script>
<!-- //js -->	
<!-- start-smoth-scrolling-->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<script type="text/javascript" src="js/modernizr.custom.53451.js"></script>	
<script type="text/javascript">
		jQuery(document).ready(function($) {
			$(".scroll").click(function(event){		
				event.preventDefault();
				$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
			});
		});
</script>
<!--//end-smoth-scrolling-->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v2.6&appId=1257651207583972";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
<?php
	if($_GET){
	$mod=$_GET['modul'];}
	else{$mod='';}
?>
</head>
<body>
	<!--header-->
	<div class="header">
		<div class="container-fluid">
			<a href="home"> <img src= "images/Logo.png" width="160px" height="55px"> </a>
			<div class="top-nav">
				<span class="menu"><img src="images/menu-icon.png" alt=""/></span>	
	<?php if ($mod==1 || empty($mod)){
		echo"
				<ul class='nav1'>
					<li><a href='home' class='active'>Home</a></li>
					<li><a href='about'>About</a></li>
					<li><a href='career'>Career</a></li>
					<li><a href='features'>Features</a></li>
					<li><a href='gallery'>Gallery</a></li>
					<li><a href='contact'>Contact</a></li>
				</ul>";
	}else if($mod==2){
		echo"
				<ul class='nav1'>
					<li><a href='home'>Home</a></li>
					<li><a href='about' class='active'>About</a></li>
					<li><a href='career'>Career</a></li>
					<li><a href='features'>Features</a></li>
					<li><a href='gallery'>Gallery</a></li>
					<li><a href='contact'>Contact</a></li>
				</ul>";
	}elseif($mod==3){
		echo"
				<ul class='nav1'>
					<li><a href='home'>Home</a></li>
					<li><a href='about' >About</a></li>
					<li><a href='career'>Career</a></li>
					<li><a href='features' class='active'>Features</a></li>
					<li><a href='gallery'>Gallery</a></li>
					<li><a href='contact' >Contact</a></li>
				</ul>";
	}elseif($mod==4){
		echo"
				<ul class='nav1'>
					<li><a href='home'>Home</a></li>
					<li><a href='about'>About</a></li>
					<li><a href='career' class= 'active'>Career</a></li>
					<li><a href='features'>Features</a></li>
					<li><a href='gallery'>Gallery</a></li>
					<li><a href='contact'>Contact</a></li>
				</ul>";
	}elseif($mod==5){
		echo"
				<ul class='nav1'>
					<li><a href='home'>Home</a></li>
					<li><a href='about'>About</a></li>
					<li><a href='career'>Career</a></li>
					<li><a href='features'>Features</a></li>
					<li><a href='gallery' class='active'>Gallery</a></li>
					<li><a href='contact'>Contact</a></li>
				</ul>";	
	}elseif($mod==6){
		echo"
				<ul class='nav1'>
					<li><a href='home'>Home</a></li>
					<li><a href='about'>About</a></li>
					<li><a href='career'>Career</a></li>
					<li><a href='features'>Features</a></li>
					<li><a href='gallery'>Gallery</a></li>
					<li><a href='contact' class='active'>Contact</a></li>
				</ul>";	
	}elseif($mod==7){
		echo"
				<ul class='nav1'>
					<li><a href='home'>Home</a></li>
					<li><a href='about'>About</a></li>
					<li><a href='career'>Career</a></li>
					<li><a href='features'>Features</a></li>
					<li><a href='gallery'>Gallery</a></li>
					<li><a href='contact'>Contact</a></li>
				</ul>";	
	}
	else{
		echo"
				<ul class='nav1'>
					<li><a href='home'>Home</a></li>
					<li><a href='about'>About Us</a></li>
					<li><a href='career'>Career</a></li>
					<li><a href='features'>Features</a></li>
					<li><a href='gallery'>Gallery</a></li>
					<li><a href='contact'>Contact</a></li>
				</ul>";
	} 
	?>				
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
	<!--content-->
	<?php if ($mod==1 || empty($mod)){
		include('modul/main/main.php');
	}else if($mod==2){
		include('modul/about/about.php');
	}elseif($mod==3){
		include('modul/fitur/features.php');
	}elseif($mod==4){
		include('modul/career/career.php');
	}elseif($mod==5){
		include('modul/porto/portfolio.php');
	}elseif($mod==6){
		include('modul/contact/contact.php');
	}elseif($mod==7){
		include('singlepage.php');
	}else{
		include('modul/404/blog.php');
	} 
	?>
	<!--//content-->
	<div class="footer">
		<div class="container">
			<div class="footer-left">
				<a href="home">Hospice</a>
			</div>
			<div class="footer-right">
				<p>© 2015 Hospice . All rights reserved | Template by <a href="http://w3layouts.com/"> W3layouts</a></p>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
	   
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
		<script type="text/javascript">
						$(function () {
							var filterList = {
								init: function () {
									// MixItUp plugin
								// http://mixitup.io
								$('#portfoliolist').mixitup({
									targetSelector: '.portfolio',
									filterSelector: '.filter',
									effects: ['fade'],
									easing: 'snap',
									// call the hover effect
									onMixEnd: filterList.hoverEffect()
								});	
							},
							hoverEffect: function () {
								// Simple parallax effect
								$('#portfoliolist .portfolio').hover(
									function () {
										$(this).find('.label').stop().animate({bottom: 0}, 200, 'easeOutQuad');
										$(this).find('img').stop().animate({top: -30}, 500, 'easeOutQuad');				
									},
									function () {
										$(this).find('.label').stop().animate({bottom: -40}, 200, 'easeInQuad');
										$(this).find('img').stop().animate({top: 0}, 300, 'easeOutQuad');								
									}		
								);				
							}
						};
						// Run the show!
							filterList.init();
						});	
						</script>
		<a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
	<!--//smooth-scrolling-of-move-up-->	

</body>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-57b6fca5d6a0c1c0"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script src="config/jq.js"></script>
</html>	