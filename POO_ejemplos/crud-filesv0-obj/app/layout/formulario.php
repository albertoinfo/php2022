<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>CRUD DE USUARIOS</title>
<link href="web/default.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="container" style="width: 600px;">
<div id="header">
<h1>GESTIÓN DE USUARIOS versión 1.0</h1>
</div>
<div id="content">
<p> Datos del usuario: </p>
<form   method="POST">
<table>
 <tr><td>Nombre </td> 
 <td>
 <input type="text" 	name="nombre" f	value="<?=$nombre ?>"       <?= ($orden == "Detalles")?"readonly":"" ?> size="20" autofocus></td></tr>
 <tr><td>Login   </td> <td>
 <input type="text" 	name="login" 	value="<?=$login ?>"        <?= ($orden == "Detalles" || $orden == "Modificar")?"readonly":"" ?> size="8"></td></tr>
 <tr><td>Contraseña </td> <td>
 <input type="password" name="clave" 	value="<?=$clave ?>"        <?= ($orden == "Detalles")?"readonly":"" ?> size=10></td></tr>
 <tr><td>Comentario </td><td>
 <input type="text" 	name="comentario" value="<?=$comentario ?>" <?= ($orden == "Detalles")?"readonly":"" ?> size=20></td></tr>
 </table>
 <input type="submit"	 name="orden" 	value="<?=$orden?>">
 <button onclick="window.history.back();"> Volver </button>
</form> 
</div>
</div>
</body>
</html>


