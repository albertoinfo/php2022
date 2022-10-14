<?php 
// Crear página que simule un calculadora sencilla, mediante un único archivo 02.php 
// que mostrará un formularios con dos campos numéricos y 4 botones con los 4 tipos 
// de operaciones + - * /  posibles. Se incluirá también 3 controles de tipo radio que 
// indicarán como queremos que se muestre el resultado en decimal, binario o hexadecimal.
//
// El programa php debe comprobar que se han recibido los dos valores numéricos y 
// detectará el error de intento de división por cero. Mostrará el resultado calculado 
// según el formato elegido. Por omisión se mostrará en decimal.

// FUNCIONES AUXILIARES

function operar($val1,$val2,$operacion):float {
   
    switch ($operacion) {
        case '+':
            $resultado = $val1 + $val2;
            break;
        case '-':
            $resultado = $val1 - $val2;
            break;
        case  '*':
            $resultado = $val1 * $val2;
            break;
        case '/':
            $resultado = $val1 / $val2;              
            break;
    }
    return $resultado;
}

function imprimirConFormato($formato,$valor)
{
    switch ($formato) {
        case "dec":
            $valorf = $valor;
            break;
        case "hex":
            $valorf = dechex($valor);
            break;
        case "bin":
            $valorf = decbin($valor);
            break;
        default:  $valorf = $valor;
    }
    return $valorf;
}

// Si fuera por POST podia chequear $_SERVER['REQUEST_METHOD'] == 'POST'

if (isset($_GET["operacion"])) {
    $num1 = $_REQUEST['num1'];
    $num2 = $_REQUEST['num2'];
    $operacion = $_REQUEST['operacion'];
    $formato = $_REQUEST['formato'];
    
    $error =false;
    if ( ! is_numeric ( $num1 ) || !is_numeric ( $num2 ) ){
        $error = true;
        $msg = " Error: los valores introducidos no son numéricos.";
    }
    
    if (($num2 == 0) && ($operacion == '/')) {
        $error = true;
        $msg = " Error: División por cero";
    }
    
    if ( !$error ) {
        $resultado = operar($num1,$num2,$operacion);
        $msg = "El resultado es ". imprimirConFormato($formato,$resultado);
    }
    
}
require_once ("02vista.php");
?>
