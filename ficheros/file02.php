<?php 
/*
 *  Añade datos recogidos por un formulario en un fichero 
 *  con formato: nombre | contraseña
 */
?>
<html>
<head>
<title>PHP: Añadir datos a Ficheros</title>
</head>
<body>
<?php

// El fichero tiene que tener permisos de escritura 
define("FICH_DATOS", 'usuarios.txt');

// Muestro el contenido del fichero, si no existe lo crea vacio
 if (!is_readable(FICH_DATOS) ){
     // El directorio donde se crea tiene que tener permisos adecuados
      $fich = @fopen(FICH_DATOS,"w") or die ("Error al crear el fichero.");
      fclose($fich);
 }


// Añado datos al fichero 
if ( $_SERVER['REQUEST_METHOD'] == 'POST') 
{
    // abrimos el fichero para añadir al final
  
    $cadena = $_POST['user'] . '|' . $_POST['clave'] . "\n";
    $ok = file_put_contents(FICH_DATOS, $cadena, FILE_APPEND);
    echo ($ok) ? "Datos añadidos al fichero" : "Error al añadir datos";
    
}

echo "<h2> Contenido del fichero: </h2>";
// Lee el fichero para mostrar su contenido con un array
 $filearray = file (FICH_DATOS);
 echo "<table border='1'>\n";
 echo "<tr><th>Usuario</th><th>Contraseña</th</tr>\n";
 foreach ($filearray as $linea) {
        $partes = explode('|', trim($linea));
        // "Limpiamos" la línea y la troceamos obtiendo sus componentes
        echo "<tr><td>$partes[0]</td><td>$partes[1]</td>"; // Escribimos la correspondiente fila de la tabla
 }
 
 echo "</table><br>\n";

?>
<h2> Introduzca más datos en el fichero:</h2>
<form  action="<?= $_SERVER['PHP_SELF']?>" method="POST">
Usuario:       <input type='text'     name='user' size='10' > &nbsp;
Contraseña   : <input type='password' name='clave' size='10' ><br>
<input type='submit' value='Enviar' >
</form>
</body>
</html>
