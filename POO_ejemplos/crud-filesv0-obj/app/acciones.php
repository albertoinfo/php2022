<?php



function accionDetalles($id){
    $usuario = $_SESSION['tuser'][$id];
    $nombre  = $usuario->nombre;
    $login   = $usuario->login;
    $clave   = $usuario->clave;
    $comentario=$usuario->comentario;
    $orden = "Detalles";
    include_once "layout/formulario.php";
    exit();
}

function accionAlta(){
    $nombre  = "";
    $login   = "";
    $clave   = "";
    $comentario = "";
    $orden= "Nuevo";
    include_once "layout/formulario.php";
    exit();
}

function accionPostAlta(){
 
    limpiarArrayEntrada($_POST); //Evito la posible inyección de código
    
    $usr = new Usuario();
        $usr->nombre     = $_POST['nombre'];
        $usr->login      = $_POST['login'];
        $usr->clave      = $_POST['clave'];
        $usr->comentario = $_POST['comentario'];
    
   
    $_SESSION['tuser'][]= $usr;  
}


