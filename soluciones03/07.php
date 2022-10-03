<html>
<head>
<meta charset="UTF-8">
<title>Pais al azar</title>
</head>
<body><?php
include_once 'infopaises.php';

// Me devuelve un array con dos claves aleatorias de la tabla de paises
$paiselegidos = array_rand($paises,2);

foreach ($paiselegidos as $pais){
    echo "País : ".$pais." , con ".number_format($paises[$pais]['Poblacion'], 0, ',', '.'). " habitantes <br/>";
    echo "Lista de Ciudades: ";
    foreach($ciudades[$pais] as $ciudad){
        echo $ciudad." ";
    } 
?>
    <br/>Enlace a google maps:
	<a href="https://www.google.es/maps/place/<?= $pais?>">Maps</a><br>
<?php
}
?>	 

<hr>
<?php show_source(__FILE__); ?>
<hr>
</body>
</html>

