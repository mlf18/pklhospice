<!--contact-->
	<div class="single-page">
		<div class="container">
			<div class="work-title">
				<h3>CONTACT<span>US</span></h3>
			</div>
			<div class="col-md-8 single-page-left" >
					<br/>
					<?php
					include('config/db_login.php');
					$id=$_GET['idt'];
					$sql="select * from thread where idthread='$id'";
					$result=$db->query($sql);
					if(!$result){
						die("Could not query the database: </br>".$db->error);
					}
					while($row=$result->fetch_object()){
						$sql1="select * from `post` where `post`.`idthread`=$row->idthread order by tgl_post asc";
						$result1=$db->query($sql1);	
						if(!$result1){
							die("Could not query the database: </br>".$db->error);
						}
						while($row1=$result1->fetch_object()){
							if($row1->user=='admin'){
									$user='Admin';
									$j='RESPONSES';
							}else{	
								$user=$row1->user;
								$j='PERTANYAAN';
							}
						echo'
							<div class="response">
								<h4>'.$j.'</h4>
							<div class="response-info">
							<div class="response-text-left">
							<a href="#"><img src="images/icon11.png" alt=""/></a>
							<h5><a href="#">'.$user.'</a></h5>
							</div>
						<div class="response-text-right">
							<p>'.$row1->isipost.'</p>
							<ul>
								<li>'.$row1->tgl_post.'</li>
								<li><a href="#">Reply</a></li>
							</ul>
						</div>
						<div class="clearfix"> </div></div></div>';
						$j='';
						}
					}
					?>
		</div>
		</div>
	</div>
	<!--//contact-->