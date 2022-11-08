<?php

/*
 * Función de ordenación definida
 */
function ordenporTamaño($a, $b)
{
    return $a[2] - $b[2];
}

/*
 * Devuelve un array [nombre , tipo, tamaño ]
 */
function infoDir($dir):array
{
    $resu = [];
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
            $nombreyruta = $dir . "/" . $file;
            $resu[] = [
                $file,
                mime_content_type($nombreyruta),
                filesize($nombreyruta)
            ];
        }
        closedir($dh);
        // Ordenar de paso la función de comparación.
        usort($resu, 'ordenporTamaño');
    }
    return $resu;
}

?>


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
</head>
<body>
	<H1>MOSTRAR DIRECTORIO</H1>
<?php


if (isset($_GET['directorio'])) {
    if (is_dir($_GET['directorio'])) {
        $tablafichero = infoDir($_GET['directorio']);
        echo "<table border=1><th>Nombre</th><th>Tipo</th><th style='text-align:right'>Tamaño</th>";
        foreach ($tablafichero as $datosf) {
            echo "<tr><td> $datosf[0] </td><td>" . $datosf[1] . "</td><td style='text-align:right'>" . $datosf[2] . "</td> </tr>";
        }
        echo "</table>";
    } else {
        echo " Error " . $_GET['directorio'] . " nombre de directorio erróneo.";
    }
} else {
    ?>
<form>
 Directorio <input type="text" name="directorio">
</form>

<?php
}
?>
</body>
</html>

