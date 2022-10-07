<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link href="default.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<div id="container" style="width: 380px;">
		<div id="header">
			<h1>FORMULARIOS DE ACCESO</h1>
		</div>

		<div id="content">
            <?= isset($msg)?$msg:''?>
			<form name='entrada' method="post" action="index.php">
				<table  style="border: node; ">
					<tr>
						<td>Nombre:</td>
						<td><input type="text" name="nombre" size="20"
						 value= "<?= isset($nombre)?$nombre:'' ?>"> </td>
					</tr>
					<tr>
						<td>Contraseña:</td>
						<td><input type="password" name="clave" size="20"
						value= "<?= isset($nombre)?$nombre:'' ?>"></td>
						</td>
					</tr>
				</table>
				<input type="submit" name="orden" value="Entrar">
			</form>
		</div>
	</div>
</body>
</html>