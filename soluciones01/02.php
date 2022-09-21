<html>
	<head>
	<meta charset="UTF-8">
	</head>
	
	<body>
		<h1>Ejercicio 2</h1>
		<hr>
		<?php
			$num1 = random_int(1,9);
			echo "El número es : ", $num1, "<br>";
			for ($num2 = 0; $num2 <= $num1; $num2++) {
				for ($num3 = 1; $num3 <= $num2; $num3++){
					if($num2%2==0){
						echo '<span style="color: red;">'. $num2 .'</span>';
					}
					else{
						echo '<span style="color: blue;">'. $num2 .'</span>';
					}
				}
				echo "<br>";
			}
		?>

<hr>
<?php show_source(__FILE__); ?>
<hr>	
</body>
</html>
