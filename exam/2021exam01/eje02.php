<?php
function checkCSRF(){
    if ( !isset($_REQUEST['token']) || 
         $_REQUEST['token'] != $_SESSION['token']){
          exit(); // Termina sin dar nada de información
         }
  }

function cargardatos ():array {
    $tabla = [];
    $fich = @fopen("contactos.txt","r");
    if (!$fich ){
        die (" Error no se puede abrir el fichero de contactos.");
    }

    while ( $valores = fgetcsv($fich)){
        //var_dump($valores);
        $tabla[$valores[0]]=$valores[1];
    }
    fclose($fich);
    return $tabla;
}

function anotar ( $nombre,$telefono):void {

    $fich = @fopen("contactos.txt","a");
    if (!$fich ){
        die (" Error no se puede abrir el fichero de contactos.");
    }
    $valores=[ $nombre, $telefono];
    fputcsv($fich,$valores);
    fclose($fich);
}

session_start();
// Si hay que procesar el formulario
if ( isset($_GET['orden'])){
    checkCSRF();
}

// Genero el nuevo token
$token = md5(uniqid(mt_rand(), true));
// Guardo nuevo token generado.
$_SESSION['token']=$token;

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title> Agenda App </title>
</head>
<body>
<form>
<fieldset>
  <legend>Su agenda personal</legend>
    <label for="nombre">Nombre:</label><br>
    <input type='text' name='nombre' size=20
    value ="<?= empty($_GET['nombre'])?'':$_GET['nombre'] ?>">
    <input type='submit' name="orden" value="Consultar"><br>
    <label for="telefono">Teléfono:</label><br>
    <input type='tel' name='telefono' size=20
    value ="<?= empty($_GET['telefono'])?'':$_GET['telefono'] ?>">
    <input type='submit' name="orden" value="Añadir">
    <input type="hidden" name="token" value="<?= $token ?>" >
</fieldset>
</form>
<p>
<?php

$datosagenda = cargardatos();

if (!empty($_GET['nombre']) && isset($_GET["orden"]) && $_GET["orden"]=="Consultar") {
    if (array_key_exists($_GET['nombre'], $datosagenda)) {
        echo " El teléfono de ".$_GET['nombre']." es ".$datosagenda[$_GET['nombre']];
    } else {
        echo " No se encuentra " . $_GET['nombre'] . " en la agenda ";
    }
}

if (!empty($_GET['nombre']) && isset($_GET["orden"]) && $_GET["orden"]=="Añadir") {
    if ( empty ($_GET['telefono']) || !is_numeric($_GET['telefono']) ){
       echo " Debé introducir un teléfono correcto";
   } else {
       anotar($_GET['nombre'],$_GET['telefono']);
       echo " Contacto anotado.";
   }
}

?>
</p>
</body>
</html>