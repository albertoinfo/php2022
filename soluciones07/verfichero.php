<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
</head>
<body>
<H1>MOSTRAR FICHERO</H1>
<?php
if (isset($_GET['fichero'])) {
    if (is_file($_GET['fichero']) && is_readable($_GET['fichero']) ) {
        $contcar = 0;
        $líneas = file($_GET['fichero']);
        echo "<code><pre>";
        // Recorro el array su clave por defecto es el indice del array
        // empezando por 0
        foreach ($líneas as $num_línea => $línea) {
            echo  sprintf("%4d :",($num_línea +1));
            // Escapar a las marcas html
            echo htmlspecialchars($línea);
            $contcar += strlen($línea);
        }
        echo "</pre></code>";
        echo " Número de líneas     = ".count($líneas)." <br>";
        echo " Número de caracteres = $contcar <br>"; 
        
    } else {
        echo " Error : El fichero ".$_GET['fichero']." no existe o no tiene permisos de lectura.";
    }
} else {
    ?>
<form>
Fichero a mostrar: <input type="text" name="fichero">
</form>

<?php
}
?>
</body>
</html>

