<?php
/**
 *  TRES FORMAS DE LEER UN FICHERO
 */
// Leer un fichero linea a linea
define ('FICHERO','datos.txt');

$frecurso = @fopen(FICHERO,'r'); // OJO sin arroba Si hay fallo muestra avisos
if ( ! $frecurso ){
    die(" Fallo al abrir el fichero");
}

// Leo línea a linea 
echo "<b>1º forma : CLÁSICA</b><br>"; 
echo " Contenido del fichero ".FICHERO."<p> <pre>";
$nlinea = 1;
while ( $linea = fgets($frecurso)) {
      echo $nlinea.":".$linea;
      $nlinea++;
}
fclose($frecurso);
echo "</pre></p>";

// Leer todo de golpe y se almacenarlo en un array de cadenas
echo "<b>2º forma : file</b><br>"; 
$nlinea = 1;
$ficherolineas = file(FICHERO);
echo " Contenido del fichero ".FICHERO."<p> <pre>";
foreach ($ficherolineas as $linea) {
    echo $nlinea.":".$linea;
    $nlinea++;
}
echo "</pre></p>";

// Leer todo y se almacena en una cadena
echo "<b>3º forma : file_get_contents</b><br>";
$nlinea = 1;
$contenidofichero = file_get_contents(FICHERO);
echo " Contenido del fichero ".FICHERO."<p> <pre>";
echo $contenidofichero;
echo "</pre></p>";

