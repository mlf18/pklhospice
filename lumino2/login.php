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
	$username=  mysqli_real_escape_string($db,$_POST['username']);
        $password= mysqli_real_escape_string($db,$_POST['password']);
	$password=encryptIt($password);
	$sql="select * from user where username='$username' and password='$password'";
	$result=$db->query($sql);
	if(!$result){
		die($db->error);
	}
	if($result->num_rows > 0){
	while($row=$result->fetch_object()){ 	
                $iduser=$row->id;
		$_SESSION['iduser']=$row->id;
		$_SESSION['username']=$row->username;
                setcookie('token', '', time() + (86400 * -1), "/");
	}
	if($_SESSION['username']!=""){
		if($_POST['remember']=="Remember Me"){
                $numb=  encryptIt(rand(12,1000));
                $sql="UPDATE `user` SET `token` = '$numb' WHERE `user`.`id` = $iduser";
                $result=$db->query($sql);
                $cookie_name = "token";
                $cookie_value = $numb;
                setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
                }
		header("Location: index");
	}	
	}else{
		$pesan='<label class="label label-danger">Login Gagal. Periksa Username atau Password <a href="lupa-password">lupa password</a></label>';
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
				
					<form role="form" action="" method="post" enctype='multipart/form-data'>
						<fieldset>
						<input type="hidden" name="login" value="login"/>
							<div class="form-group">
								<input class="form-control" placeholder="Username" name="username" type="text" autofocus="" required>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="password" type="password" value="" required>
							</div>
                                                        <?php if($pesan!=''){?>
                                                        <div class="form-group">
								<label class="pesan-danger"><?php echo $pesan;?></label>
							</div>
                                                        <?php } ?>
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
        $sql="select * from user where id=$id";
        $result=$db->query($sql);
        while($row = $result->fetch_object()){
            $username=$row->username;
            $password=$row->password;
            $mail=$row->mail;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
	if($_POST['login']=="ganti"){
            $username=$_POST['username'];
            $mail=$_POST['email'];
            if($_POST['password']==$_POST['repassword']){
                if($password==$_POST['password']){
                    $password=  decryptIt($_POST['password']);
                }else{
                    $password=$_POST['password'];
                }
                $password=  encryptIt($password);
                $sql="UPDATE `user` SET `username` = '$username',`password`='$password', `mail`='$mail' WHERE `user`.`id` = $id";
                $result=$db->query($sql);
                if(!$result){
                    die($db->error);
                }else{
                    $pesan='<label class="label label-success">Data Akun Telah Diubah<a href="index.php">Kembali</a></label>';
                }    
            }else{
                $pesan="Password didn't match";
            }
        }
        }
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Form Ganti Password</title>

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
				<div class="panel-heading">Form Ubah Data Akun</div>
				<div class="panel-body">
					<form role="form" action="" name="ubah" method="post" enctype='multipart/form-data'>
						<fieldset>
						<input type="hidden" name="login" value="ganti"/>
							<div class="form-group">
								<label>Username</label>
                                                                <input class="form-control" placeholder="Username" name="username" type="text" value="<?php echo $username;?>" autofocus="" required>
							</div>
							<div class="form-group">
								<label>E-mail</label>
                                                                <input class="form-control" placeholder="E-mail" name="email" type="email" value="<?php echo $mail;?>" required>
							</div>
							<div class="form-group">
								<label>Password</label>
                                                                <input class="form-control" placeholder="Password" name="password" id="password" type="password" value="<?php echo $password;?>" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$" required>
                                                                <!--<p style="font-size:12px;">* Password harus menggunakan huruf besar, huruf kecil, dan angka</p>-->
							</div>
                                                        <div class="form-group">
								<label>Retype Password</label>
								<input class="form-control" placeholder="Retype Password" name="repassword" id="repassword" type="password" value="<?php echo $password;?>" required>
                                                                <div id="divCheckPasswordMatch" style="color:red;"><?php echo $pesan;?></div>
							</div>
							<input type="submit" class="btn btn-primary" value="Submit"></input>
                                                        <a class="btn btn-info" href="index.php">Kembali</a>
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
function logout(){
    unset($_COOKIE['username']);
    unset($_COOKIE['iduser']);
    setcookie('username', null, -1, '/');
    setcookie('iduser', null, -1, '/');
	session_unset();
	session_destroy();
}
function lupa_password(){
	global $db;
	global $pesan;
	$pesan="";
if($_POST){
	$email=$_POST['email'];
	$sql="select * from user where mail='$email'";
	$result=$db->query($sql);
        if($result->num_rows > 0){
        $row=$result->fetch_object();
        $pass=decryptIt($row->password);
	$to = "$row->mail";
        $subject = "Lupa Password";
	$message = "";
        require 'PHPMailer-master/PHPMailerAutoload.php';
//Create a new PHPMailer instance
$mail = new PHPMailer;

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0;

//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 465;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'ssl';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "laderma78@gmail.com";

//Password to use for SMTP authentication
$mail->Password = "Qazwsx01";

//Set who the message is to be sent from
$mail->setFrom('laderma78@gmail.com', 'Derma');

//Set who the message is to be sent to
$mail->addAddress($row->mail, 'do-not reply');

//Set the subject line
$mail->Subject = $subject;
$mail->Body = "
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
	<td>$pass</td>
	</tr>
	</table>
	</body>
	</html>
	";
$mail->IsHTML(true); 
if (!$mail->send()) {
    $pesan='<label class="label label-danger">Mailer Error: '.$mail->ErrorInfo.'</label>';
} else {
    $pesan='<label class="label label-info">Password Telah di Kirim ke Alamat E-mail. <a href="http://localhost/file/hospice-web/lumino2">Masuk Kesistem</a></label>';
}    
        }else{
            $pesan=$pesan='<label class="label label-info">Email Tidak Ditemukan</label>';
        }
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Lupa Password</title>

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
								<input class="form-control" placeholder="Email Pemulihan" name="email" type="email" autofocus="" required>
							</div>
							<div class="form-group">
								<label class="pesan-danger"><?php echo $pesan;?></label>
							</div>
							<input type="submit" class="btn btn-primary" value="Submit"></input>
                                                        <a class="btn btn-info" href="index.php">Kembali</a>
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
	header("Location: login");	
}
	ganti_password($_SESSION['iduser']);
}elseif($_GET['login']==3){
	logout();header("Location: login");
}elseif($_GET['login']==4){
	lupa_password();
}
?>