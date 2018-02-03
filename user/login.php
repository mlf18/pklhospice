<!DOCTYPE html>
<html>

<head>

  <meta charset="UTF-8">

  <title>Derma</title>

  <link rel='stylesheet'>

    <link rel="stylesheet" href="css/style2.css">

</head>

<body>
	
	<?php
		require 'db_login.php';
		session_start();
		$pesan_error = '';
		if (!empty($_POST['inputUsername']) && !empty($_POST['inputPassword'])) {
			$username=$_POST['inputUsername'];
			$password=md5($_POST['inputPassword']);
			$sql = "select * from user where username='$username' and password='$password'";
			$result = $db->query($sql);
			if(!$result){
		die("Could not query the database: </br>".$db->error);
	}
			$n=$result->num_rows;
			echo $n;
			if( $n > 0){
				while($data = $result->fetch_object()){
				$user=$data->username;
				$pass=$data->password;
				$id=$data->id;}
				$_SESSION['username']=$user;
				$_SESSION['password']=$pass;
				$_SESSION['id']=$id;
				header('Location: body.php');
				
			}
			else{
				$pesan_error = 'cek kembali username dan password.';
				}
		}
	?>
  <div class="login-card">
    <h1>Log-in</h1><br>
	<?=$pesan_error?>
  <form action="" method="post">
    <input type="text" name="inputUsername" placeholder="Username" required>
    <input type="password" name="inputPassword" placeholder="Password" required>
    <input type="submit" name="login" class="login login-submit" value="login">
  </form>

</div>

</body>

</html>