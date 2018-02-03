<?php
	session_start();
	include 'db_login.php';

	//$kirim=$_POST['kirim'];
	$passwordlama=$_POST['passwordlama'];
	$passwordbaru=$_POST['passwordbaru'];
	$konfirmasi=$_POST['konfirmasi'];
	
	$query=mysql_query("SELECT * FROM guru_bk WHERE username='$_SESSION[username]'");
	$query2=mysql_fetch_array($query);
	$kata_sandi=$query2['kata_sandi'];
	$result= mysql_num_rows($query);
	if ($passwordlama == $kata_sandi){
		if($passwordbaru==$konfirmasi)
			{ 
				if($result)
				{
					mysql_query("UPDATE guru_bk set  kata_sandi='$passwordbaru'
														WHERE username='$_SESSION[username]'");			
				
							echo'<div class="alert alert-success">
										<button type="button" class="close" data-dismiss="alert">x</button>
										<strong>Data berhasil disimpan</strong>
									</div>';
							$_SESSION['notifikasipassword']="Ganti Password Berhasil";
							header('location:http://localhost/beka/body.php?modul=20&aksi=');			
				}
			}else {
						echo'<div class="alert alert-error">
										<button type="button" class="close" data-dismiss="alert">x</button>
										<strong>Data gagal disimpan</strong>
									</div>';
						$_SESSION['notifikasipassword']="Ganti Password Gagal";
						header('location:http://localhost/beka/body.php?modul=20&aksi=');	
						echo mysql_error();
				}
	}				
?>