<html>
<head>
<title>Cuadrados de colores</title>
<style>
body {
	background: silver;
	text-align: justify;
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 14px;
	color: #757E82;
}

#container {
	margin: 0 auto;
	width: 500px;
	background: #fff;
	border: solid 1px;
}

#header {
	background: blue;
	text-align: center;
	padding: 20px;
	color: white;
	text-shadow: black 0.1em 0.1em 0.2em;
}

#content {
	background: white;
	clear: left;
	padding: 20px;
	align-content: center;
	
}
table, th, td {
  border: 1px solid black;
} 
</style>
</head>
<body>
	<div id="container">
		<div id="header">
			<h1>Tablero de colores</h1>
		</div>
		<div id="content">
		<table>
		<?php
		define ('INCREMENTOCOLOR', 3);
		// Ojo paso por referencia para mantener los cambios
		function dameColorIncrementado(&$rojo,&$verde,&$azul):string{
		   
		    $rojo  += INCREMENTOCOLOR;
		    $azul  += INCREMENTOCOLOR;
		    $verde += INCREMENTOCOLOR;
		    
		    $rcolor = "rgb($rojo,$verde,$azul)";
		    
		    return $rcolor;
		}
		// Color inicial 
		$rojo  = random_int(0,255);
		$verde = random_int(0,255);
		$azul  = random_int(0,255);
		
		for ($i =1; $i<=10; $i++){
		    echo "<tr>";
		    for ($j = 1; $j<=10; $j++){
		        $color =dameColorIncrementado($rojo,$verde,$azul);
		        echo "<td style=\"background-color:$color; height:40px; width:40px\"></td>";
		    }
		    echo "</tr>";
		}
        ?>
        </table>
		 </div>
	</div>
	</div>
<hr>
<?php show_source(__FILE__); ?>
<hr>
</body>
</html>
