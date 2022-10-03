<?php
/* Versión con utilización de a funcion uasort (Ordenación mediante una función de usuario) */
?>
<html>
<head>
<meta charset="UTF-8">
<title>Paises y ciudades</title>
</head>
<body>
<?php
// Incluyo la table de paises
include_once 'infopaises.php';

function ordenaPaisPorPoblacion($pais1, $pais2){
    
    return ( $pais1['Poblacion'] - $pais2['Poblacion']);
    
}

// Ordeno utilizando la funcion definida
uasort($paises,'ordenaPaisPorPoblacion');

// Obtengo la clave del último elemento del array (OJO PHP 7.4)
$pais_max = array_key_last ( $paises );


echo "País con más población: ".$pais_max." , con ".number_format($paises[$pais_max]['Poblacion'], 0, ',', '.'). " habitantes<br/>";
// Obtengo sus ciudades

echo "<table border=1><tr><td> Ciudades: </td>";
$listaciudades = $ciudades[$pais_max];
foreach($listaciudades as $ciudad){
    echo "<td> $ciudad </td>";
}
echo "</tr></table>";
?>

<hr>
<?php show_source(__FILE__); ?>
<hr>
</body>
</html>
