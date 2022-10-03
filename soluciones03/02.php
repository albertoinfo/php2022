<!DOCTYPE html>
<html>
<head>
	<title>Lista de medios</title>
	<meta charset="utf-8">
</head>
<body>
	<?php
		
		$medios =  [ "El Pais" => "https://www.elpais.com",
		             "El Mundo" => "https://www.elmundo.es",
		             "Marca" => "https://www.marca.com", 
		             "Antena3" => "https://www.antena3.com", 
		             "La Razón" => "https://www.larazon.es"
		    
		            ];
		
		echo "<h1>Lista de Medios: </h1><ul>";
		foreach ($medios as $clave => $valor){
		    echo "<li> <a href=\"$valor\">$clave</a></li>";
		}
		echo "</ul>";
	?>
<hr>
<?php show_source(__FILE__); ?>
<hr>
</body>
</html>