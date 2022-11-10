<?php
session_start();

if (!isset($_SESSION['fallos'])){
  $_SESSION['fallos'] =0;
}
if ($_SESSION['fallos'] >= 5){
  include_once('app/accesobloqueado.php');
  die();
}

include_once('app/funciones.php');

if (  !empty( $_GET['login']) && !empty($_GET['clave'])){
    if ( userOk($_GET['login'],$_GET['clave'])){
      $_SESSION['fallos']=0; // Contador a 0
      if ( getUserRol($_GET['login']) == ROL_PROFESOR){
        $contenido = verNotaTodas($_GET['login']);
      } else {
        $contenido = verNotasAlumno($_GET['login']);
      }
      include_once ('app/resultado.php');
    } 
    // userOK falso
    else {
       $contenido = "El número de usuario y la contraseña no son válidos";
       $_SESSION['fallos']++;
       include_once('app/acceso.php');
    }
} else {
    $contenido = " Introduzca su número de usuario y su contraseña";
    include_once('app/acceso.php');
}


