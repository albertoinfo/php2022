<?php
session_start();

if (!isset($_SESSION['saldo'])){
    $_SESSION['saldo'] = 0;
}


$msg="";
switch ($_POST["Orden"]){
    case "Ingreso"  : $msg = procesarIngreso  ($_POST['importe']);break;
    case "Reintegro": $msg = procesarReintegro($_POST['importe']);break;
    case "Ver Saldo": $msg = procesarVerSaldo (); break;
    case "Terminar" : session_destroy();
}
header("Location: minibanco.php?msg=".urlencode($msg));

function procesarIngreso($cantidad):string{
    $resu ="";
    if (!is_numeric($cantidad) || $cantidad < 0 ){
        $resu = "Importe Erróneo o importe menor de 0.";
    } else{
        $_SESSION['saldo'] += $cantidad;
        $resu = " Operación realizada.";
    }
    return $resu;
}

function procesarReintegro($cantidad):string{
    $resu ="";
    if (!is_numeric($cantidad) || $cantidad < 0 || $cantidad > $_SESSION['saldo']){
        $resu = "Importe Erróneo o importe superior al saldo.";
    } else{
        $_SESSION['saldo'] -= $cantidad;
        $resu = " Operación realizada.";
    }
    return $resu;
}

function procesarVerSaldo():string{
    return "Su saldo actual es $_SESSION[saldo] Euros.";
}
