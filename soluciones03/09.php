<html>
<head>
<meta charset="UTF-8">
<title>Temperaturas</title>
<style type="text/css">
table, th, td {
	border: 1px solid black;
	border-collapse: collapse;
}
</style>
</head>
<?php
    $temperaturas =  [ 6, 10, 12, 14,16 ,20 ,25 , 30, 18, 15, 14, 8];
    $meses = ['enero','febrero', 'marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre']; 
    $mestemperaturas =[];
    //Creo el array asociativo  mes -> temperatura
    for ($i = 0; $i < count($meses); $i++) {
        $mestemperaturas[$meses[$i]] = $temperaturas[$i];
    }
    // Se puede hacer directamente con la función array_combine
    // $mestemperaturas = array_combine($meses, $temperaturas);
?>
<body>
<h1> Tabla de temperaturas </h1>
<table style='border: 1px solid black; border-collapse: collapse;'>
<?php     
    for ($i = 0; $i < count($meses); $i++) { ?>
    <tr><td> <?php echo $meses[$i]; ?></td><td>
    <?php 
        for ($j = 0; $j < $mestemperaturas[$meses[$i]]; $j++) {
            echo "<img src ='img/cuadro.png' style = width:2px;>";
        }
        echo  "  ".$mestemperaturas[$meses[$i]]. " ºC </td></tr>";
    } ?>
</table>
<hr>
<?php show_source(__FILE__); ?>
<hr>
</body>
</html>
