<?php session_start(); 

include_once 'app/navegacion.php';

// Campos de los formularios
$listadecampos = [ "nombre","apellidos","genero","fechaNacimiento","casado","hijos","nacionalidad",
    "departamento","salario","comentarios",
    "cuenta" ];



// NUEVA SESSION
// Si es un sesion nueva (No existe paso)
if ( !isset($_SESSION['paso']) ){
    $_SESSION['paso'] = 1;
    $_SESSION['valores']=[];    
}

// Creo las variables con valores vacios
foreach ($listadecampos as $valor){
    if ( $valor != "nacionalidad"){
        ${$valor} ="";
    }
    else {
        ${$valor}=[]; // nacionalidad es un array no se puede inicializar como String
    }
}

// Todo lo que reciba por POST lo guardo en la sesión 
foreach ($_POST as $clave => $valor){
    // Si es un valor de un campo lo guardo en la sesión Evito almacenar submit Siguiente anterior
    if ( in_array($clave,$listadecampos)){
        // OJO ***** 
        // En una aplicación real se deberÍa chequear el valor antes de almacenarlo en la sesion
       $_SESSION['valores'][$clave] = $valor;
    }
}

// Tratamiento especial para los checkbox: Problema si no se marcan no se envian 
// Si estoy en la paso numero 1
if ($_SESSION['paso']== 1){
    if ( !isset($_POST['casado'])){
        $_SESSION['valores']['casado']="NO";
    }
    if ( !isset($_POST['hijos'])){
        $_SESSION['valores']['hijos'] ="NO";
    }
    
}


// Todo lo que este en la sesión lo copio a las variables del formulario
foreach ($_SESSION['valores'] as $clave => $valor) {
    ${$clave} = $valor;
}



// --------------- Gestión de la navegación ---------------------

if (isset($_REQUEST['Anterior']) && $_SESSION['paso']>1){
    $_SESSION['paso']--;
}

if (isset($_REQUEST['Siguiente']) && $_SESSION['paso']<5){
    $_SESSION['paso']++;
}

if (isset($_REQUEST['Terminar'])){
    session_destroy();
    // Ojo no vale header("Refresh:0") se reenvia con Terminar en la URL
    header("Refresh:0; url=\"".$_SERVER['PHP_SELF']."\"");
    exit();
}

// Se ha seleccionado la Barra de navegación
if (isset($_REQUEST['nav'])){
    $_SESSION['paso'] = $_REQUEST['nav'];
}

switch ( $_SESSION['paso']){
        case 1 : include_once ('app/1_datosPersonales.php');break;
        case 2 : include_once ('app/2_datosProfesionales.php');break;
        case 3 : include_once ('app/3_datosBancarios.php');break;
        case 4 : include_once ('app/4_resumen.php'); break;
}

