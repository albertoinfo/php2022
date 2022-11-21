<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>CRUD DE PRODUCTOS</title>
<link href="web/default.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="container" style="width: 600px;">
<div id="header">
<h1>GESTIÓN DE PRODUCTOS versión 1.1 + BD</h1>
</div>
<div id="content">
<hr>
<form   method="POST">
<table>
<tr><td>Nº Producto   </td> <td>
 <input type="text" 	name="PRODUCTO_NO" 	value="<?=$pro->PRODUCTO_NO ?>"        <?= ($orden == "Detalles" || $orden == "Modificar")?"readonly":"" ?> size="8"></td></tr>
 
 <tr><td>Descripión</td> 
 <td>
 <input type="text" 	name="DESCRIPCION" 	value="<?=$pro->DESCRIPCION ?>"       <?= ($orden == "Detalles")?"readonly":"" ?> size="20" autofocus></td></tr>
 <tr><td>Precio </td> <td>
 <input type="text"     name="PRECIO_ACTUAL" 	value="<?=$pro->PRECIO_ACTUAL ?>"        <?= ($orden == "Detalles")?"readonly":"" ?> size=10></td></tr>
 <tr><td>Stock </td><td>
 <input type="number" 	name="STOCK_DISPONIBLE" value="<?=$pro->STOCK_DISPONIBLE ?>" <?= ($orden == "Detalles")?"readonly":"" ?> size=20></td></tr>
 </table>
 <input type="submit"	 name="orden" 	value="<?=$orden?>">
 <input type="submit"	 name="orden" 	value="Volver">
</form> 
</div>
</div>
</body>
</html>
<?php exit(); ?>

