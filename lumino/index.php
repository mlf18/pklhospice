<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Lumino - Dashboard</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/bootstrap-table.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">
<link rel="stylesheet" href="font-awesome-4.6.1/css/font-awesome.min.css">

<!--Icons-->
<script src="js/lumino.glyphs.js"></script>
<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->
<?php 
require_once('db_login.php');
if (empty($_SESSION['username'])){
	header("Location: login.php?login=1");	
}
$username=$_SESSION['username'];
if(!empty($_GET['modul'])){
$modul=$_GET['modul'];
}
else{
$modul='';
}
include("log.php");
?>
</head>

<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><span>Derma</span>Admin</a>
				<ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> <?php echo "$username";?> <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="login.php?login=2"><svg class="glyph stroked gear"><use xlink:href="#stroked-gear"></use></svg> Settings</a></li>
							<li><a href="login.php?login=3"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>
							
		</div><!-- /.container-fluid -->
	</nav>
		
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<ul class="nav menu">
		<?php 
		if ($modul==0){
		?>
			<li class="active"><a href="index.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"/></svg> Home</a></li>
			<li class="parent" >
				<a href="#" ><span data-toggle="collapse" href="#sub-item-1"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg> Informasi</span></a>
				<ul class="children collapse" id="sub-item-1">
					<li>
						<a href="index.php?modul=1">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Banner
						</a>
					</li>
					<li>
						<a class="" href="index.php?modul=2">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Cabang
						</a>
					</li>
					<li>
						<a class="" href="index.php?modul=12">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Fitur
						</a>
					</li>
					<li>
						<a class="" href="index.php?modul=3">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Produk
						</a>
					</li>
					<li>
						<a class="" href="index.php?modul=4">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Sejarah
						</a>
					</li>
					<li>
						<a class="" href="index.php?modul=5">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Staff
						</a>
					</li>
					<li>
						<a class="" href="index.php?modul=6">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Video
						</a>
					</li>
				</ul>
			</li>
			<li class="parent">
				<a href="#" ><span data-toggle="collapse" href="#sub-item-2"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg> Konten</span></a>
				<ul class="children collapse" id="sub-item-2">
					<li>
						<a class="" href="index.php?modul=7">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Artikel
						</a>
					</li>
					<li>
						<a class="" href="index.php?modul=8">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Galeri
						</a>
					</li>
					<li>
						<a class="" href="index.php?modul=9">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Karir
						</a>
					</li>
				</ul>
			</li>
			<li class="parent">
				<a href="#" ><span data-toggle="collapse" href="#sub-item-3"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg> Kategori</span></a>
				<ul class="children collapse" id="sub-item-3">
					<li>
						<a class="" href="index.php?modul=11&kategori=produk">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Produk
						</a>
					</li>
					<li>
						<a class="" href="index.php?modul=11&kategori=career">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Career
						</a>
					</li>
				</ul>
			</li>
			<li><a href="index.php?modul=10"><svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"/></svg>Testimoni</a></li>
			<li role="presentation" class="divider"></li>
			<li><a href="login.html"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Login Page</a></li>
		<?php }
		elseif ($modul==10){?>
		<li><a href="index.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"/></svg> Home</a></li>
			<li class="parent">
				<a href="#" ><span data-toggle="collapse" href="#sub-item-1"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg> Informasi</span></a>
				<ul class="children collapse" id="sub-item-1">
					<li>
						<a class="" href="index.php?modul=1">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Banner
						</a>
					</li>
					<li>
						<a class="" href="index.php?modul=2">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Cabang
						</a>
					</li>
					<li>
						<a class="" href="index.php?modul=12">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Fitur
						</a>
					</li>
					<li>
						<a class="" href="index.php?modul=3">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Produk
						</a>
					</li>
					<li>
						<a class="" href="index.php?modul=4">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Sejarah
						</a>
					</li>
					<li>
						<a class="" href="index.php?modul=5">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Staff
						</a>
					</li>
					<li>
						<a class="" href="index.php?modul=6">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Video
						</a>
					</li>
				</ul>
			</li>
			<li class="parent">
				<a href="#" ><span data-toggle="collapse" href="#sub-item-2"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg> Konten</span></a>
				<ul class="children collapse" id="sub-item-2">
					<li>
						<a class="" href="index.php?modul=7">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Artikel
						</a>
					</li>
					<li>
						<a class="" href="index.php?modul=8">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Galeri
						</a>
					</li>
					<li>
						<a class="" href="index.php?modul=9">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Karir
						</a>
					</li>
				</ul>
			</li>
			<li class="parent">
				<a href="#" ><span data-toggle="collapse" href="#sub-item-3"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg> Kategori</span></a>
				<ul class="children collapse" id="sub-item-3">
					<li>
						<a class="" href="index.php?modul=11&kategori=produk">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Produk
						</a>
					</li>
					<li>
						<a class="" href="index.php?modul=11&kategori=career">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Career
						</a>
					</li>
				</ul>
			</li>
			<li class="active"><a href="index.php?modul=10"><svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"/></svg>Testimoni</a></li>
			<li role="presentation" class="divider"></li>
			<li><a href="login.html"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Login Page</a></li>
		<?php } 
		else {?>
			<li><a href="index.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"/></svg> Home</a></li>
			<li class="parent">
				<a href="#" ><span data-toggle="collapse" href="#sub-item-1"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg> Informasi</span></a>
				<ul class="children collapse" id="sub-item-1">
					<li>
						<a class="" href="index.php?modul=1">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Banner
						</a>
					</li>
					<li>
						<a class="" href="index.php?modul=2">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Cabang
						</a>
					</li>
					<li>
						<a class="" href="index.php?modul=12">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Fitur
						</a>
					</li>
					<li>
						<a class="" href="index.php?modul=3">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Produk
						</a>
					</li>
					<li>
						<a class="" href="index.php?modul=4">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Sejarah
						</a>
					</li>
					<li>
						<a class="" href="index.php?modul=5">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Staff
						</a>
					</li>
					<li>
						<a class="" href="index.php?modul=6">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Video
						</a>
					</li>
				</ul>
			</li>
			<li class="parent">
				<a href="#" ><span data-toggle="collapse" href="#sub-item-2"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg> Konten</span></a>
				<ul class="children collapse" id="sub-item-2">
					<li>
						<a class="" href="index.php?modul=7">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Artikel
						</a>
					</li>
					<li>
						<a class="" href="index.php?modul=8">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Galeri
						</a>
					</li>
					<li>
						<a class="" href="index.php?modul=9">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Karir
						</a>
					</li>
				</ul>
				</li>
				<li class="parent">
				<a href="#" ><span data-toggle="collapse" href="#sub-item-3"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg> Kategori</span></a>
				<ul class="children collapse" id="sub-item-3">
					<li>
						<a class="" href="index.php?modul=11&kategori=produk">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Produk
						</a>
					</li>
					<li>
						<a class="" href="index.php?modul=11&kategori=career">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Career
						</a>
					</li>
				</ul>
			</li>
			<li><a href="index.php?modul=10"><svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"/></svg>Testimoni</a></li>
			<li role="presentation" class="divider"></li>
			<li><a><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Login Page</a></li>
		<?php } ?>
		</ul>

	</div><!--/.sidebar-->
	<?php 
	if($modul==0){
		include("rumah.php");
	}elseif($modul==1){
		include("banner.php");
	}elseif($modul==2){
		include("cabang.php");
	}elseif($modul==3){
		include("produk.php");
	}elseif($modul==4){
		include("sejarah.php");
	}elseif($modul==5){
		include("staff.php");
	}elseif($modul==6){
		include("video.php");
	}elseif($modul==7){
		include("artikel.php");
	}elseif($modul==8){
		include("galeri.php");
	}elseif($modul==9){
		include("karir.php");
	}elseif($modul==10){
		include("testimoni.php");
	}elseif($modul==11){
		include("kategori.php");
	}elseif($modul==12){
		include("fitur.php");
	}elseif($modul==13){
		if(empty($_GET['aksi'])){
			$aksi='lihat_log';
		}else{
			$aksi=$_GET['aksi'];
		}
		if($modul==13){
		if ($aksi=="lihat_log"){lihat_log();}
		else if ($aksi=='hapus'){hapus_log();lihat_log();}
		}
	}
	
	?>
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/bootstrap-table.js"></script>
	<script src="js/ckeditor/ckeditor.js"></script>
	<script>
		CKEDITOR.replace( 'deskripsi' );
		CKEDITOR.editorConfig = function( config ) {
    config.extraPlugins = 'html5validation';
};
    </script>		
	<script>
		$('#calendar').datepicker({
		});

		!function ($) {
		    $(document).on("click","ul.nav li.parent > a > span.icon", function(){          
		        $(this).find('em:first').toggleClass("glyphicon-minus");      
		    }); 
		    $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);

		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})
	</script>	
</body>

</html>
