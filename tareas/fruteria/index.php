<?php
session_start();

$compraRealizada = "";

// Nuevo cliente 
if (isset($_GET['cliente'])) {
    $_SESSION['cliente'] = $_GET['cliente'];
    $_SESSION['pedidos'] = [];
}

if (!isset($_SESSION['cliente'])) {
    require_once('bienvenida.php');
    exit();
}

if (isset($_POST["accion"])) {

    if ($_POST["accion"] == " Anotar ") {
        if (isset($_SESSION['pedidos'][$_POST['fruta']]))
            $_SESSION['pedidos'][$_POST['fruta']] += $_POST['cantidad'];
        else {
            $_SESSION['pedidos'][$_POST['fruta']] = $_POST['cantidad'];
        }
    }

    if ($_POST["accion"] == " Terminar ") {
        $compraRealizada = htmlTablaPedidos();
        require_once("despedida.php");
        session_destroy();
        exit;
    }
}

$compraRealizada = htmlTablaPedidos();
require_once('compra.php');


function htmlTablaPedidos(): string
{
    $msg = "";
    if (count($_SESSION['pedidos']) > 0) {
        $msg .= "Este es su pedido :";
        $msg .= "<table style='border: 1px solid black;'>";
        foreach ($_SESSION['pedidos'] as $key => $value) {
            $msg .= "<tr><td><b>" . $key . "</b><td></td><td>" . $value . "</td></tr>";
        }
        $msg .= "</table>";
    }
    return $msg;
}
