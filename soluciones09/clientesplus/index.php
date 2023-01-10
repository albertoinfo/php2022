<?php
$conex = new mysqli("localhost", "root", "root", "telefonia"); // Abre una conexión
if ($conex->connect_errno) {
    // Comprueba conexión
    printf("Conexión fallida: %s\n", mysqli_connect_error());
    exit();
}
$result = $conex->query("select max(puntos) as maxpuntos from clientes");

$maxpuntos = 0;
if ($fila = $result->fetch_assoc()) {
    $maxpuntos = $fila['maxpuntos'];
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link href="default.css" rel="stylesheet" type="text/css" />
<script language="JavaScript">
function validar() {
valor=parseInt(document.entrada.puntos.value );
puntosmaxjs = <?= $maxpuntos ?> ;
if(valor> puntosmaxjs) {
	alert("El valor supera el máximo actual");
	return false;
 }
return true;
}
</script>
</head>
<body>
	<div id="container" style="width: 380px;">
		<div id="header">
			<h1>CLIENTESPLUS</h1>
		</div>
		<div id="content">

			<form name="entrada" onsubmit=" return validar()" method="POST"
				action="./verpuntos.php">
				<table style="border: node;">
					<tr>
						<td>PUNTOS</td>
						<td><input type="text" name="puntos" size="6"></td>
					</tr>
				</table>
				<input type="submit" name="orden" value="Entrar">
			</form>
		</div>
	</div>
</body>
</html>
