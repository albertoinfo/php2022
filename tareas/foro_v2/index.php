<?php
// Activo el control de sesiones
session_start();
?>
<html>

<head>
    <meta charset="UTF-8">
    <link href="web/default.css" rel="stylesheet" type="text/css" />
    <title>MINIFORO</title>
</head>

<body>
    <div id="container" style="width: 450px;">
        <div id="header">
            <img src="web/logo.png" alt="mini foro logo" width="100px" height="100px">
            <h1>MINIFORO versión 2.0</h1>
        </div>

        <div id="content">


            <?php
            ///-------------------------
            // SEGUNDA APROXIMACIÓN AL MODELO VISTA CONTROLADOR. 
            // Funciones auxiliars Ej- usuarioOK
            // Incluye control de la sesión y ataque CSRF
            include_once 'app/funciones.php';



            ///// NO IDENTIFICADO /////
            if (!isset($_SESSION['usuario'])) {
                // No hay ninguna orden, muestro el formulario de entrada
                if (!isset($_REQUEST['orden'])) {
                    include_once 'app/entrada.php';
                } elseif ($_REQUEST['orden'] == "Entrar") {

                    if (
                        isset($_REQUEST['nombre']) && isset($_REQUEST['contraseña']) &&
                        usuarioOK($_REQUEST['nombre'], $_REQUEST['contraseña'])
                    ) {
                        // Anoto el usuario en la session USUARIO CONECTADO   
                        $_SESSION['usuario'] = $_REQUEST['nombre'];
                        echo " Bienvenido <b>" . $_REQUEST['nombre'] . "</b><br>";
                        // Firma del formulario
                        $_SESSION['token'] = uniqid(mt_rand(), true);
                        include_once  'app/comentario.php';
                    } else {
                        include_once 'app/entrada.php';
                        echo " <br> Usuario no válido </br>";
                    }
                    exit();
                }
            }

            /////// IDENTIFICADO ////////
            else {
                // Evito el ataque CSRF mediante token
                
                if (!isset($_REQUEST['token']) || $_REQUEST['token'] != $_SESSION['token']) {
                    echo " Intento de ataque.... ";
                    die();
                } 
                
                $_SESSION['token'] = uniqid(mt_rand(), true);
                // Genero un nuevo token por si hay que genera un formulario
                // ORDENES QUE SE PUEDEN REALIZAR SI EL USUARIO SE HA AUTENTICADO
                switch ($_REQUEST['orden']) {
                    case "Nueva opinión":
                        echo " Nueva opinión <br>";
                        $_REQUEST['comentario']="";
                        $_REQUEST['tema']="";
                        include_once  'app/comentario.php';
                        break;
                    case "Detalles": // Mensaje y detalles
                        echo "Detalles de su opinión";
                        limpiarEntrada($_REQUEST['comentario']);
                        limpiarEntrada($_REQUEST['tema']);
                        include_once 'app/comentario.php';
                        include_once 'app/detalles.php';
                        break;
                    case "Terminar": // Formulario inicial
                        // Cierro la session
                        session_destroy();
                        include_once 'app/entrada.php';
                }
            }


            ?>
        </div>
</body>

</html>