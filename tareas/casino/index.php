<?php
session_start();
// Actualizo el cookie de visitas
$visitas = 1;
if ( isset( $_COOKIE['visitascasino'])){
    $visitas = $_COOKIE['visitascasino'];
}

$msg="";

// Entra en el casino --------------------------------
if (! isset($_SESSION['disponible'])) {
    if ( empty($_POST['cantidadini'])) {
        require_once "form_bienvenida.php";
    } else {
        // Me ha indicado la cantidad
        $_SESSION['disponible'] = $_POST['cantidadini'];
         header("Refresh:0");
    }
    exit();
}

// Si realiza una apuesta ----------------------------------
if (isset($_POST["apostar"])) {
    if ( is_numeric ($_POST["cantidad"]) and  $_POST["cantidad"] > 0 ) {
    $msg = procesarApuesta($_POST["cantidad"],$_SESSION['disponible'],$_POST['apuesta']);
    } else {
    $msg = " El valor ". $_POST["cantidad"]." no es correcto.";
    }
 }

// Si abandona o ya no le queda dinero -------------------------
 if (isset($_POST["dejar"]) || ($_SESSION["disponible"] == 0) ) {
   dejarCasino($visitas);
   require_once "despedida.php";
   exit();
} 
// Muestro el formulario
require_once  "form_apuesta.php";
?>


<?php

/**
 *  FUNCIONES AUXILIARES
 */

function procesarApuesta(int $valorapuesta, int & $saldodisponible, string $apuesta): String {
    $msgresultado = "";
    if ($valorapuesta > $saldodisponible ) {
        $msgresultado .= "Error: no dispone de  $valorapuesta euros disponibles. ";
    } else {
        $resultado = (random_int(1, 100) % 2 == 0) ? "PAR" : "IMPAR";
        $msgresultado .= " RESULTADO DE LA APUESTA : " . $resultado ;
        if ($apuesta == $resultado) {
            $msgresultado .= " GANASTE <br>";
            $saldodisponible  += $valorapuesta;
        } else {
            $msgresultado .=" PERDISTE <br>";
            $saldodisponible  -= $valorapuesta;
        }
    }
  return $msgresultado;
}

function dejarCasino ($visitasrealizadas){
    $visitasrealizadas++;
    setcookie("visitascasino",$visitasrealizadas, time()+ 30 * 24 * 3600); // Un mes  
    session_destroy();
}
