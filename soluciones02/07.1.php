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
		
		function dameColor(){
		    $ncolor = random_int(1, 5);
		    $svalor="white";
		    switch ( $ncolor){
		        case 1: $svalor ="red";break;
		        case 2: $svalor ="blue";break;
		        case 3: $svalor ="green";break;
		        case 4: $svalor ="black";break;
		    }
		  	   
		   return $svalor;
		}
		for ($i =1; $i<=10; $i++){
		    echo "<tr>";
		    for ($j = 1; $j<=10; $j++){
		        $color =dameColor();
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
