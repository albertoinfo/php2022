<html>
<head>
<title>PHP: Listado de Directorios</title>
</head>
<body>
<?php
define('DIRECTORIO', '/home/alberto'); // Define el directorio que se va a procesar

if (! is_dir(DIRECTORIO)) // Comprueba que realmente existe el directorio
    die("No existe el directorio " . DIRECTORIO);

// Abrimos el directorio
$dir_cursor = @opendir(DIRECTORIO) or die("Error al abrir el directorio");
// Mostramos cada entrada del directorio

echo "<table border=1>";
echo "<tr><th>Nombre</th><th>Tamaño</th></tr>";
$entrada = readdir($dir_cursor); // lee primera entrada
while ($entrada !== false) // mientras haya datos
{
    if (is_file(DIRECTORIO . "/" .$entrada)) {
        $tamaño = filesize(DIRECTORIO . "/" . $entrada);
        echo "<tr><td> $entrada</td><td> : $tamaño </td></tr>";
    } else{
        echo "<tr><td> $entrada</td><td> Directorio </td></tr>";
    }
        
    $entrada = readdir($dir_cursor); // lee siguiente entrada
}
echo "</table>";

closedir($dir_cursor); // cerramos el directorio
?>
</body>
</html>