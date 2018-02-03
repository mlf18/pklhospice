<!--contact-->
	<!--single-page-->
	
		<div class="container">
		<div class="contact" style="background:#FFF;">
			<div class="work-title">
				<h3>Contact</h3>
			</div>		
			<div class="address">			
			<?php
			$sql="select * from cabang";
			$result=$db->query($sql);
			if(!$result){
				die("Could not query the database: </br>".$db->error);
			}
			$i=1;
			while($row=$result->fetch_object()){
				if($row->kontak == ''){
					$row->kontak='-';
				}
				echo '
				<div class="col-sm-4 col-xs-12 col-md-4 address-grids">
				<div style="background-color:#F3F3F3;margin-bottom:1em;border-radius:20px !important;">
				<p class="text-center"><strong>'.$row->lokasi.'</strong></p>
					<p class="text-center"><span class="home"></span>'.$row->alamat.'</p>
				<p class="text-center"><span class="phn"></span>'.$row->kontak.'</p>
			</div>
			</div>
			';
			if($i==3){
				echo '<div class="clearfix"></div>';
				$i=1;
			}else{
				$i++;
			}
			}
			if($i!=3){
				echo '<div class="clearfix"></div>';
				$i=1;
			}
			?>
			</div>
			<div class="work-title sngl-title">
				<h3>FIND<span>US</span></h3>
			</div>
	<div class="container">
		<div class="contact-form">
		<div class="col-md-12 col-lg-12">
		<div class="text-center">
		<select id="lokasi" name="lokasi" >
		<option value='semua' selected>Semua</option>
		<?php 
		$sql="select idcabang,lokasi from cabang";
		$result=$db->query($sql);
		while($row=$result->fetch_object()){
			echo "<option value='$row->idcabang'>$row->lokasi</option>";
		}
		?>
		</select>
		</div>
		</div>
		</div>
		</div>
		<div id="map">
		</div>		
</div>	
</div>	
	<!--//contact-->