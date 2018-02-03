		<div class="container" style="background-color:#fff;">
			<div class="about">
				<div class="about-skills">
			<div class="work-title">
				<h3>Bergabunglah Bersama<span>Kami</span></h3>
			</div>
			<div class="col-md-12">
			<?php
			$sql="select * from career";
			$result=$db->query($sql);
			if(!$result){
				die("Could not query the database: </br>".$db->error);
			}
				while($row=$result->fetch_object()){
						echo '
					<div class="about-choose">
					<div class="col-md-8 about-choose-info">
					<img src="images/'.$row->gambar.'" alt=""/>
					</div>
					<div class="col-md-4 about-choose-info">
					<h4>'.$row->nama.'</h4>
					<div class="clearfix"> </div>';
					$sql_kategori="select * from kategori_career where id=$row->idkategori";
					$result_kategori=$db->query($sql_kategori);
					if(!$result_kategori){
						die("Could not query the database: </br>".$db->error);
					}
					while($row_kategori=$result_kategori->fetch_object()){
						echo '<h5>'.$row_kategori->kategori.'</h5>';
					}
					echo '
					<p class="about-pgh">'.$row->deskripsi.'</p>
				</div>
				<div class="clearfix"> </div>
			</div>';}
			?>
		</div>
		</div>
	</div>
	</div>