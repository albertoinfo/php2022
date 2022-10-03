<html>
<head>
<meta charset="UTF-8">
<title>BONOLOTO</title>
</head>
<?php
// Relleno una tabla con valores de 1 a 49
$valores = [];
for ($i = 1; $i <= 49; $i ++) {
    $valores[] = $i;
}
// OBTENGO 5+1 INDICES ALEATORIOS ordenados de la tabla (OJO NO VALORES )
$indices = array_rand($valores, 6);

// Me quedo con los valores
// En este caso valores e indices es casi lo mismo $valor == $indice+1
$vbonoloto = [];
foreach ($indices as $i ) {
    $vbonoloto[] = $valores[$i];
}
// Obtengo el número complementario y lo elimino de la tabla
$icomplementario = random_int(0, 5);            // Posición
$complementario = $vbonoloto[$icomplementario]; // Valor
unset($vbonoloto[$icomplementario]);            // Elimino

?>
<body>
    <b>Sorteo del Bonoloto</b>
	<table border=1>
		<tr>
    <?php
    foreach ($vbonoloto as $num) {
        ?>
    <td><?php echo $num ?></td>
    <?php
    }
    ?>
    <td><?php echo "Complementario $complementario " ?></td>
		</tr>
	</table>
	<hr>
<?php show_source(__FILE__); ?>
<hr>
</body>
</html>