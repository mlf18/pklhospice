<!--banner-->
	<div class="container">
	<div class="banner">
	<?php
	$pesan='';
if($_POST){
$captcha = $_POST['g-recaptcha-response'];
$secret_key = '6LfaVgkUAAAAACNkMlpiLi8RR0oSJTn3olXxNA16';
$testimoni=$_POST['testimoni'];
$nama=$_POST['nama'];
if($captcha!='' && $testimoni!='' && $nama!=''){
	$url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secret_key) . '&response=' . $captcha;   
	$recaptcha = file_get_contents($url);
	$recaptcha = json_decode($recaptcha, true);
	echo $recaptcha['success'].'aaaa';
	if($recaptcha['success']){
		$sql="INSERT INTO `testimoni` (`id`, `nama`, `testimoni`,`tanggal`) VALUES ('', '$nama', '$testimoni',now())";
		$result = $db->query( $sql);
		if(!$result){
			die("Could not query the database: </br>".$db->error);
		}
		echo'
			<div class="alert alert-success text-center" style="margin-top:40px;margin-bottom:0;">
				<strong>Testimoni Telah di Tambahkan!</strong>
			</div>';
		}else{
			$pesan='* Gagal mengirim testimoni periksa nama, testimoni dan captcha';
		}
	}else{
			$pesan='* Gagal mengirim testimoni periksa nama, testimoni dan captcha';
		}
}?>
		<!--//End-slider-script -->
			<script src="js/responsiveslides.min.js"></script>
			 <script>
				// You can also use "$(window).load(function() {"
				$(function () {
				  // Slideshow1
				  $("#slider3").responsiveSlides({
					auto: true,
					pager: false,
					nav: true,
					speed: 500,
					namespace: "callbacks",
					before: function () {
					  $('.events').append("<li>before event fired.</li>");
					},
					after: function () {
					  $('.events').append("<li>after event fired.</li>");
					}
				  });
			
				});
			  </script>
			<div  id="top" class="callbacks_container">
				<ul class="rslides" id="slider3">
				<?php
				$sql="SELECT * FROM event_promo ORDER BY `event_promo`.`tanggal` DESC";
				$result=$db->query($sql);
				if(!$result){
					die("Could not query the database: </br>".$db->error);
				}
				while($row=$result->fetch_object()){
					echo '<li>
						<a href="#"><img src="images/'.$row->gambar.'" alt="'.$row->nama.'" title="'.$row->nama.'"/ ></a>
					</li>';	
				}
				?>
				</ul>
			</div>
	
	<div class="clearfix"> </div>
	</div>
	</div>
	<!--//banner-->
	<!--work-->
	<div class="work">
		<div class="container">
			<div class="work-title">
				<h3>Our<span>Produk</span></h3>
			</div>
			<!--//End-slider-script -->
				 <script>
					// You can also use "$(window).load(function() {"
					$(function () {
					  // Slideshow 4
					  $("#slider4").responsiveSlides({
						auto:true,
						pager: false,
						nav: true,
						speed: 500,
						namespace: "callbacks",
						before: function () {
						  $('.events').append("<li>before event fired.</li>");
						},
						after: function () {
						  $('.events').append("<li>after event fired.</li>");
						}
					  });
				
					});
				  </script>
				<div id="top" class="callbacks_container">
					<ul class="rslides" id="slider4">
					<?php
						$n=1;
						$sql="select * from produk order by tanggal desc";
						$result=$db->query($sql);
						if(!$result){
							die("Could not query the database: </br>".$db->error);
						}
						while($row=$result->fetch_object()){
							if(strlen($row->deskripsi)>40){
								$deskrip = substr_replace(strip_tags(htmlspecialchars_decode(stripslashes($row->deskripsi))),'.....',50);
							}else{
								$deskrip=htmlspecialchars_decode(stripslashes($row->deskripsi));
							}
							if(strlen($row->nama)>16){
								$nama = substr_replace($row->nama,'.....',18);
							}else{
								$nama=$row->nama;
							}
						$sql1="select * from kategori_produk where id=$row->idkategori";
						$result1=$db->query($sql1);
						if(!$result1){
							die("Could not query the database: </br>".$db->error);
						}
						while($row1=$result1->fetch_object()){
							$kat=$row1->kategori;
						}
						if($n==1){
							echo '<li>
									<div class="work-grids">';
						}
						echo '<div class="work-grids-info">
								<div class="work-grids-text">
									<a href="produk_'.$row->id.'_'.$row->nama.'" title="'.$row->nama.'"><h4>'.$nama.'</h4></a>
										<h3>'.$kat.'</h3>
											<div class="work-gallery">							
												<img src="images/'.$row->gambar.'" alt="" title="img"/>
												<div class="figcaption">
													<a href="produk_'.$row->id.'_'.$row->nama.'" class="cptn-top"> </a>
													<a href="produk_'.$row->id.'_'.$row->nama.'" class="cptn-midle"> </a>
													<a href="produk_'.$row->id.'_'.$row->nama.'" class="cpnt-btm"> </a>	
												</div>
											</div>
										<p>'.$deskrip.'</p>
									</div>
								</div>';
									if($n == 4){
									echo 
									'<div class="clearfix"> </div>
											</div>
												</li>';
									$n = 0;
									}
									$n++;
									}
									if($n!=1){
									echo 
									'<div class="clearfix"> </div>
											</div>
												</li>';	
									}
									?>
					</ul>
					</div>
				</div>	
		</div>
	<!--//work-->
	<!--counting-->
	<?php
	$sql="select * from video";
	$result=$db->query($sql);
	if(!$result){
		die("Could not query the database: </br>".$db->error);
	}
	if($result->num_rows > 0){
	while($row=$result->fetch_object()){
		$nama=$row->judul;
		$isi=$row->isi;
	}
	?>
	
		<div class="container">
		<div class="video">
			<h3><?php echo $nama; ?></h3>
			<iframe width="560" height="315" src="<?php echo $isi; ?>" frameborder="0" allowfullscreen> </iframe>		
		</div>	
	</div>
	<!--//counting-->
	<?php } ?>
	<!--content-->
	
		<div class="container">
		<div class="content">
			<div class="content-grids">
				<div class="col-md-8 humble">
					<div class="work-title humble-title">
						<h3>What's<span>New ?</span></h3>
					</div>
					
					<?php 
					$clearfix=1;
					$sql="select * from artikel ORDER BY tanggal DESC limit 4";
					$result=$db->query($sql);
					while($row=$result->fetch_object()){
						$tanggal=$row->tanggal;
						$di=$row->id;
						$isi=htmlspecialchars_decode(stripslashes($row->deskripsi));
						$isi=strip_tags($isi);
						if(strlen($isi)>90){
						
						$isi = substr_replace($isi,'.....',100);}
						else{
						}
						if(strlen($row->nama)>25){
						$nama=strip_tags($row->nama);
						$nama = substr_replace($nama,'.....',25);}
						else{
							$nama=$row->nama;
						}
					?>
					<div class="col-xs-6 col-md-6">
						<div class="content-left">
							<a href="images/small_<?php echo $row->gambar;?>" class="b-link-stripe b-animate-go   swipebox"  title="">
								<img class="img-responsive" src="images/small_<?php echo $row->gambar;?>" alt="" />
							</a>
							<h4 title="<?php echo $row->nama;?>"><?php echo "$nama";?></h4>
							<p><?php echo "$isi";?></p>
							<div class="text-center">
							<a class="rd-more" href="artikel_<?php echo $di;?>_<?php echo $row->nama;?>">Read More</a>
							</div>
						</div>
					</div>
					<?php 
					if ($clearfix==2){
						echo '<div class="clearfix"> </div>';
						$clearfix=0;
					}
					?>
					<?php $clearfix++;} ?>
					<div id="berita">
					<input type="hidden" id="last_loaded" name="last_loaded" value="<?php echo $tanggal;?>"></input>
					</div>
					<div class="col-lg-8">
					<div class="col-lg-offset-6 text-center">
					<img id="loader" src="images/pageloader.gif" width="15%"/><br/>
					<button class="sw-more btn btn-default"  id="more">Show More</button>
					</div>
					</div>
					<link rel="stylesheet" href="css/swipebox.css">
						<script src="js/jquery.swipebox.min.js"></script> 
						<script type="text/javascript">
							jQuery(function($) {
								$(".swipebox").swipebox();
							});
						</script>
					<div class="clearfix"> </div>
				</div>
				<div class="col-sm-8 col-md-4 testi">
					<div class="work-title testi-title">
						<h3>OUR<span>TESTIMONIALS</span> </h3>
					</div>					
					<!--//End-slider-script -->
					<script src="js/responsiveslides.min.js"></script>
					 <script>
						// You can also use "$(window).load(function() {"
						$(function () {
						  // Slideshow 5
						  $("#slider5").responsiveSlides({
							auto: true,
							pager: false,
							nav: true,
							speed: 500,
							namespace: "callbacks",
							before: function () {
							  $('.events').append("<li>before event fired.</li>");
							},
							after: function () {
							  $('.events').append("<li>after event fired.</li>");
							}
						  });
					
						});
					  </script>
					<div  id="top" class="callbacks_container">
						<ul class="rslides" id="slider5">
						<?php 
							$sql="select * from testimoni where tampil=true order by tanggal desc";
							$result=$db->query($sql);
							while($row=$result->fetch_object()){
									
						?>
							<li>
								<div class="testi-slider">
									<h4><?php echo $row->testimoni;?></h4>
									<div class="testi-subscript">
										<p><?php echo $row->nama;?></p>
										<span class="sbscrpt"> </span>
									</div>	
								</div>
							</li><?php } ?>
						</ul>
					</div>
					<div class="contact-form">
					<h4>Form TESTIMONIALS</h4>
					<form name="postform" action="" method="post" enctype='multipart/form-data'>
						<input type="text" name="nama" id="nama" placeholder="Nama...." pattern="[A-Za-z]{1,20}" required/>
						<textarea name="testimoni" id="testimoni" placeholder="Testimoni..." pattern="{1,255}" required></textarea>
						<div class="clearfix"></div>
						<div class="g-recaptcha" data-sitekey="6LfaVgkUAAAAAH45Zzv2RVdfPVBFSJIet2aI6KlS"></div>
						<p style="color:red;"><?php echo $pesan;?></p>
						<input type="submit" value="Submit"></input>
					</form>				
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>	
	</div>
	<!--//content-->