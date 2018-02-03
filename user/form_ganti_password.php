<html>
<head>
<body>			
			<div class="row-fluid sortable">
				<div class="box span10">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Form Ganti Password</h2>
						<div class="box-icon">
							
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal " method="POST" action="user/update_password.php?id=<?php echo $id_user?>">
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
							  <button type="submit" id="kirim" value="kirim" class="btn btn-primary">Save Changes</button>
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