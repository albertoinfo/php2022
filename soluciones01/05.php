<?php
$num1 = random_int(1, 10);
$num2 = random_int(1, 10);
?>
<html>
<head>
<meta charset="UTF-8">
<title>Ejercicio 05 - Tabla de operaciones</title>
<style>
table {
	border-collapse: collapse;
}

th, td {
	border: 1px solid black;
	padding: 8px;
}

tr:nth-child(even) {
	background-color: #f2f2f2;
}

th {
	background-color: #a8a8a8;
	color: white;
}
.izq{
        text-align:left;
    }
 .der{
        text-align:right;
    }
</style>
</head>

<body>
<h1>Ejercicio 5</h1>

1º Número : <?= $num1 ?></br>  
2º Número : <?= $num2 ?></br> 

<br>
		<table>
		<tr>
			<th style="color: blue;">Operación</th>
			<th style="color: blue;">Resultado</th>
		</tr>
		<tr>
			<td><?= $num1 ?> + <?= $num2 ?> </td>
			<td class="der"><?= $num1 + $num2 ?></td>
		</tr>
		<tr>
			<td><?=" $num1 -  $num2" ?></td>
			<td class="der"><?= $num1 - $num2 ?></td>
		</tr>
		<tr>
			<td><?=" $num1  *  $num2" ?></td>
			<td class="der"><?= $num1 * $num2 ?></td>
		</tr>
		<tr>
			<td><?=" $num1 /  $num2 " ?></td>
			<td class="der"><?= $num1 / $num2 ?></td>
		</tr>
		<tr>
			<td><?=" $num1  **  $num2 " ?> </td>
			<td class="der"><?= $num1 ** $num2 ?></td>
		</tr>
	</table>
<hr>
<?php show_source(__FILE__); ?>
<hr>
</body>
</html>
