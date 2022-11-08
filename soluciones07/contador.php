<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
</head>
<body>
<H1>CONTADOR</H1>

<?php


define ('FICHERO','contador.txt');

// MANEJO EL CONTADOR ALMACENADO EN UN COOKIE
$numerocookie = 0;
if (isset($_COOKIE['contador'])){
    $numerocookie = $_COOKIE['contador'];
} 
$numerocookie++;
setcookie("contador",$numerocookie,time()+3600*24*30*3);

//MANEJO EL CONTADOR ALMACENADO EN EL FICHERO
$numero = 0;
if (file_exists(FICHERO)) {
    $numero = @file_get_contents(FICHERO); 
    if ( $numero === false ){
        die("Error al abrir el fichero");
    }
    settype($numero, "integer"); // Para que funcione el numero++
}

$numero ++;

file_put_contents(FICHERO, $numero);

echo "<br> Número de accesos desde este navegador = ",$numerocookie;
echo "<br> Número de accesos Totales = $numero ";
?>
</body>
</html>

