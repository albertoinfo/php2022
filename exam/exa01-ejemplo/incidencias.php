<?php
// Función auxiliar 
function limpiarEntrada(string $entrada): string
{
    $salida = trim($entrada); // Elimina espacios antes y después de los datos
    $salida = stripslashes($salida); // Elimina backslashes \
    $salida = htmlspecialchars($salida); // Traduce caracteres especiales en entidades HTML
    return $salida;
}

// Evitar parcialmente la entrada masiva de indidencias
$numincidencias = 0;
if (isset($_COOKIE['numincidencias'])){
    $numincidencias = $_COOKIE['numincidencias'];
    if ($numincidencias >= 3){
        Echo "Superado el número máximo de incidencias <br>";
        Echo "Espere 2 minutos para introducir otra o reinicie su navegador.";
        exit();
    }
}
$numincidencias++;
setcookie('numincidencias',$numincidencias,time()+2*60);


// Procesar la incidencias
$nombre    = limpiarEntrada($_POST['nombre']);
$prioridad = limpiarEntrada($_POST['prioridad']);
$resumen   = limpiarEntrada($_POST['resumen']);

$fecha = date("d:m:Y G:i");
$ip = $_SERVER['REMOTE_ADDR'];

$linea = $fecha . "," . $nombre . "," . $resumen . "," . $prioridad . "," . $ip . "\n";

$resu = @file_put_contents("incidencias.txt",$linea, FILE_APPEND);
if ($resu === false) {
    echo "Error no se ha podido anotar su incidencia <br>";
} else {
    echo "Muchas gracias $nombre, se ha anotado su incidencia. <br>";
}
