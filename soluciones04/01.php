<?php 
//  Elaborar programa (01.php) en php que procese un formulario (01.html) 
//  que solicita al usuario un nombre y una clave. El programa php tendrá un array asociativo
//  con 3 pares de valores de usuario => contraseña.  Se comprobará consultando la tabla si 
//  los datos son válidos, en este caso se debe mostrar un mensaje de bienvenida con nombre introducido,
//  en otro caso se mostrar un mensaje de error para que usuario pueda volver a introducir nuevos datos.
//  
//  Se muestran dos formas para volver a la página anterior 01.html si se produce un error: 
//  mediante javascript y modificado la respuesta en  la cabecera http
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link href="default.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<div id="container" style="width: 400px;">
		<div id="header">
			<h1>Procesando formulario</h1>
		</div>

		<div id="content">
<?php 

$tusuarios = [ 'pepe' => '1234', 
               "luis" => "siul", 
               "admin"=> "admin"];

if (empty($_REQUEST['nombre']) ||  empty($_REQUEST['clave'])){
    echo " Error: falta valores introducir los valores de usuario y contraseña.<br> ";
    echo " <button onclick='window.history.back();'>Volver</button> ";
    exit;
}
// PELIGRO: No controlo la seguridad de las entradas
$usuario = $_REQUEST['nombre'];
$clave   = $_REQUEST['clave'];

if ( array_key_exists($usuario, $tusuarios) &&  $tusuarios[$usuario] == $clave ){
    echo " Bienvenido $usuario al sistema ";
    }
    else {
    // Cargo de nuevo el formulario  después de 3 segundos 
    header( "refresh:3;url=01.html" );
    echo "Error: Usuario y contraseña no válidos.<br> ";
    }
    

?>
</div>
</div>
</body>
</html>