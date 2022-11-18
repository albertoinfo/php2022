<?php
function accionBorrar ($id){    
    
    unset($_SESSION['tuser'][$id]); // Borrar el elemento
    // Reindexa el indice 0,1,2 de la array 
    $_SESSION['tuser'] = array_values($_SESSION['tuser']);
    $_SESSION['msg'] = "El usuario ha sido eliminado";
}

function accionTerminar(){
    volcarDatos($_SESSION['tuser']);
    session_destroy();
    $_SESSION['msg'] = " Los datos se han volcado al fichero.";
}
 
function accionAlta(){
    $nombre  = "";
    $login   = "";
    $clave   = "";
    $comentario = "";
    $orden= "Nuevo";
    include_once "layout/formulario.php";
}


function accionRepetirAlta($msgformulario){
  
    $nombre  =  $_POST['nombre'];
    $login   =  $_POST['login'];
    $clave   =   $_POST['clave'];
    $comentario =  $_POST['comentario'];
    $orden= "Nuevo";
    $msg = $msgformulario;
    include_once "layout/formulario.php";
}



function accionDetalles($id){
    $usuario = $_SESSION['tuser'][$id];
    $nombre  = $usuario[0];
    $login   = $usuario[1];
    $clave   = $usuario[2];
    $comentario=$usuario[3];
    $orden = "Detalles";
    include_once "layout/formulario.php";
}


function accionModificar($id){
    $usuario = $_SESSION['tuser'][$id];
    $nombre  = $usuario[0];
    $login   = $usuario[1];
    $clave   = $usuario[2];
    $comentario=$usuario[3];
    $orden="Modificar";
    include_once "layout/formulario.php";
}

function accionPostAlta(){
 
    limpiarArrayEntrada($_POST); //Evito la posible inyección de código

    $msgerror = "";
    if ( empty($_POST['nombre']) ||
         empty($_POST['login'])  ||
         empty($_POST['clave'])  ||
         empty($_POST['comentario']) ){
         $msgerror= "Todos los campos tienen que ser rellenados";
         accionRepetirAlta($msgerror);
         return;
    }
    

    foreach ($_SESSION['tuser'] as $usuario){
        if ($usuario[1] == $_POST['login']){
            $existe = true;
            $msgerror = " El valor de login está repetido";
            accionRepetirAlta($msgerror);
            return;
        }
    } 


    $nuevo = [ $_POST['nombre'],$_POST['login'],$_POST['clave'],$_POST['comentario']];
    $_SESSION['tuser'][]= $nuevo;
    $_SESSION['msg'] = " Nuevo usuario almacenado.";
    

}

function accionPostModificar(){
    limpiarArrayEntrada($_POST); //Evito la posible inyección de código
    $i=0;
    foreach ($_SESSION['tuser'] as $usuario){
        if ($usuario[1] == $_POST['login']){
            $usuario[0]= $_POST['nombre'];
            $usuario[2]= $_POST['clave'];
            $usuario[3]= $_POST['comentario'];
            $_SESSION['tuser'][$i] = $usuario;
            break;
        }
        $i++;
    }
    
}

