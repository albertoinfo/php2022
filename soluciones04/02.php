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
?>
<!DOCTYPE unspecified PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
<meta charset="utf-8">
<link href="default.css" rel="stylesheet" type="text/css" />
</head>
<script>
// No se puede borrar con el reset si tiene value fijados 
function borrarvalores(){
    document.getElementsByName('num1').value = "";
    document.getElementsByName('num2').value = "";
}
</script>
<body>
	<div id="container" style="width: 400px;">
	<div id="header">
		<h1>Mini Calculadora</h1>
	</div>

	<div id="content">
	<form>
	<!--  Incluyo código PHP para conservar el valor recibido por en $_POST -->
	Nº1:<input type="text" name="num1" size=10 value="<?=isset($num1)?$num1:''?>"> 
	<br>
	Nº2:<input type="text" name="num2" size=10 value="<?=isset($num2)?$num2:''?>">
	<br>
	<fieldset>
	<button name='operacion' value='+'> +</button>
	<button name='operacion' value='-'> -</button>
	<button name='operacion' value='*'> *</button>
	<button name='operacion' value='/'> /</button>
	<button name='borrar' value="Borrar" onclick='borrarvalores()' >Borrar</button>
	</fieldset>
	<br>
	<fieldset>
	<!-- Por defecto es decimal -->
	<input type="radio" name="formato" value="dec" 
	    <?=(!isset($formato) || $formato =="dec")? "checked='checked'":""?> >Decimal 
	<input	type="radio" name="formato" value="bin"
	    <?=(isset($formato)  && $formato =="bin")? "checked='checked'":""?> >Binario 
	<input type="radio" name="formato" value="hex"
        <?=(isset($formato)  && $formato =="hex")? "checked='checked'":""?> >Hexadecimal<br>
	</fieldset>
	<input type="reset" value=" borrar con reset ">
	</form>
	<?= isset($msg)?$msg:""?><br>
</div>
</div>

</body>
</html>



