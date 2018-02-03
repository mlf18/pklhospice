<?php 
	function update_password($id){

	$passwordlama=md5($_POST['passwordlama']);
	$passwordbaru=md5($_POST['passwordbaru']);
	$konfirmasi=md5($_POST['konfirmasi']);
	
	$id = $_SESSION['id'];
	$query=mysql_query("SELECT * FROM guru_bk WHERE username='$_SESSION[username]' AND nip='$id'");
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
							$_SESSION['notifikasipassword']=' ';
							// header('location:http://localhost/beka/body.php?modul=20&aksi=');
				}
			}else {
						echo'<div class="alert alert-error">
										<button type="button" class="close" data-dismiss="alert">x</button>
										<strong>Data gagal disimpan</strong>
									</div>';
						$_SESSION['notifikasipassword']=' ';
						// header('location:http://localhost/beka/body.php?modul=20&aksi=');	
						echo mysql_error();
				}
	} else {
			echo'<div class="alert alert-error">
							<button type="button" class="close" data-dismiss="alert">x</button>
							<strong>Data gagal disimpan</strong>
						</div>';
			$_SESSION['notifikasipassword']=' ';
			// header('location:http://localhost/beka/body.php?modul=20&aksi=');	
			echo mysql_error();
	}
}	
?>

<?php function lihat_password ($id=null){?>

<html>
<head>
<body>			
			<div class="row-fluid sortable">
				<?php
					if(isset($_SESSION['notifikasipassword'])){
						echo $_SESSION['notifikasipassword'];
						unset ($_SESSION['notifikasipassword']);
					}
				?>
				<div class="box span10">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Form Ganti Password</h2>
						<div class="box-icon">
							
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal " method="POST" action="http://localhost/beka/body.php?modul=20">
						  <fieldset>
					
							<div class="control-group">
							  <label class="control-label" for="typeahead"> Password Lama </label>
							  <div class="controls">
								<input type="password" class="span6 typeahead" id="passwordlama" name="passwordlama" value="" data-provide="typeahead" data-items="4" required>
							  </div>
							</div>
							
							<div class="control-group">
							  <label class="control-label" for="typeahead"> Password Baru </label>
							  <div class="controls">
								<input type="password" class="span6 typeahead" id="passwordbaru" name="passwordbaru" value="" data-provide="typeahead" data-items="4" required>
								
							  </div>
							</div>
							
							<div class="control-group">
							  <label class="control-label" for="typeahead"> Konfirmasi Password </label>
							  <div class="controls">
								<input type="password" class="span6 typeahead" id="konfirmasi" name="konfirmasi" value="" data-provide="typeahead" data-items="4" required>
								
							  </div>
							</div>
							
							
							<div class="form-actions">
							  <button type="submit" name="aksi" value="update" class="btn btn-primary">Save Changes</button>
							  <button type="reset" class="btn">Cancel</button>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->
</body>

</head>
</html>
<?php }?>
<?php 
		if (isset($_POST['aksi'])){
			if ($_POST['aksi'] == null){lihat_password('update');}
			else if ($_POST['aksi']=='update'){
					update_password($_SESSION['id']);
					lihat_password('update');
				}
		}else{
			lihat_password();
		}
		
?>