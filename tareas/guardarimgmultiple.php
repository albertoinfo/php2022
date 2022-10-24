<?php
// DETALLES DE CONFIGURACIÓN Y CONSTANTES
define('DIR_DESTINO', '/home/alberto/kk');
define('TAMAÑOMAXTOTAL',   300000);
define('TAMAÑOMAXFICHERO', 200000);

define('ERROR_NO_JPG_PNG',      5000);
define('ERROR_MAX_TAMAÑOIMG',   5001);
define('ERROR_MAX_TAMAÑOTOTAL', 5002);
define('ERROR_YA_EXISTE',       5003);
define('ERROR_MOVER',           5004);
define('SIN_ERRORES',           5005);

// Tabla de posibles errores y mensajes asociados
$codigosErrorSubida = [
    UPLOAD_ERR_OK         => 'Subida correcta',
    UPLOAD_ERR_INI_SIZE   => 'El tamaño del archivo excede el admitido por el servidor',  // directiva upload_max_filesize en php.ini
    UPLOAD_ERR_FORM_SIZE  => 'El tamaño del archivo excede el admitido por el cliente',  // directiva MAX_FILE_SIZE en el formulario HTML
    UPLOAD_ERR_PARTIAL    => 'El archivo no se pudo subir completamente',
    UPLOAD_ERR_NO_FILE    => 'No se seleccionó ningún archivo para ser subido',
    UPLOAD_ERR_NO_TMP_DIR => 'No existe un directorio temporal donde subir el archivo',
    UPLOAD_ERR_CANT_WRITE => 'No se pudo guardar el archivo en disco',  // permisos
    UPLOAD_ERR_EXTENSION  => 'Una extensión PHP evito la subida del archivo',  // extensión PHP
    // Mis errores adicionales
    ERROR_NO_JPG_PNG         => 'Formato de Imagen no admitido',
    ERROR_MAX_TAMAÑOIMG      => 'El archivo supera el tamaño máximo permitido',
    ERROR_MAX_TAMAÑOTOTAL    => 'El total de los archivos supera el máximo permitido ' . (TAMAÑOMAXTOTAL / 1000) . ' KB',
    ERROR_YA_EXISTE          => 'Existe un fichero con el mismo nombre',
    ERROR_MOVER              => 'No se puede mover el archivo descargado',
    SIN_ERRORES              => 'El fichero se ha guardado correctamente'

];


?>
<?php

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    include_once 'selectmultiple.html';
    exit();
}
//var_dump($_FILES);
// Proceso el formulario método POST

$contadorFicherosRecibidos = ContarFicherosRecibidos();
if ($contadorFicherosRecibidos == 0) {
    avisojs(" Error: No se ha indicado ningún fichero.");
    include_once 'selectmultiple.html';
    exit();
}

// Cargo la información de los ficheros recibidos correcto en una tabla auxiliar
$tablaficheros = [];
for ($i = 0; $i < $contadorFicherosRecibidos; $i++) {
    $resu = testImagenOK($i);
    // No hay error de descarga
    if ($resu ==  UPLOAD_ERR_OK) {
        // Guardo el nombre del fichero => el tamaño y el nombre del fichero temporal
        $tablaficheros[$_FILES['archivos']['name'][$i]] =  [
            $_FILES['archivos']['size'][$i],
            $_FILES['archivos']['tmp_name'][$i]
        ];
    } else {
        $msg = "<span style='font-size:50px;color:red;  '>&#9785</span>";
        $msg .= " Error al subir el archivo <b>" . $_FILES['archivos']['name'][$i] . "</b><br>";
        $msg .= $codigosErrorSubida[$resu] . "<br>";
        echo $msg;
    }
}

// Calculo el total de los ficheros aceptados
$tamañototal = calcularTamañoTotal($tablaficheros);
if ($tamañototal > TAMAÑOMAXTOTAL) {
    echo $codigosErrorSubida[ERROR_MAX_TAMAÑOTOTAL] . "<br>";
    exit(); // Fin del programa
}

// Intento mover los ficheros al directorio destino
foreach ($tablaficheros as $nombre => $valor) {

    $codigo = moverImagenADestino($nombre, $valor[1]);
    // Fichero a crear y fichero temporal [1]
    if ($codigo == SIN_ERRORES) {
        echo "<span style='font-size:50px;color:green;'>&#9786</span><b>" . " $nombre :" . $codigosErrorSubida[$codigo] . "</b><br />";
    } else {
        echo "<span style='font-size:50px;color:red;  '>&#9785</span> <b>" . " $nombre :" . $codigosErrorSubida[$codigo] . "</b><br />";
    }
}



// --------------------------
//   FUNCIONES AUXILIARES
//  -------------------------

/**
 * 
 * @param int numimg
 * @return int 
 * Devuelve el UPLOAD_ERR_OK sin no ha habido errores o un codigo de error 
 * asociado a la tabla de mensajes  ERROR_NO_JPG_PNG o ERROR_MAX_TAMAÑOIMG
 *  
 */
function testImagenOK($numimg): int
{
    // obtengo el código de error que me da PHP
    $error =  $_FILES['archivos']['error'][$numimg];

    // Si no ha habido error ckequeo el resto de condiciones
    if ($error == UPLOAD_ERR_OK) {
        $tipo =  $_FILES['archivos']['type'][$numimg];
        if ($tipo != "image/jpeg" && $tipo != "image/png") {
            $error = ERROR_NO_JPG_PNG;
        } else  if ($_FILES['archivos']['size'][$numimg] > TAMAÑOMAXFICHERO) {
            $error = ERROR_MAX_TAMAÑOIMG;
        }
    }
    return $error;
}
/**
 * Mueve el fichero temporal al destino y comprueba que el fichero no existe
 * @param string $nombrefichero
 * @param string $ficherotemporal
 * @return int código de Error o éxisto de la operación
 */
function moverImagenADestino(string $nombrefichero, string $ficherotemporal): int
{
    // No se puede mover si el fichero existe
    if (file_exists(DIR_DESTINO . '/' . $nombrefichero)) {
        return ERROR_YA_EXISTE;
    } else {
        if (move_uploaded_file($ficherotemporal, DIR_DESTINO . '/' . $nombrefichero)) {
            return SIN_ERRORES;
        } else {
            return ERROR_MOVER;
        }
    }
}

/**
 * 
 * @param string $msg - Mensaje a mostrar 
 */

function avisojs(string $msg): void
{
    echo "<script> alert (\"" . $msg . "\") </script>";
}

/**
 * 
 * @param array $tablaficheros
 * @return int - Suma del tamaño de todos los ficheros descargados
 */
function calcularTamañoTotal(array $tablaficheros): int
{
    $tamañototal = 0;
    foreach ($tablaficheros as $valor) {
        $tamañototal += $valor[0]; // El tamaño
    }
    return $tamañototal;
}


/**
 *  @return int - Número de ficheros que se han completado en el formulario 
 */

function contarFicherosRecibidos(): int
{

    $contadorficheros = 0;
    //  Chequeo si no se ha enviado ningun fichero
    if (isset($_FILES['archivos']) and !empty($_FILES['archivos']['name'][0])) {
        $contadorficheros = count($_FILES['archivos']['name']);
    }
    return $contadorficheros;
}

?>
