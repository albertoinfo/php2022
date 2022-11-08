<?php
/**
 *   Versión de actualización de un fichero controlando el acceso
 *   concurrente mediante el bloqueo de fichero flock
 * 
 */


?>
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
$fp = fopen(FICHERO,"r+");

// INTENTO EL BLOQUEO EXCLUSIVO, SI NO PUEDO ESPERO
if ( flock($fp,LOCK_EX)){
    $numero = fgets($fp);
    $numero = $numero +1;
   // usleep(5000000); Test prueba espera 5 sg 
    rewind($fp); // Me situo al principio del fichero
    fputs($fp,$numero);
    flock($fp,LOCK_UN);  // LIBERO EL BLOQUEA
}
fclose($fp);  // Normalmente al cerrar el fichero también se libera el recurso


echo "<br> Número de accesos desde este navegador = ",$numerocookie;
echo "<br> Número de accesos Totales = $numero ";
?>
</body>
</html>

