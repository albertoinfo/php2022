<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>CONSULTA PAGINACIÓN</title>
<link href="web/default.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="container" style="width: 900px;">
<div id="header">
<h1>CONSULTA CON PAGINACIÓN versión 1.0</h1>
</div>
<div id="content">
<table>
<tr><th>id</th><th>first_name</th><th>email</th>
<th>gender</th><th>ip_address</th><th>teléfono</th></tr>
<?php foreach ($tvalores as $valor): ?>
<tr>
<td><?= $valor->id ?> </td>
<td><?= $valor->first_name ?> </td>
<td><?= $valor->email ?> </td>
<td><?= $valor->gender ?> </td>
<td><?= $valor->ip_address ?> </td>
<td><?= $valor->telefono ?> </td>
<tr>
<?php endforeach ?>
</table>
<form>
<br>
<input type="submit" name="orden" value="Primero">
<input type="submit" name="orden" value="Siguiente">
<input type="submit" name="orden" value="Anterior">
<input type="submit" name="orden" value="Ultimo">
</form>
</div>
</div>
</body>
</html>