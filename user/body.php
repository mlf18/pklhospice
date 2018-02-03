<?php
	session_start();
	require_once 'db_login.php';
	include'counter.php';
	$name=$_SESSION['username'];
	if($name==null)
	{
		header('Location: login.php');
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	
	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>Derma Skin Care</title>
	<meta name="description" content="Bootstrap Metro Dashboard">
	<meta name="author" content="Dennis Ji">
	<meta name="keyword" content="Derma, Skin Care,Perawatan Kulit, Klinik">
	<!-- end: Meta -->
	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- end: Mobile Specific -->
	<!-- start: CSS -->
	<link id="bootstrap-style" href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
	<link id="base-style" href="css/style.css" rel="stylesheet">
	<link id="base-style-responsive" href="css/style-responsive.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>
	<style>
	.table td{
   text-align: center;   
	}
	.table th{
   text-align: center;   
	}	
	</style>
	<!-- end: CSS -->
	

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<link id="ie-style" href="css/ie.css" rel="stylesheet">
	<![endif]-->
	
	<!--[if IE 9]>
		<link id="ie9style" href="css/ie9.css" rel="stylesheet">
	<![endif]-->
		<script src="js/ckeditor/ckeditor.js"></script>
	<!-- start: Favicon -->
	<link rel="shortcut icon" href="img/favicon.ico">
	<!-- end: Favicon -->		
</head>
<body >
		<!-- start: Header -->
	<div class="navbar">
	<div class="col-lg-12" style="color:black;">
		</div>
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="body.php"><span>Derma Skin Care</span></a>
				<!-- start: Header Menu -->
				<div class="nav-no-collapse header-nav">
					<ul class="nav pull-right">
						<li class="dropdown">
							<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
								<i class="halflings-icon white user"></i>&nbsp;<?php echo $name;?>
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li><a href="#"><i class="halflings-icon off"></i> Logout</a></li>
								<li><a href="#"><i class="halflings-icon time"></i> Aktivitas Log</a></li>
								<li><a href="#"><i class="halflings-icon cog"></i> Ubah Password</a></li>
							</ul>
						</li>
						<!-- end: User Dropdown -->
					</ul>
				</div>
				<!-- end: Header Menu -->
				
			</div>
		</div>
	</div>
	<!-- start: Header -->
	
		<div class="container-fluid-full">
		<div class="row-fluid">
			
			<!-- start: Main Menu -->
			<div id="sidebar-left" class="span2">
				<div class="nav-collapse sidebar-nav">
					<ul class="nav nav-tabs nav-stacked main-menu">
						<li>
							<a href="body.php?modul=0"><i class="icon-home"></i><span class="hidden-tablet"> Home</span></a>
						</li>
						<li>
							<a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Informasi</span></a>
							<ul>
								<li><a class="submenu" href="body.php?modul=3"><i class="icon-file-alt"></i><span class="hidden-tablet"> Banner</span></a></li>
								<li><a class="submenu" href="body.php?modul=4"><i class="icon-file-alt"></i><span class="hidden-tablet"> Produk</span></a></li>
								<li><a class="submenu" href="body.php?modul=5"><i class="icon-file-alt"></i><span class="hidden-tablet"> Staff</span></a></li>
								<li><a class="submenu" href="body.php?modul=6"><i class="icon-file-alt"></i><span class="hidden-tablet"> Cabang</span></a></li>
								<li><a class="submenu" href="body.php?modul=16"><i class="icon-file-alt"></i><span class="hidden-tablet"> Sejarah</span></a></li>
								<li><a class="submenu" href="body.php?modul=7"><i class="icon-file-alt"></i><span class="hidden-tablet"> Video</span></a></li>
							</ul>	
						</li>
						<li>
						<a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Konten</span></a>
							<ul>
							<li>
								<a class="submenu" href="body.php?modul=9"><i class="icon-circle-blank"></i><span class="hidden-tablet"> Artikel</span></a>
							</li>
							<li>
								<a class="submenu" href="body.php?modul=10"><i class="icon-circle-blank"></i><span class="hidden-tablet"> Galeri</span></a>
							</li>
							<li>
								<a class="submenu" href="body.php?modul=15"><i class="icon-circle-blank"></i><span class="hidden-tablet"> Karir</span></a>
							</li>
							</ul>
						</li>
						<li>
							<a href="body.php?modul=11"><i class="icon-circle-blank"></i><span class="hidden-tablet"> Pertanyaan</span></a>
						</li>
						<li>
							<a href="body.php?modul=13"><i class="icon-circle-blank"></i><span class="hidden-tablet"> Testimoni</span></a>
						</li>
					</ul>
				</div>
			</div>
			<!-- end: Main Menu -->
			
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
			<!-- start: Content -->
			<div id="content" class="span10">
				<!--style="background: url(img/logo.jpg) !important;"-->
			
			
			<ul class="breadcrumb">
			
				<li>
					<i class="icon-home"></i>
					<a href="index.html">Home</a> 
					<i class="icon-angle-right"></i>
				</li>
				<?php
				if ($_GET){
					if($_GET['modul']==3){
						echo '<li><a href="#">Master</a>
							<i class="icon-angle-right"></i>
							<a href="#">HomePage</a>';
					}
					else if($_GET['modul']==4){
						echo '<li><a href="#">Master</a>
							<i class="icon-angle-right"></i>
							<a href="#">About Us</a>';
					}
					else if($_GET['modul']==5){
						echo '<li><a href="#">Master</a>
							<i class="icon-angle-right"></i>
							<a href="#">Feature</a>';
					}
					else if ($_GET['modul']==6){
						echo '<li><a href="#">Konseling</a>
							<i class="icon-angle-right"></i>
							<a href="#">Portofolio</a>';
					}
					else if($_GET['modul']==7){
						echo '<li><a href="#">Konseling</a>
							<i class="icon-angle-right"></i>
							<a href="#">Contact</a>';
					}
					else if($_GET['modul']==8){
						echo '<li><a href="#">Konseling</a>
							<i class="icon-angle-right"></i>
							<a href="#">Artikel</a>';
					}
					else if($_GET['modul']==9){
						echo '<li><a href="#">Konseling</a>
							<i class="icon-angle-right"></i>
							<a href="#">Konseling</a>';
					}
				}
			?>
				
			</ul>

			<?php
			if($_GET){
				if($_GET['modul']==0){
				include('rumah.php');
				}
				else if($_GET['modul']==3){
				include('event_promo.php');
				}
				else if($_GET['modul']==4){
				include('produk.php');
				}
				else if($_GET['modul']==5){
				include('staff.php');
				}
				else if($_GET['modul']==6){
				include('cabang.php');
				}
				else if($_GET['modul']==7){
				include('video.php');
				}
				else if($_GET['modul']==8){
				include('halaman_statis.php');
				}
				else if($_GET['modul']==9){
				include('artikel.php');
				}
				else if($_GET['modul']==10){
				include('galeri.php');
				}
				else if($_GET['modul']==11){
				include('jawaban.php');
				}
				else if($_GET['modul']==12){
				include('user.php');
				}
				else if($_GET['modul']==13){
				include('testi.php');
				}
				else if($_GET['modul']==14){
				include('kategori.php');
				}
				else if($_GET['modul']==15){
				include('career.php');
				}
				else if($_GET['modul']==16){
				include('sejarah.php');
				}
				else if($_GET['modul']==20){
				include('ubah-password.php');
				}
			}
			else {
			include('rumah.php');
			}
			?>
			

			
       

	</div><!--/.fluid-container-->
	
			<!-- end: Content -->
		</div><!--/#content.span10-->
		</div><!--/fluid-row-->
		
	<div class="modal hide fade" id="myModal">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Settings</h3>
		</div>
		<div class="modal-body">
			<p>Here settings can be configured...</p>
		</div>
		<div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Close</a>
			<a href="#" class="btn btn-primary">Save changes</a>
		</div>
	</div>
	
	<div class="clearfix"></div>
	
	<footer>

		<p>
			<span style="text-align:left;float:left">&copy; 2016 <a href="http://localhost/beka/body.php?modul=0">DERMA</a></span>	
		</p>

	</footer>
	
	<!-- start: JavaScript-->
		 <script>
            CKEDITOR.replace( 'deskripsi' );
        </script>		
		<script src="js/jquery-1.9.1.min.js"></script>
	<script src="js/jquery-migrate-1.0.0.min.js"></script>
	
		<script src="js/jquery-ui-1.10.0.custom.min.js"></script>
	
		<script src="js/jquery.ui.touch-punch.js"></script>
	
		<script src="js/modernizr.js"></script>
	
		<script src="js/bootstrap.min.js"></script>
	
		<script src="js/jquery.cookie.js"></script>
	
		<script src='js/fullcalendar.min.js'></script>
	
		<script src='js/jquery.dataTables.min.js'></script>

		<script src="js/excanvas.js"></script>
	<script src="js/jquery.flot.js"></script>
	<script src="js/jquery.flot.pie.js"></script>
	<script src="js/jquery.flot.stack.js"></script>
	<script src="js/jquery.flot.resize.min.js"></script>
	
		<script src="js/jquery.chosen.min.js"></script>
	
		<script src="js/jquery.uniform.min.js"></script>
		
		<script src="js/jquery.cleditor.min.js"></script>
	
		<script src="js/jquery.noty.js"></script>
	
		<script src="js/jquery.elfinder.min.js"></script>
	
		<script src="js/jquery.raty.min.js"></script>
	
		<script src="js/jquery.iphone.toggle.js"></script>
	
		<script src="js/jquery.uploadify-3.1.min.js"></script>
	
		<script src="js/jquery.gritter.min.js"></script>
	
		<script src="js/jquery.imagesloaded.js"></script>
	
		<script src="js/jquery.masonry.min.js"></script>
	
		<script src="js/jquery.knob.modified.js"></script>
	
		<script src="js/jquery.sparkline.min.js"></script>
	
		<script src="js/counter.js"></script>
		<script src="js/retina.js"></script>
		<script src="js/custom.js"></script>
		<script>
$(".optradio").change(function() {
	var id=$(this).attr("data-id");
	tampil=$(this).val();
    $.ajax({
    url: 'aksitesti.php',
    type: 'POST',
    data: {ida: id,tampil : tampil}
  })
    .done(function( html ) {
    alert( "Data has changed: " + tampil );
  });
});
		</script>
	<!-- end: JavaScript-->
	
</body>
</html>