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
<h1>GESTIÓN DE USUARIOS versión 1.1 + BD</h1>
</div>
<div id="content">
<hr>
<form   method="POST">
<table>
 <tr><td>Nombre </td> 
 <td>
 <input type="text" 	name="nombre" 	value="<?=$user->nombre ?>"       <?= ($orden == "Detalles")?"readonly":"" ?> size="20" autofocus></td></tr>
 <tr><td>Login   </td> <td>
 <input type="text" 	name="login" 	value="<?=$user->login ?>"        <?= ($orden == "Detalles" || $orden == "Modificar")?"readonly":"" ?> size="8"></td></tr>
 <tr><td>Contraseña </td> <td>
 <input type="password" name="clave" 	value="<?=$user->password ?>"        <?= ($orden == "Detalles")?"readonly":"" ?> size=10></td></tr>
 <tr><td>Comentario </td><td>
 <input type="text" 	name="comentario" value="<?=$user->comentario ?>" <?= ($orden == "Detalles")?"readonly":"" ?> size=20></td></tr>
 </table>
 <input type="submit"	 name="orden" 	value="<?=$orden?>">
 <input type="submit"	 name="orden" 	value="Volver">
</form> 
</div>
</div>
</body>
</html>
<?php exit(); ?>

