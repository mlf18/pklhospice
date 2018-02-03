<?php
$pesan=""; 
require_once('db_login.php');
function encryptIt( $q ) {
    $cryptKey  = 'aJB0rGtIn5UB1xG03efyCp';
    $qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
    return( $qEncoded );
}

function decryptIt( $q ) {
    $cryptKey  = 'aJB0rGtIn5UB1xG03efyCp';
    $qDecoded      = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
    return( $qDecoded );
}
function login(){
	global $db;
	global $pesan;
	if($_POST){
	if($_POST['login']=="login"){
	$username=$_POST['username'];
	$password=encryptIt($_POST['password']);
	$sql="select * from user where username='$username' and password='$password'";
	$result=$db->query($sql);
	if(!$result){
		die($db->error);
	}
	if($result->num_rows > 0){
	while($row=$result->fetch_object()){ 	
		$_SESSION['iduser']=$row->id;
		$_SESSION['username']=$row->username;
		$_SESSION['password']=$row->password;
	}
	if($_SESSION['username']!=""){
		echo $_SESSION['username'];
		header("Location: index.php");
	}
	if($_POST['remember']=="Remember Me"){
		$cookie_name=$_SESSION['username'];
		$cookie_password=$_SESSION['username'];
		setcookie($cookie_name, $cookie_password, time() + (86400 * 900), "/");
	}	
	}else{
		$pesan='<label class="label label-danger">Login Gagal. Periksa Username atau Password <a href="index.php?login=4">lupa password</a></label>';
	}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Halaman Login</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->
<style>
.pesan-danger{
	color:red;
}
</style>
</head>

<body>
	
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Log in</div>
				<div class="panel-body">
				<?php echo $pesan;?>
					<form role="form" action="" method="post" enctype='multipart/form-data'>
						<fieldset>
						<input type="hidden" name="login" value="login"/>
							<div class="form-group">
								<input class="form-control" placeholder="Username" name="username" type="text" autofocus="" required>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="password" type="password" value="" required>
							</div>
							<div class="checkbox">
								<label>
									<input name="remember" type="checkbox" value="Remember Me">Remember Me
								</label>
							</div>
							<input type="submit" class="btn btn-primary" value="Login"></input>
						</fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
	
		

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script>
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
<?php }
?>
<?php 
function ganti_password($id){
	global $db;
	global $pesan;
	if($_POST){
	if($_POST['login']=="ganti"){
	$username=$_POST['username'];
	$password=encryptIt($_POST['password']);
	$email=$_POST['email'];
	$sql="UPDATE `user` SET `username` = '$username',`password`='$password' WHERE `user`.`id` = $id";
	$result=$db->query($sql);
	if(!$result){
		die($db->error);
	}else{
		$pesan='<label class="label label-success">Data Akun Telah Diubah</label>';
		logout();
		header("Location: login.php?login=1");
	}}
}else{
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Halaman Login</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->
</head>

<body>
	
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Form Ganti Password</div>
				<div class="panel-body">
				<?php echo $pesan;?>
					<form role="form" action="" method="post" enctype='multipart/form-data'>
						<fieldset>
						<input type="hidden" name="login" value="ganti"/>
							<div class="form-group">
								<label>Username</label>
								<input class="form-control" placeholder="Username" name="username" type="text" autofocus="" required>
							</div>
							<div class="form-group">
								<label>E-mail</label>
								<input class="form-control" placeholder="E-mail" name="email" type="email" required>
							</div>
							<div class="form-group">
								<label>Password</label>
								<input class="form-control" placeholder="Password" name="password" type="password" required>
							</div>
							<input type="submit" class="btn btn-primary" value="Submit"></input>
						</fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
	
		

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script>
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
<?php }}
function logout(){
	setcookie("user", "", time() - 3600);
	session_unset();
	session_destroy();
}
function lupa_password(){
	global $db;
	global $pesan;
	$pesan="";
if($_POST){
	$username=$_POST['username'];
	$sql="select * from user where username='$username'";
	$result=$db->query($sql);
	$row=$result->fetch_object();
	$to = "$row->mail";
	$subject = "Lupa Password";
	$message = "
	<html>
	<head>
	<title>Password Derma</title>
	</head>
	<body>
	<table>
	<tr>
	<th>username</th>
	<td>:</td>
	<td>$row->username</td>
	</tr>
	<tr>
	<td>password</td>
	<td>:</td>
	<td>decryptIt($row->password)</td>
	</tr>
	</table>
	</body>
	</html>
	";
	// Always set content-type when sending HTML email
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	// More headers
	$headers .= 'From: <webmaster@derma.com>' . "\r\n";
	mail($to,$subject,$message,$headers);
	$pesan='<label class="label label-info">Password Telah di Kirim ke Alamat E-mail</label>';
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Halaman Login</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->
<style>
.pesan-danger{
	color:red;
}
</style>
</head>

<body>
	
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Lupa Password</div>
				<div class="panel-body">
					<form role="form" action="" method="post" enctype='multipart/form-data'>
						<fieldset>
						<input type="hidden" name="login" value="lupa"/>
							<div class="form-group">
								<input class="form-control" placeholder="Username" name="username" type="text" autofocus="" required>
							</div>
							<div class="form-group">
								<label class="pesan-danger"><?php echo $pesan;?></label>
							</div>
							<input type="submit" class="btn btn-primary" value="Submit"></input>
						</fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
	
		

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script>
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
<?php }
session_start();
if($_GET['login']==1){
	/*if(!isset($_COOKIE[$cookie_name])) {
    
} else {
	login();
    echo "Cookie '" . $cookie_name . "' is set!<br>";
    echo "Value is: " . $_COOKIE[$cookie_name];
}*/
	login();
}elseif($_GET['login']==2){
	if (empty($_SESSION['username'])){
	header("Location: login.php?login=1");	
}
	ganti_password($_SESSION['iduser']);
}elseif($_GET['login']==3){
	logout();login();
}elseif($_GET['login']==4){
	lupa_password();
}
?>