<?php
$error = false;
if ( $_SERVER["REQUEST_METHOD"] == 'POST'){
    if (empty($_REQUEST['nombre']) ||  empty($_REQUEST['clave'])){
        $msg =" Error: falta valores introducir los valores de usuario y contraseña.<br> ";
        $error = true;
    } else {
    $nombre = $_REQUEST['nombre'];
    $clave   = $_REQUEST['clave'];
    // Los datos son válidos si son iguales
    if ( $nombre == $clave){
        include ("bienvenida.php");
        }
    else {
        $msg =  "Error: Usuario y contraseña no son válidos.<br> ";
        $error = true;
        }
    }    
}

if ( $_SERVER["REQUEST_METHOD"] == 'GET' or $error ){
    include ("entrada.php");
}    



