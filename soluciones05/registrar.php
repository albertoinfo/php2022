<?php
// Funciones auxilires  
// ------------------------------------------------------------------
function estaVacio ($valor) {
    return empty(trim($valor));
}

function hayMayusculas ($valor){
    for ($i=0; $i<strlen($valor); $i++){
        if ( ctype_upper($valor[$i]) )
            return true;
    }
    return false;
}

function hayMinusculas ($valor){
    for ($i=0; $i<strlen($valor); $i++){
        if ( ctype_lower($valor[$i]))
            return true;
    }
    return false;
}

function hayDigito ($valor){
    for ($i=0; $i<strlen($valor); $i++){
        if ( ctype_digit($valor[$i]) )
            return true;
    }
    return false;
}

function hayNoAlfanumerico ($valor){
    for ($i=0; $i<strlen($valor); $i++){
        if ( !ctype_alnum($valor[$i]) )
            return true;
    }
    return false;
}

function postvalor(string $elemento):string {
    if ( isset($_POST[$elemento])){
        $resu = $_POST[$elemento];
    }else {
        $resu= "";
    }
    return $resu;
}
//--------------------------------------------------------------------
// Proceso los datos
$msg="";
$registrado = false;
if($_SERVER['REQUEST_METHOD'] == "POST")  {
// No hay valores vacios
$campovacio = "";
foreach ($_POST as $campo => $valor) {
    if (estaVacio($valor)){
        $campovacio=$campo;
        break;
    }
   }
if ( $campovacio !="" ) {
    $msg = "El campo $campovacio esta vacio <br>";
}  
// No es un email
else if ( !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
    $msg .= " No es un email correcto. <br>";
} 

// Validando contraseña
else if (  $_POST['contraseña1'] != $_POST['contraseña2'] ){
    $msg .= " Las contraseñas deben ser iguales <br> ";
}

else if (  strlen($_POST['contraseña1']) < 8 ){
    $msg .= " Tamaño de la contraseña debe ser igual o superior a 8 caracteres en total <br>";
    
}

else if ( !hayMayusculas($_POST['contraseña1']) || !hayMinusculas($_POST['contraseña1'])){
    $msg .= " Debe haber mayúsculas y minúsculas.<br> ";
    echo $_POST['contraseña1'];
    
}
else if ( !hayDigito($_POST['contraseña1'])){
    $msg .= " Debe haber algun dígito. <br>";
    
}

else if ( !hayNoAlfanumerico($_POST['contraseña1'])){
    $msg .= " No hay nigún caracter no alfanumérico <br> ";
          
} else {
// Pasado todos los controles
$registrado=true;
}
} // PETICIÓN POST

?>
<html>
<head>
<meta charset="UTF-8">
<link href="default.css" rel="stylesheet" type="text/css" />
<title>Registrar Usuario</title>
</head>
<body>
<div id="container" style="width: 600px;">
		<div id="header">
			<h1>FORMULARIO DE REGISTRO</h1>
		</div>


<div id="content">
<?php if (!$registrado): ?>
<form  method="post">
     <fieldset>
     <legend>Datos para registrar:</legend>
	
	<input type="text" name="nombre" placeholder="Nombre" 
    value="<?= postvalor('nombre') ?>" size="10">
	<input type="text" name="email" placeholder="Correo electrónico"
    value="<?= postvalor('email')  ?>" size="15"><br>	
	<input type="text" name="contraseña1" placeholder="Contraseña"  
    value="<?= postvalor('contraseña1')  ?>" size="10"><br>	
	<input type="text" name="contraseña2" placeholder="Contraseña" 
    value="<?= postvalor('contraseña2') ?>"  size="10"><br>	
	<input type="submit" value="Enviar" /> 
    <input type="reset" value="Limpiar" />
</fieldset>
</form>
<?=$msg ?>
<?php else: ?>
   Sus datos son correctos. <br><b> Ha sido registrado en el sistema.<b><br>
<?php endif?>
</div>
</div>
</body>
</html>
