
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
        <link rel="stylesheet" href="css/detailansicht.css">
		<link rel="stylesheet" type="text/css" href="slick/slick.css"/>
</head>
<body>

<!-- Beginn dynamische Seite -->
<?php

/*immobilien.json wird in Array umgewandelt - "Datenbankersatz"*/
$immobilieString = file_get_contents('./model/immobilien.json');
$immobilienArray = json_decode($immobilieString, true);

	$gemeinde = $_GET['selectGemeinde'];
	$objektart = $_GET['selectTyp'];
	$anzahlZimmer = $_GET['selectZimmer'];
	$wohnflaeche = $_GET['sliderFlaeche'];
	$preis = $_GET['sliderPreis'];

	/*Immobilien nach verschiedenen Kriterien filtern*/
	foreach($immobilienArray as $key=>$value){
		if(array_key_exists($key, $immobilienArray)) {
			if($gemeinde != 'all') {
				if($immobilienArray[$key]['adresse']['gemeinde'] != $gemeinde) {
					unset($immobilienArray[$key]);
				}
			}
		}
	}

	foreach($immobilienArray as $key=>$value){
		if(array_key_exists($key, $immobilienArray)) {
			if($objektart != 'all') {
				if($immobilienArray[$key]['objektart'] != $objektart) {
					unset($immobilienArray[$key]);
				}
			}
		}
	}

	foreach($immobilienArray as $key=>$value){
		if(array_key_exists($key, $immobilienArray)) {
			if((double)$immobilienArray[$key]['anzahlZimmer'] < $anzahlZimmer) {
				unset($immobilienArray[$key]);
			}
		}
	}

	foreach($immobilienArray as $key=>$value){
		if(array_key_exists($key, $immobilienArray)) {
			if((int)$immobilienArray[$key]['wohnflaeche'] < $wohnflaeche) {
				unset($immobilienArray[$key]);
			}
		}
	}

	foreach($immobilienArray as $key=>$value){
		if(array_key_exists($key, $immobilienArray)) {
			if((int)$immobilienArray[$key]['preis'] > $preis*100000) {
				unset($immobilienArray[$key]);
			}
		}
	}
	
	/*Spezielle Meldung, falls der Filter keine Ergebnisse liefert*/
	if(count($immobilienArray) == 0) {
		echo "<div class='immodetail-container'><p>Keine Immobilien die Ihren Suchkriterien entsprechen verfügbar.</p></div>";
	}
	
	/*Gefilterte Immobilien anzeigen*/
	foreach($immobilienArray as $key_imm=>$value){
		if(array_key_exists($key_imm, $immobilienArray)) {
			echo "
			<div class='card-container'>
				<div class='immo-container'>";
			
			/*Bilder anzeigen*/
            echo "
			<div class='slider-container'>
                <div class='slider'>";
					foreach($immobilienArray[$key_imm]['bilder'] as $key_img=>$value){
						echo "<div class='slide'><img src='" . $immobilienArray[$key_imm]['bilder'][$key_img] . "'></div>";
					}
				echo "</div>
			</div>";
			
			echo "
			<div class='immotitle-container'><h2>" . $immobilienArray[$key_imm]['titel'] . "</h2></div>
				<div class='immodescription-container'><p>" . $immobilienArray[$key_imm]['beschreibung'] . "</p></div>
					<div class='immodetail-container'>
						<h4>Immobiliendetails:</h4>
							<p>" . "Objektart: " . $immobilienArray[$key_imm]['objektart'] . "</p>
							<p>" . "Strasse: " . $immobilienArray[$key_imm]['adresse']['strasse'] . "</p>
							<p>" . "Hausnummer: " . $immobilienArray[$key_imm]['adresse']['hausnummer'] . "</p>
							<p>" . "Gemeinde: " . $immobilienArray[$key_imm]['adresse']['gemeinde'] . "</p>
							<p>" . "PLZ: " . $immobilienArray[$key_imm]['adresse']['plz'] . "</p>
							<p>" . "Preis: " . $immobilienArray[$key_imm]['preis'] . "</p>
							<p>" . "Zimmer: " . $immobilienArray[$key_imm]['anzahlZimmer'] ."</p>
							<p>" . "Wohnfläche: " . $immobilienArray[$key_imm]['wohnflaeche'] . "</p>
							<p>" . "Grundstücksfläche: " . $immobilienArray[$key_imm]['grundstuecksflaeche'] . "</p>
							<p>" . "Verfügbarkeit: " . $immobilienArray[$key_imm]['verfuegbarkeit'] . "</p>
							<p>" . "Baujahr: " . $immobilienArray[$key_imm]['baujahr'] . "</p>
					</div>";
			
			echo "
			<div class='immoequip-container'>
				<h4>Ausstattung:</h4>";
					if($immobilienArray[$key_imm]['ausstattung']['lift'] == 'true') {
						echo "<p>" . "Lift: Ja" . "</p>";
					} else {
						echo "<p>" . "Lift: Nein" . "</p>";
					}
			
					if($immobilienArray[$key_imm]['ausstattung']['balkon'] == 'true') {
						echo "<p>" . "Balkon: Ja" . "</p>";
					} else {
						echo "<p>" . "Balkon: Nein" . "</p>";
					}
			
					if($immobilienArray[$key_imm]['ausstattung']['garten'] == 'true') {
						echo "<p>" . "Garten: Ja" . "</p>";
					} else {
						echo "<p>" . "Garten: Nein" . "</p>";
					}
			echo "</div>";
			
			/* Kontakt anzeigen */
			echo "
			<div class='immocontact-container'>
				<h4>Kontakt:</h4>
					<button class='btn' type='button'><span><p><a href='mailto:sales@immomobile.ch?Subject=" . $immobilienArray[$key_imm]['titel'] . "&body=Liebes ImmoMobile Team%0d%0a%0d%0aIch interessiere mich für das Objekt " . $immobilienArray[$key_imm]['titel'] . ".%0d%0aIch würde mich sehr freuen, wenn Sie mit mir Kontakt aufnehmen würden.%0d%0a%0d%0aFreundliche Grüsse'>Kontaktaufnahme per E-Mail</a></p></span></button>
					<button class='btn' type='button'><span><p><a href='tel:+41410000000'>Kontaktaufnahme per Telefon</a></p></span></button>
			</div>";
			
			/* Karte anzeigen */
			echo "
			<div class='immomap-container'>
                <h4>Karte:</h4>
						<button class='btn' type='button'><span><a target='blank' href='map.php?latitude=" . $immobilienArray[$key_imm]['position']['latitude'] . "&longitude=" .  $immobilienArray[$key_imm]['position']['longitude'] . "'><p>Karte anzeigen</p></a></span></button>
			</div>";
			
			/* Erstellen der Google Map */
			/*echo "
			<script>
				function createMap() {
					var immoPos = new google.maps.LatLng(" . $immobilienArray[$key_imm]['position']['latitude'] . "," .  $immobilienArray[$key_imm]['position']['longitude'] . ");
					var mapCanvas = document.getElementById('immobilieStandort" . $key_imm . "');
					var mapOptions = {
						center: immoPos,
						zoom: 15
					};
					var map = new google.maps.Map(mapCanvas, mapOptions);
				
					var marker = new google.maps.Marker({
						position: immoPos,
						map: map,
						title: 'Ihre Traumimmobilie!'
					});
				};
			</script>";
			echo "<script async defer src='https://maps.googleapis.com/maps/api/js?key=AIzaSyAZDsGJnpCjTrNtKQm4ztj1FAW08Itwgao&callback=createMap'></script>";
            */

			echo "</div>";
            
            
			
			
			
			/*Gemeindeinformationen filtern*/
			$gemeindenString = file_get_contents('./model/gemeinden.json');
			$gemeindenArray = json_decode($gemeindenString, true);
			
			foreach($gemeindenArray as $key_gem=>$value){
				if(array_key_exists($key_gem, $gemeindenArray)) {
					if($immobilienArray[$key_imm]['adresse']['plz'] != $gemeindenArray[$key_gem]['plz']) {
						unset($gemeindenArray[$key_gem]);
					}
				}
			}
           
            foreach($gemeindenArray as $key_gem=>$value){
                if(array_key_exists($key_gem, $gemeindenArray)){
                   
                /* Gemeindeinformationen anzeigen */
				echo "
				<div class='gemeinde-container'>
					<div class='gemeindetitle-container'><h4>" . $gemeindenArray[$key_gem]['name'] . "</h4></div>
						<div class='gemeindedescription-container'><p>" . $gemeindenArray[$key_gem]['beschreibung'] . "</p></div>
							<div class='gemeindedetail-container'>
								<ul>
									<p>" . "PLZ: " . $gemeindenArray[$key_gem]['plz'] . "</p>
									<p>" . "Kanton: " . $gemeindenArray[$key_gem]['kanton'] . "</p>
									<p>" . "Einwohner: " . $gemeindenArray[$key_gem]['anzahlEinwohner'] . "</p>
									<p>" . "Website: <a href=http://" . $gemeindenArray[$key_gem]['url'] . ">" . $gemeindenArray[$key_gem]['url']. "</a></p>
									<p>" . "Steuerfuss: " . $gemeindenArray[$key_gem]['steuerfuss'] . "</p>
								</ul>
				";
                    
                /* Infrastruktur anzeigen  */                    
                echo "
				<h4>Infrastruktur:</h4>
					<ul>";
						if($gemeindenArray[$key_gem]['infrastruktur']['einkaufsmoeglichkeiten'] == 'true') {
							echo "<p>" . "Einkaufsmöglichkeiten: Ja" . "</p>";
						} else {
							echo "<p>" . "Einkaufsmöglichkeiten: Nein" . "</p>";
						}
					
						if($gemeindenArray[$key_gem]['infrastruktur']['spital'] == 'true') {
							echo "<p>" . "Spital: Ja" . "</p>";
						} else {
							echo "<p>" . "Spital: Nein" . "</p>";
						}
					echo "</ul>";
                
                    
                    
                /* Bildung anzeigen */
                echo "
				<h5>Bildung:</h5>
					<ul>";
						if($gemeindenArray[$key_gem]['infrastruktur']['kindergarten'] == 'true') {
							echo "<p>" . "Kindergarten: Ja" . "</p>";
						} else {
							echo "<p>" . "Kindergarten: Nein" . "</p>";
						}
					
						if($gemeindenArray[$key_gem]['infrastruktur']['primarschule'] == 'true') {
							echo "<p>" . "Primarschule: Ja" . "</p>";
						} else {
							echo "<p>" . "Primarschlue: Nein" . "</p>";
						}
					
						if($gemeindenArray[$key_gem]['infrastruktur']['sekundarschule'] == 'true') {
							echo "<p>" . "Sekundarschlue: Ja" . "</p>";
						} else {
							echo "<p>" . "Sekundarschlue: Nein" . "</p>";
						}
					
						if($gemeindenArray[$key_gem]['infrastruktur']['kantonsschule'] == 'true') {
							echo "<p>" . "Kantonsschule: Ja" . "</p>";
						} else {
							echo "<p>" . "Kantonsschule: Nein" . "</p>";
						}
					
						if($gemeindenArray[$key_gem]['infrastruktur']['hochschule'] == 'true') {
							echo "<p>" . "Hochschule: Ja" . "</p>";
						} else {
							echo "<p>" . "Hochschule: Nein" . "</p>";
						}
					
						if($gemeindenArray[$key_gem]['infrastruktur']['universitaet'] == 'true') {
							echo "<p>" . "Universität: Ja" . "</p>";
						} else {
							echo "<p>" . "Universität: Nein" . "</p>";
						}
					echo "</ul>
				</div>";
                    
                /*Bilder anzeigen*/
				echo "
				<div class='gemeindeimg-container'>
					<h3>Bilder: </h3>
						<div class='slider-container'>
							<div class='slider'>";
								foreach($immobilienArray[$key_imm]['bilder'] as $key_img=>$value){
									echo "<div class='slide'><img src='" . $gemeindenArray[$key_gem]['bilder'][$key_img] . "'></div>";
								}
							echo "</div>
						</div>
				</div>";
                }
			echo "</div>";
            }
		}
		echo "</div>";
	}
	
?>
		<!-- Div. Scripts -->
		<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
		<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
		<script type="text/javascript" src="slick/slick.min.js"></script>
		
		<!-- Slider JS -->
		<script type="text/javascript">
			$(document).ready(function(){
				$('.slider').slick({
					fade: true,
					autoplay: true,
					autoplaySpeed: 5000,
					speed: 1000,
					arrows: false,
					draggable: true,
					infinite: true
				});
			});
		</script>
		
		<!-- Google Maps API Callback Function -->
		<script async defer src='https://maps.googleapis.com/maps/api/js?key=AIzaSyAZDsGJnpCjTrNtKQm4ztj1FAW08Itwgao&callback=createMap'></script>
		
		

</body>