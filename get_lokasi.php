<?php
	$id= $_GET['id'];
	if ($id=='semua'){
		$sql="select lokasi,lat,lng from cabang";
	}else
	{$sql="select lokasi,lat,lng from cabang where idcabang=$id";}
	require_once('config/db_login.php');
	
	$result=$db->query($sql);
	if(!$result){
		die("Could not query the database: </br>".$db->error);
	}
	$n=0;
	while($row=$result->fetch_object()){
	$lat[$n]=$row->lat;
	$lng[$n]=$row->lng;
	$lok[$n]=$row->lokasi;
	$n++;
	}
?>
<style>
#gmap{
width:100%;
height:380px;}
</style>
    <script>
      var map;
	  var lati = <?php echo json_encode($lat); ?>;
	  var longi = <?php echo json_encode($lng); ?>;
	  var contentString = <?php echo json_encode($lok); ?>;
      function initMap() {
        map = new google.maps.Map(document.getElementById('gmap'), {
          center: {lat: -7.614529, lng: 110.712246},
          zoom: 15
        });
		var infowindow = new google.maps.InfoWindow;
		for (i in lati){
			if(i > 0){
				map.setZoom(8);
			}
		var myCenter=new google.maps.LatLng(lati[i],longi[i]);
		if(i==0){
			map.setCenter(myCenter);
		}
		var marker=new google.maps.Marker({
		position:myCenter,
		map:map,
		title:contentString[i]
		});
    google.maps.event.addListener(marker, 'click', (function(marker, i) {
         return function() {
             infowindow.setContent(contentString[i]);
             infowindow.open(map, marker);
         }
    })(marker, i));		
		}
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1GeRCfYKRDJOL2DbKLxXIAzywmHzvzRU &callback=initMap"
    async defer></script>
<div id="gmap">
</div>