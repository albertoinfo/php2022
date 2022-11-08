<?php

// Devuelve true, si la cadena termina en final
function endsWith($cadena, $final)
{
    $length = strlen($final);
    return $length > 0 ? substr($cadena, -$length) === $final : true;
}



/*
 * Devuelve un array [nombre de ficheros php , nºlineas ]
 */
function analizaDir($dir): array
{
    $resu = [];
    if ($dh = opendir($dir)) {
        while (($fichero = readdir($dh)) !== false) {
            
            if (endsWith($fichero, ".php")) {
                // Obtengo un array del fichero y cuento las líneas
                $nombreyruta = $dir . "/" . $fichero;
                $arrayfile = @file($nombreyruta);
                // Cuenta los que no dan fallo            
                $nlineas = ($arrayfile)? count($arrayfile):0;
                $resu[] = [$fichero, $nlineas];
            }
        }
        closedir($dh);
    }
    return $resu;
}


$informe = "";

if (!empty($_GET['directorio'])) {
    if (is_dir($_GET['directorio'])) {
        $informe = " Ficheros del directorio ".$_GET['directorio']."<br>";
        $tablafichero = analizaDir($_GET['directorio']);
        if (count($tablafichero) == 0) {
            $informe .= " El directorio no contiene archivos .php ";
        } else {
            $total = 0;
            $informe .= "<table border=1><th>Nombre</th><th style='text-align:right'>Nº de líneas</th>";
            foreach ($tablafichero as $datosf) {
                $informe .= "<tr><td> $datosf[0] </td><td style='text-align:right'>" . $datosf[1] . "</td> </tr>";
                $total += $datosf[1];
            }
            $informe .= "<tr><td></td><td style='text-align:right'>" . $total . "</td> </tr>";
            $informe .= "</table>";
        }
    } else {
        $informe = " Error " . $_GET['directorio'] . " es un directorio erróneo.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
</head>

<body>
    <H1>ANALIZAR DIRECTORIO</H1>
    <?php if (!empty($_GET['directorio'])) : ?>
        <div> <?= $informe ?> </div>
    <?php else : ?>
        <form>
            Directorio a analizar: <input type="text" name="directorio">
        </form>
    <?php endif ?>
</body>

</html>