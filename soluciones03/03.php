<!DOCTYPE html>
<html>
<head>
	<title>Medio al azar</title>
	<meta charset="utf-8">
</head>
<body>
	<?php
	$medios =  [ "El Pais" => "https://www.elpais.com",
	    "El Mundo" => "https://www.elmundo.es",
	    "Marca" => "https://www.marca.com",
	    "Antena3" => "https://www.antena3.com",
	    "La Razón" => "https://www.larazon.es"
	    
	];
	// Obtengo una clave de forma aleatoria
	$clavemedio = array_rand($medios);
	echo "<p>El Medio recomendado es: <a href=\"". $medios[$clavemedio]. "\">$clavemedio</a></p>";
	?>
<hr>
<?php show_source(__FILE__); ?>
<hr>
</body>
</html>