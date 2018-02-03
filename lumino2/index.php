<?php
session_start();

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Derma | Admin</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/bootstrap-table.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">
<link rel="stylesheet" href="font-awesome-4.6.1/css/font-awesome.min.css">
<style>
    #table{
        width: 1px;
        white-space: nowrap;
    }
</style>

<!--Icons-->
<script src="js/lumino.glyphs.js"></script>
<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->
<?php 
require_once('db_login.php');
if(isset($_COOKIE['token'])){
    $tok=$_COOKIE['token'];
    $sql="select * from user where token = '$tok'";
    $result=$db->query($sql);
    if(!$result){
		die($db->error);
	}
    if($result->num_rows < 1){
        header("Location: login");
    }else{
        while($row=$result->fetch_object()){
            $_SESSION['username']=$row->username;
            $_SESSION['iduser']=$row->id;
        }
    }
}
if (empty($_SESSION['username'])){
	header("Location: login");
}else{
    $username=$_SESSION['username'];
    $sql="select * from user where username = '$username'";
    $result=$db->query($sql);
    if(!$result){
		die($db->error);
	}
    if($result->num_rows < 1){
        header("Location: login");
    }
}
if(!empty($_GET['modul'])){
$modul=$_GET['modul'];
}
else{
$modul='';
}
$idu=$_SESSION['iduser'];
?>
</head>

<body>
    <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
          <div id="isiaaaaa">
          </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index"><span>Derma</span>Admin</a>
				<ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> <?php echo "$username";?> <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="ubah-password"><svg class="glyph stroked gear"><use xlink:href="#stroked-gear"></use></svg> Ubah Akun</a></li>
							<li><a href="logout"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>
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
			<li class="active"><a href="index"><svg class="glyph stroked home"><use xlink:href="#stroked-home"/></svg> Home</a></li>
			<li class="parent" >
				<a href="#" ><div data-toggle="collapse" href="#sub-item-1"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg> Informasi</div></a>
				<ul class="children collapse" id="sub-item-1">
					<li>
						<a href="banner">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Banner
						</a>
					</li>
					<li>
						<a class="" href="cabang">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Cabang
						</a>
					</li>
					<li>
						<a class="" href="fitur">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Fitur
						</a>
					</li>
					<li>
						<a class="" href="produk">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Produk
						</a>
					</li>
					<li>
						<a class="" href="sejarah">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Sejarah
						</a>
					</li>
				</ul>
			</li>
			<li class="parent">
				<a href="#" ><div data-toggle="collapse" href="#sub-item-2"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg> Konten</div></a>
				<ul class="children collapse" id="sub-item-2">
					<li>
						<a class="" href="artikel">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Artikel
						</a>
					</li>
					<li>
						<a class="" href="galeri">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Galeri
						</a>
					</li>
					<li>
						<a class="" href="career">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Karir
						</a>
					</li>
				</ul>
			</li>
			<li class="parent">
				<a href="#" ><div data-toggle="collapse" href="#sub-item-3"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg> Kategori</div></a>
				<ul class="children collapse" id="sub-item-3">
					<li>
						<a class="" href="kategori_produk">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Produk
						</a>
					</li>
					<li>
						<a class="" href="kategori_career">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Karir
						</a>
					</li>
				</ul>
			</li>
			<li><a href="testimoni"><svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"/></svg>Testimoni</a></li>
		<?php }
		elseif ($modul==10){?>
		<li><a href="index"><svg class="glyph stroked home"><use xlink:href="#stroked-home"/></svg> Home</a></li>
			<li class="parent">
				<a href="#" ><div data-toggle="collapse" href="#sub-item-1"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg> Informasi</div></a>
				<ul class="children collapse" id="sub-item-1">
					<li>
						<a class="" href="banner">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Banner
						</a>
					</li>
					<li>
						<a class="" href="cabang">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Cabang
						</a>
					</li>
					<li>
						<a class="" href="fitur">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Fitur
						</a>
					</li>
					<li>
						<a class="" href="produk">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Produk
						</a>
					</li>
					<li>
						<a class="" href="sejarah">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Sejarah
						</a>
					</li>
				</ul>
			</li>
			<li class="parent">
				<a href="#" ><div data-toggle="collapse" href="#sub-item-2"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg> Konten</div></a>
				<ul class="children collapse" id="sub-item-2">
					<li>
						<a class="" href="artikel">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Artikel
						</a>
					</li>
					<li>
						<a class="" href="galeri">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Galeri
						</a>
					</li>
					<li>
						<a class="" href="career">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Karir
						</a>
					</li>
				</ul>
			</li>
			<li class="parent">
				<a href="#" ><div data-toggle="collapse" href="#sub-item-3"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg> Kategori</div></a>
				<ul class="children collapse" id="sub-item-3">
					<li>
						<a class="" href="kategori_produk">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Produk
						</a>
					</li>
					<li>
						<a class="" href="kategori_career">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Karir
						</a>
					</li>
				</ul>
			</li>
			<li class="active"><a href="testimoni"><svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"/></svg>Testimoni</a></li>
		<?php }
                elseif (($modul>=1 && $modul<=6)||$modul==12){?>
		<li><a href="index"><svg class="glyph stroked home"><use xlink:href="#stroked-home"/></svg> Home</a></li>
			<li class="parent">
                            <a href="#" ><div data-toggle="collapse" href="#sub-item-1"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg> Informasi</div></a>
				<ul class="children collapse in" id="sub-item-1">
					<li>
						<a class="" href="banner">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Banner
						</a>
					</li>
					<li>
						<a class="" href="cabang">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Cabang
						</a>
					</li>
					<li>
						<a class="" href="fitur">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Fitur
						</a>
					</li>
					<li>
						<a class="" href="produk">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Produk
						</a>
					</li>
					<li>
						<a class="" href="sejarah">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Sejarah
						</a>
					</li>
				</ul>
			</li>
			<li class="parent">
				<a href="#" ><div data-toggle="collapse" href="#sub-item-2"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg> Konten</div></a>
				<ul class="children collapse" id="sub-item-2">
					<li>
						<a class="" href="artikel">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Artikel
						</a>
					</li>
					<li>
						<a class="" href="galeri">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Galeri
						</a>
					</li>
					<li>
						<a class="" href="career">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Karir
						</a>
					</li>
				</ul>
			</li>
			<li class="parent">
				<a href="#" ><div data-toggle="collapse" href="#sub-item-3"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg> Kategori</div></a>
				<ul class="children collapse" id="sub-item-3">
					<li>
						<a class="" href="kategori_produk">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Produk
						</a>
					</li>
					<li>
						<a class="" href="kategori_career">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Karir
						</a>
					</li>
				</ul>
			</li>
			<li><a href="testimoni"><svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"/></svg>Testimoni</a></li>
		<?php }
                elseif (($modul>=7 && $modul<=9)){?>
		<li><a href="index"><svg class="glyph stroked home"><use xlink:href="#stroked-home"/></svg> Home</a></li>
			<li class="parent">
				<a href="#" ><div data-toggle="collapse" href="#sub-item-1"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg> Informasi</div></a>
				<ul class="children collapse" id="sub-item-1">
					<li>
						<a class="" href="banner">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Banner
						</a>
					</li>
					<li>
						<a class="" href="cabang">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Cabang
						</a>
					</li>
					<li>
						<a class="" href="fitur">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Fitur
						</a>
					</li>
					<li>
						<a class="" href="produk">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Produk
						</a>
					</li>
					<li>
						<a class="" href="sejarah">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Sejarah
						</a>
					</li>
				</ul>
			</li>
			<li class="parent">
				<a href="#" ><div data-toggle="collapse" href="#sub-item-2"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg> Konten</div></a>
				<ul class="children collapse in" id="sub-item-2">
					<li>
						<a class="" href="artikel">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Artikel
						</a>
					</li>
					<li>
						<a class="" href="galeri">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Galeri
						</a>
					</li>
					<li>
						<a class="" href="career">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Karir
						</a>
					</li>
				</ul>
			</li>
			<li class="parent">
				<a href="#" ><div data-toggle="collapse" href="#sub-item-3"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg> Kategori</div></a>
				<ul class="children collapse" id="sub-item-3">
					<li>
						<a class="" href="kategori_produk">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Produk
						</a>
					</li>
					<li>
						<a class="" href="kategori_career">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Karir
						</a>
					</li>
				</ul>
			</li>
			<li><a href="testimoni"><svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"/></svg>Testimoni</a></li>
		<?php }
                elseif ($modul==11){?>
		<li><a href="index"><svg class="glyph stroked home"><use xlink:href="#stroked-home"/></svg> Home</a></li>
			<li class="parent">
				<a href="#" ><div data-toggle="collapse" href="#sub-item-1"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg> Informasi</div></a>
				<ul class="children collapse" id="sub-item-1">
					<li>
						<a class="" href="banner">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Banner
						</a>
					</li>
					<li>
						<a class="" href="cabang">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Cabang
						</a>
					</li>
					<li>
						<a class="" href="fitur">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Fitur
						</a>
					</li>
					<li>
						<a class="" href="produk">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Produk
						</a>
					</li>
					<li>
						<a class="" href="sejarah">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Sejarah
						</a>
					</li>
				</ul>
			</li>
			<li class="parent">
				<a href="#" ><div data-toggle="collapse" href="#sub-item-2"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg> Konten</div></a>
				<ul class="children collapse" id="sub-item-2">
					<li>
						<a class="" href="artikel">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Artikel
						</a>
					</li>
					<li>
						<a class="" href="galeri">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Galeri
						</a>
					</li>
					<li>
						<a class="" href="career">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Karir
						</a>
					</li>
				</ul>
			</li>
			<li class="parent">
				<a href="#" ><div data-toggle="collapse" href="#sub-item-3"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg> Kategori</div></a>
				<ul class="children collapse in" id="sub-item-3">
					<li>
						<a class="" href="kategori_produk">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Produk
						</a>
					</li>
					<li>
						<a class="" href="kategori_career">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Karir
						</a>
					</li>
				</ul>
			</li>
			<li><a href="testimoni"><svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"/></svg>Testimoni</a></li>
		<?php }
		else {?>
			<li><a href="index"><svg class="glyph stroked home"><use xlink:href="#stroked-home"/></svg> Home</a></li>
			<li class="parent">
				<a href="#" ><div data-toggle="collapse" href="#sub-item-1"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg> Informasi</div></a>
				<ul class="children collapse" id="sub-item-1">
					<li>
						<a class="" href="banner">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Banner
						</a>
					</li>
					<li>
						<a class="" href="cabang">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Cabang
						</a>
					</li>
					<li>
						<a class="" href="fitur">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Fitur
						</a>
					</li>
					<li>
						<a class="" href="produk">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Produk
						</a>
					</li>
					<li>
						<a class="" href="sejarah">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Sejarah
						</a>
					</li>
				</ul>
			</li>
			<li class="parent">
				<a href="#" ><div data-toggle="collapse" href="#sub-item-2"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg> Konten</div></a>
				<ul class="children collapse" id="sub-item-2">
					<li>
						<a class="" href="artikel">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Artikel
						</a>
					</li>
					<li>
						<a class="" href="galeri">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Galeri
						</a>
					</li>
					<li>
						<a class="" href="career">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Karir
						</a>
					</li>
				</ul>
				</li>
				<li class="parent">
				<a href="#" ><div data-toggle="collapse" href="#sub-item-3"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg> Kategori</div></a>
				<ul class="children collapse" id="sub-item-3">
					<li>
						<a class="" href="kategori_produk">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Produk
						</a>
					</li>
					<li>
						<a class="" href="kategori_career">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Karir
						</a>
					</li>
				</ul>
			</li>
			<li><a href="testimoni"><svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"/></svg>Testimoni</a></li>
		<?php } ?>
		</ul>

	</div><!--/.sidebar-->
	<?php 
	if($modul==0){
		include("rumah.php");
	}elseif($modul==1){
		include("baner.php");
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
	}else{
		include("rumah.php");
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
        <link rel="stylesheet" type="text/css" href="js/DataTables-1.10.12/media/css/jquery.dataTables.css">
  <script>
		CKEDITOR.replace( 'deskripsi' );
        </script>
<script type="text/javascript" charset="utf8" src="js/DataTables-1.10.12/media/js/jquery.dataTables.js"></script>   
<script>
$(document).ready(function() {
    var t = $('#table').DataTable( {
        "columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "targets": 0
        } ],
        "order": [[ 1, 'asc' ]],
        "aoColumnDefs": [ {
            "orderable": false,
            "targets": -1,
        } ]
    } );
 
    t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
    $( ".tampil" ).on( "change", function() {
        var tampil = $(this).val();
        var id= $(this).find(':selected').data('id');
        $.ajax({
            url: 'aksitesti.php',
            type: 'POST',
            data: {id: id,tampil : tampil}
        })
        .done(function( html ) {
            alert( "Data telah diubah");
        });
    });
	$(".parent").click(function(){
		$(".parent").not(this).each(function(){
			if($(this).find("ul").hasClass("in")){
				$(this).find("ul").removeClass("in");
			}
		})
	})
} );
</script>
	<script>
$(document).ready(function() {
    var t = $('#tabletesti').DataTable( {
        "columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "targets": 0
        } ],
        "order": [[ 1, 'asc' ]],
        "aoColumnDefs": [ {
            "orderable": false,
            "targets": -1,
        } ]
    } );
 
    t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
} );
</script>
	
<script>
/* Formatting function for row details - modify as you need */
function format ( d ) {
    // `d` is the original data object for the row
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
        '<tr>'+
            '<td>Full name:</td>'+
            '<td>'+d.name+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Extension number:</td>'+
            '<td>'+d.extn+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Extra info:</td>'+
            '<td>And any further details here (images etc)...</td>'+
        '</tr>'+
    '</table>';
}
 
$(document).ready(function() {
    $('.open').on('click',function(){
        var id=$(this).data('id');
        var urel=$(this).data('url');
        var file=$(this).data('file');
        url=urel+id;
        $.get(url, function(result){
            var parsed = $.parseHTML(result)
            var content = $( parsed ).find( "#rrr" );
        if(file=='kecil'){
            $('.modal-dialog').css('width','30%');
        }else if(file=='sedang'){
            $('.modal-dialog').css('width','45%');
        }else{
            $('.modal-dialog').css('width','60%');
        }
       $( "#isiaaaaa" ).empty().append( result );
    });
    });
    var table = $('#example').DataTable( {
        "ajax": "../ajax/data/objects.txt",
        "columns": [
            {
                "className":      'details-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": ''
            },
            { "data": "name" },
            { "data": "position" },
            { "data": "office" },
            { "data": "salary" }
        ],
        "order": [[1, 'asc']]
    } );
     
    // Add event listener for opening and closing details
    $('#example tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    } );
} );
</script>
<script>
function checkPasswordMatch() {
    var password = $("#password").val();
    var confirmPassword = $("#repassword").val();

    if (password != confirmPassword)
        $("#divCheckPasswordMatch").html("* Passwords do not match!");
    else
        $("#divCheckPasswordMatch").html("dsddds");
    }
$(document).ready(function () {
   $("#repassword").keyup(checkPasswordMatch);
});
</script>
</body>
</html>
