<?php 
include_once 'Cliente.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link href="default.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="container" style="width: 380px;">
<div id="header">
<h1>CLIENTESPLUS MVC</h1>
</div>
<div id="content">
   <?= isset($mensaje)?$mensaje:"" ?>
   
   <?php 
   if (isset($resultados)){ ?>	
    	<table border=1><th>Teléfono</th><th>Nombre</th><th>Puntos</tr>
    		<?php foreach ($resultados as $cliente ) { ?>
        	<tr>
        	<td><?=$cliente->telefono ?></td>
        	<td><?=$cliente->nombre   ?></td>
        	<td><?=$cliente->puntos   ?></td>
        	</tr>
   	 	 
    <?php } ?>
     </table>  
   <?php } ?>
 
</div>
</div>
</body>
</html>
