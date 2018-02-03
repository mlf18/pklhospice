	<!--portfolio-->
	<div class="container">
	<div class="portfolios">
			<div class="work-title">
				<h3>OUR<span>PORTFOLIO</span></h3>
			</div>
			<script src="js/easyResponsiveTabs.js" type="text/javascript"></script>
		    <script type="text/javascript">
			    $(document).ready(function () {
			        $('#horizontalTab').easyResponsiveTabs({
			            type: 'default', //Types: default, vertical, accordion           
			            width: 'auto', //auto or any width like 600px
			            fit: true   // 100% fit in a container
			        });
			    });
				
			</script>
				<link rel="stylesheet" href="css/swipebox.css">
					<script src="js/jquery.swipebox.min.js"></script> 
						<script type="text/javascript">
							jQuery(function($) {
								$(".swipebox").swipebox();
							});
						</script>
					<!-- Portfolio Ends Here -->
				<div class="sap_tabs">
					<div id="horizontalTab" style="display: block; width: 100%; margin: 0px;">
						  <ul class="resp-tabs-list">
						  	  <li class="resp-tab-item" aria-controls="tab_item-0" role="tab"><span>All</span></li>
							  <?php
							  $sql='select idcabang,lokasi from cabang';
							  $result=$db->query($sql);
								if(!$result){
									die("Could not query the database: </br>".$db->error);
								}
								while($row=$result->fetch_object()){
							  ?>
							  <li class="resp-tab-item" aria-controls="<?php echo $row->idcabang;?>" role="tab"><span><?php echo $row->lokasi;?></span></li>
								<?php }?>
								<li class="resp-tab-item" aria-controls="other" role="tab"><span>Other</span></li>
							  <div class="clearfix"></div>
						  </ul>				  	 
						<div class="resp-tabs-container">
						    <div class="tab-1 resp-tab-content" aria-labelledby="tab_item-0">
								<div class="tab_img">						
						<?php
								$sql_gambar="select * from gambar order by tanggal desc limit 9";
								$result1=$db->query($sql_gambar);
								if(!$result1){
									die("Could not query the database: </br>".$db->error);
								}
								while($row1=$result1->fetch_object()){
									if($result1->num_rows <= 3){
										$tanggal="";
									}else{
										$tanggal=$row1->tanggal;
									}
									
							  ?>
										<div id="" class="col-md-4 img-top tab_all">
					   		  			   <a href="images/<?php echo $row1->gambar;?>" rel="title" class="b-link-stripe b-animate-go swipebox">
					   		  			   	<img src="images/small_<?php echo $row1->gambar;?>" class="img-responsive" alt=""/>
												 <div class="link-top">
												 <i class="link"> </i>
												 </div>
					   		  			   </a>
										</div>
								<?php } ?>
								<div id="tab_all"></div>
								<div class="clearfix"></div>
								<div class="text-center">
								<img class="loader" src="images/pageloader.gif" width="5%"/><br/>
								<input type="hidden" class="tanggal_all" value="<?php echo $tanggal;?>"></input>
								<button class="sw-more btn btn-default btn-gambar" id="gambar_semua" data-idcabang="semua">Show More</button>
								</div>
								</div>
							    </div>
						<?php
							  $sql='select idcabang from cabang';
							  $result=$db->query($sql);
								if(!$result){
									die("Could not query the database: </br>".$db->error);
								}
								while($row=$result->fetch_object()){
									$idc=$row->idcabang;
						    echo '<div class="tab-1 resp-tab-content" aria-labelledby="'.$row->idcabang.'">
								<div class="tab_img">';
								$sql_gambar="select * from gambar where idcabang=$row->idcabang  order by tanggal desc limit 9";
								$result1=$db->query($sql_gambar);
								if(!$result1){
									die("Could not query the database: </br>".$db->error);
								}
								echo '<div id="tab_'.$idc.'">';
								while($row1=$result1->fetch_object()){
									if($result1->num_rows <= 3){
										$tanggal="";
									}else{
										$tanggal=$row1->tanggal;
									}
							  ?>
										<div class="col-md-4 img-top ">
					   		  			   <a href="images/<?php echo $row1->gambar;?>" rel="title" class="b-link-stripe b-animate-go  swipebox">
					   		  			   	<img src="images/small_<?php echo $row1->gambar;?>" class="img-responsive" alt=""/>
												 <div class="link-top">
												 <i class="link"> </i>
												 </div>
					   		  			   </a>
										</div>
								<?php }?>
								</div>
								<div class="clearfix"></div>
								<div class="text-center">
								<img class="loader" src="images/pageloader.gif" width="5%"/><br/>
								<input type="hidden" id="<?php echo $idc;?>" class="tanggal_idc" value="<?php echo $tanggal;?>"></input>
								<button class="sw-more btn btn-default btn-gambar" id="gambar_idc" data-idcabang="<?php echo $idc;?>">Show More</button>
								</div>
								</div>
							    </div><?php } ?>
								<div class="tab-1 resp-tab-content" aria-labelledby="other">
								<div class="tab_img">
								<div id="tab_other">
						<?php
								$sql_gambar="select * from gambar where idcabang is NULL  order by tanggal desc limit 9";
								$result1=$db->query($sql_gambar);
								if(!$result1){
									die("Could not query the database: </br>".$db->error);
								}
								while($row1=$result1->fetch_object()){
									if($result->num_rows <= 3){
										$tanggal="";
									}else{
										$tanggal=$row1->tanggal;
									}
							  ?>

										<div class="col-md-4 img-top ">
					   		  			   <a href="images/<?php echo $row1->gambar;?>" rel="title" class="b-link-stripe b-animate-go  swipebox">
					   		  			   	<img src="images/small_<?php echo $row1->gambar;?>" class="img-responsive" alt=""/>
												 <div class="link-top">
												 <i class="link"> </i>
												 </div>
					   		  			   </a>
										</div>
								<?php }?>
								</div>
								<div class="clearfix"></div>
								<div class="text-center">
								<img class="loader" src="images/pageloader.gif" width="5%"/><br/>
								<input type="hidden" class="tanggal_other" value="<?php echo $tanggal;?>"></input>
								<button class="sw-more btn btn-default btn-gambar" id="gambar_other" data-tanggal="<?php echo $tanggal;?>" data-idcabang="other">Show More</button>
								</div>
								</div>
							    </div>
						</div>	
					</div>
				</div>
	</div>
</div>
