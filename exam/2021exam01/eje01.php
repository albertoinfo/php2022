<?php
function unir ($claves, $valores):array{
    //return array_combine($claves, $valores);
    $nuevo = [];
    for ( $i=0; $i < count($claves); $i++){
        $nuevo[$claves[$i]] = $valores[$i];
    }
    return $nuevo;
}

function separar ($tabla){
    $nuevo = [];
    //$nuevo[0] =  array_keys($tabla);
    //$nuevo[1] =  array_values($tabla);
    foreach ( $tabla as $clave => $valor){
       $nuevo[0][]=$clave;
       $nuevo[1][]=$valor;
    }
    return $nuevo;
}

$nombres = ["Juan","Pedro","María","Elena","Luis"];
$notas  = [7.5, 6.0, 7.8, 9.5, 3.5 ];
// Une los array en uno nuevo
$calificaciones = unir ($nombres, $notas);
// Creo un nuevo array [0] las claves [1] las notas 
$datos = separar($calificaciones);
echo "<code><pre>";
print_r($calificaciones);
print_r($datos);
echo "</pre></code>";

