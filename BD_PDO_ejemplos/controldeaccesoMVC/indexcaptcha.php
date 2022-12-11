<?php

require_once "app/modelo/User.php";
require_once "app/modelo/AccesoDatos.php";

/* CONTROL DE ACCESO A UNA APLICACIÓN
*  - Valida contra la base de datos
*  - Cierra la sesión pasado 60 segundo sin volver a acceder
*  - Pide un catpcha de google tras  tres fallos consecutivos
     control catpcha basada en: http://www.formacionwebonline.com/integrar-captcha-de-google-de-manera-sencilla-en-formulario-php-y-html/
*/

session_start();
$mensaje = "";

// Control de tiempo de la sesión 
if (isset($_SESSION['timeout'])) {
    $horaActual = time();
    // Si han pasado 60 sg cierra la sesión
    if (($horaActual - $_SESSION['timeout']) > 60) {
        session_destroy();
        header("refresh:0");
        exit();
    }
}

// HA ENTRADO EN LA APLICACIÓN Y NO PULSA SALIR

if (isset($_SESSION['Nombre']) &&  $_SERVER['REQUEST_METHOD'] == "GET") {
    $mensaje = " $_SESSION[Nombre] Bienvenido al sistema <br>";
    $mensaje .= " Has entrado $_SESSION[accesos] veces <br>";
    $_SESSION['timeout'] = time(); // Actualizo la temporización
    include_once 'app/vistas/vistaapp.php';
    exit();
}

// EJEMPLO DE CONEXIÓN A LA BASE DE DATOS
// Utilizando el interfaz PDO

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if ($_POST['orden'] == "Salir") {
        session_destroy();
        header("refresh:0");
        exit();
    }

    if ($_POST['orden'] == "Entrar") {
        
        // Si ha habido chaptcha
        if ( isset ($_POST["g-recaptcha-response"])){
            include_once "app/util/validarcaptcha.php";
        }
        
        $login  = $_POST['login'];
        $passwd = $_POST['passwd'];
        $db = AccesoDatos::getModelo();
        $user = $db->getUsuario($login);
        // No existe el usuario
        if ($user != null && $user->passwd == $passwd ) {
                    $_SESSION['Nombre'] = $user->Nombre;
                    $_SESSION['accesos'] = $user->accesos;
                    $db->incrementarAccesos($user->login);
                    $_SESSION['error'] = 0;
                    header("refresh:0");
                // Password incorrecto
            } else {
                $mensaje = "El identificador y/o la contraseña no son correctos**.<br>";
                // Fallo consecutivos y activación de captcha
                if (isset($_SESSION['error']) ) {
                    $_SESSION['error']++;
                    if ($_SESSION['error'] > 3) {
                        $activarcaptcha = true;
                    }
                } else {
                    $_SESSION['error'] = 1;
                }
            }
        }
    
}
include_once 'app/vistas/vistaloginapp.php';