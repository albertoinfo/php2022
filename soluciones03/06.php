<?php
// PRIMERA VERSIÓN CALCULO EL MÁXIMO MANUALMENTE
?>
<html>
<head>
<meta charset="UTF-8">
<title>Paises y ciudades</title>
</head>
<body>
<?php
// Incluyo la table de 
include_once 'infopaises.php';

// Obtengo el pais con mas población
$max = 0;
$pais_max = "";
foreach($paises as $pais => $info){
    if($info['Poblacion']> $max){
        $pais_max = $pais;
        $max = $info['Poblacion'];
    }
}
echo "País con más población: ".$pais_max." , con ".number_format($max, 0, ',', '.'). " habitantes<br/>";
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