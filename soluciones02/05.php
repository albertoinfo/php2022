<html>
<head>
<meta charset="UTF-8">
<title>Ejercicio 5º Generar tablas </title>
</head>
<body>
<?php

function generarHTMLTable($filas, $columnas, $borde, $contenido)
{
    echo "<table style=\" border:$borde px solid black; border-collapse:collapse; \">";
    for ($i = 0; $i < $filas; $i ++) {
        echo "<tr  style='border:$borde' px solid black; border-collapse:collapse; \">";
        for ($j = 0; $j < $columnas; $j ++) {
            echo "<td style=\" border:$borde". "px solid black; border-collapse:collapse; \"> $contenido </td>";
        }
        echo "</tr>";   
    }
    echo "</table>";
}

?>

<?php generarHTMLTable(4,3,5,"Hola Mundo");?>
<hr>
<?php generarHTMLTable(2,6,2,"Hola de nuevo");?>
<hr>
<?php show_source(__FILE__); ?>
<hr>
</body>
</html>
