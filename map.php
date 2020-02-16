<head>
		<!-- utf-8 -->
        <meta charset="utf-8">
        <!-- stop zoom -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Gruppenmitglieder-->
        <meta name="author" content="Gruppe1, Patrice Weber, Christian Bieri, Stephan Renggli, Timothy Jung">
		<!-- Seitentitel -->
		<title>ImmoMobile - Make it yours!</title>
        <!-- favicon -->
        <link rel="apple-touch-icon" sizes="57x57" href="img/favicon/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="img/favicon/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="img/favicon/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="img/favicon/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="img/favicon/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="img/favicon/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="img/favicon/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="img/favicon/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="img/favicon/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="img/favicon/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="img/favicon/favicon-16x16.png">
        <link rel="manifest" href="img/favicon/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="img/favicon/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
		
        <!-- CSS -->
        <link rel="stylesheet" href="css/map.css">
		<link rel="stylesheet" type="text/css" href="slick/slick.css"/>
</head>
<body>

<?php

	$latitude = $_GET['latitude'];
	$longitude = $_GET['longitude'];

	
	echo "<div id='map' style='height: 100%;'></div>";
	echo "
			<script>
				function createMap() {
					var immoPos = new google.maps.LatLng(" . $latitude . "," .  $longitude . ");
					var myPos; 
					var mapCanvas = document.getElementById('map');
					var mapOptions = {
						center: immoPos,
						zoom: 15
					};
                    

        var iconBase = 'https://maps.google.com/mapfiles/kml/shapes/';


                    
    
					var map = new google.maps.Map(mapCanvas, mapOptions);
					
					navigator.geolocation.getCurrentPosition(function(position) {
						myPos = {
							lat: position.coords.latitude,
							lng: position.coords.longitude
						};
                        
                        var markerCurrent = new google.maps.Marker({
						position: myPos,
						map: map,
						title: 'Ihr Standort!',
                        icon: 'http://maps.google.com/mapfiles/kml/shapes/man.png'

    
						});
                        
                        var markerImmo = new google.maps.Marker({
						position: immoPos,
						map: map,
                        icon: 'http://maps.google.com/mapfiles/kml/shapes/ranger_station.png',
						title: 'Ihre Traumimmobilie!'
					});
                    
                    var bounds = new google.maps.LatLngBounds();
                    bounds.extend(markerCurrent.getPosition());
                    bounds.extend(markerImmo.getPosition());
                    map.fitBounds(bounds);
                    
                    var directionsService = new google.maps.DirectionsService();
                    
                    var directionsRenderer = new google.maps.DirectionsRenderer({
                        suppressMarkers: true
                    });

     
                    directionsRenderer.setMap(map);
                    

                    var request = {
                      origin: myPos,
                      destination: immoPos,
                      travelMode: google.maps.DirectionsTravelMode.DRIVING
                      };


                    directionsService.route(request, function (result, status) {
                      if (status == google.maps.DirectionsStatus.OK) {
                          directionsRenderer.setDirections(result);

                      } else {
                          error(status);
                      }
                  });                   
                    
					});
				};
			</script>";
			echo "<script async defer src='https://maps.googleapis.com/maps/api/js?key=AIzaSyAZDsGJnpCjTrNtKQm4ztj1FAW08Itwgao&callback=createMap'></script>";

?>

</body>