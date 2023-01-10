<?php
include_once 'AccesoDatos.php';

// CONTROLADOR

if (isset ($_POST['puntos']) && is_numeric($_POST['puntos'])){
    $puntos= $_POST['puntos'];
} else {
    $mensaje = " Introduzca un valor de puntos correcto.";
    include_once 'vista.php';
    exit();
}

// Accedo al Modelo
$conexdb = AccesoDatos::initModelo();
$resultados = $conexdb->obtenerListaClientes($puntos);
if ( count($resultados) == 0){
    $mensaje = "No se encuentran clientes con esos puntos.";
    unset($resultados);
}
// Cargo la vista 
include_once 'vista.php';
?>




