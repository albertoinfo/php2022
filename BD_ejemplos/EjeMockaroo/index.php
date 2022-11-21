<?php
// Controlador
require_once('app/Usuario.php');
require_once('app/AccesoDAO');
define ('FPAG',10); // Número de filas por página

session_start();

$midb = AccesoDAO::getModelo();
$totalfilas = $midb->numUsuarios();
if ( $totalfilas % FPAG == 0){
    $posfin = $totalfilas - FPAG;
} else {
    $posfin = (int) ($totalfilas/FPAG) * FPAG;
}

if ( !isset($_SESSION['posini']) ){
  $_SESSION['posini'] = 0;
}
$posAux = $_SESSION['posini'];

// Proceso la ordenes
if ( isset($_GET['orden'])) {

    switch ( $_GET['orden']) {
        case "Primero"  : $posAux = 0; break;
        case "Siguiente": $posAux +=FPAG; if ($posAux > $posfin) $posAux=$posfin; break;
        case "Anterior" : $posAux -=FPAG; if ($posAux < 0) $posAux =0; break;
        case "Ultimo"   : $posAux = $posfin;
    }
}
$_SESSION['posini'] = $posAux;

// Accedo al Modelo
$tvalores = $midb->getUsuarios($posAux,10);
// Invoco la vista
include_once('app/plantillas/principal.php');

