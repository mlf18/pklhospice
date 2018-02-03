<!--//header-->
	
		<div class="container">
		<div class="features">
			<div class="work-title">
				<h3>LATEST<span>FEATURES</span></h3>
			</div>
			<div class="features-info">
				<?php 
					$sql="select * from fitur";
					$result=$db->query($sql);
					if(!$result){
						die("Could not query the database: </br>".$db->error);
					}
					$i=1;
					if($result->num_rows > 0){
					while($row=$result->fetch_object()){
						$isi=$row->deskripsi;
						if(strlen(strip_tags($row->deskripsi)) > 255){
							$isi=substr_replace($row->deskripsi,'.....',250);
						}
						if ($i==1){
							echo '<div class="features-icons">';
						}
						echo'
						<div class="col-md-4 ftrs-icon-grids">
							<a href="fitur_'.$row->id.'_'.$row->nama.'" class="ft-icons"> <img src="images/small_'.$row->gambar.'" alt="" title=""/> </a>
								<a href="fitur_'.$row->id.'_'.$row->nama.'" ><h5>'.$row->nama.'</h5></a>
								<div style="color:#999"><p>'.$isi.'</p></div>
						</div>';
					if($i==3){
						echo '
						<div class="clearfix"> </div>
							</div>';
							$i=0;
					}
					$i++;
					}
					if($i!=1){
						echo '
						<div class="clearfix"> </div>
							</div>';
					}
					}
				?>				
			</div>
		</div>
	</div>	