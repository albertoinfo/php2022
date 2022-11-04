<?php
include_once 'funcionesahorcado.php';
session_start();
define('MAXFALLOS', 6);


$ganadas = 0;
if (isset($_COOKIE['ganadas'])){
    $ganadas = $_COOKIE['ganadas'];
}

$msg = "";
$finaljuego = false;
// INICIO NO HAY PALABRA ELEGIDA (NUEVA PARTIDA)
if (!isset($_SESSION['palabrasecreta'])) {
    $_SESSION['palabrasecreta'] = elegirPalabra();
    $_SESSION['letrasusuario'] = "";
    $_SESSION['fallos'] = 0;
    $msg .= " NUEVA PARTIDA <br>";
    if ( $ganadas > 0 ){
        $msg .= " Has ganado $ganadas partidas.<br>";
    }
}



if (isset($_REQUEST['letra'])) {
    $letra =  $_REQUEST['letra'];
    if (comprobarLetra($letra, $_SESSION['palabrasecreta']) == false) {
        $_SESSION['fallos']++;
        if ($_SESSION['fallos'] >= MAXFALLOS) {
            $msg .= " Superado el máximo número de fallos. Has perdido <br> ";
            session_destroy();
            $finaljuego = true;
        }
    } else {
        // Anoto la letra 
        $_SESSION['letrasusuario'] .= $letra;
    }
}

$palabramostrar = generaPalabraconHuecos($_SESSION['letrasusuario'], $_SESSION['palabrasecreta']);
$msg .= " PALABRA :  $palabramostrar </br> ";
// Ha ganado ???
if ($palabramostrar == $_SESSION['palabrasecreta']) {
    $ganadas++;
    $msg .= " Enhorabuena has ganado. Ya son $ganadas partidas ganadas.<br>";
    $finaljuego = true;
     // Actualizo el cookie
     setcookie("ganadas",$ganadas, time()+ 2 * 7 * 24 * 3600);
    session_destroy();
} else {
    $msg .= " Has comentido " . $_SESSION['fallos'] . " fallos <br>";
}





?>
<html>

<head>
    <meta charset="UTF-8">
    <title>El ahorcado </title>
</head>

<body>
    <div><?= $msg ?> </div>
    <?php if (!$finaljuego) : ?>
        <form>
            Introduzca una letra <input type="text" size="1" maxlength="1" name="letra" autofocus>
        </form>
    <?php else : ?>
        <a href="<?= $_SERVER['PHP_SELF'] ?>"> Otra partida </a>
    <?php endif; ?>
</body>

</html>