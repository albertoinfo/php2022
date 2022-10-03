<?php

// Caracteres asociadas a las logos 
// PIEDRA (Puño derecho)
// PIEDRA2 (Puño Izquierdo / jugador 2 ) 
define ('PIEDRA',   "&#x1F91C;");
define ('PIEDRA2',  "&#x1F91B;");
define ('TIJERAS',  "&#x1F596;");
define ('PAPEL',    "&#x1F91A;" );

// Tabla de mensajes en función del ganador
$msg = ["¡Empate !",
    " Ha ganado el jugador 1",
    " Ha ganado el jugador 2"];


/**
 *  Calcula el ganador 
 *  Parámetros: Dos valores PIEDRA, PAPEL O TIJERA
 *  Resultado: 0 (Empate),1 (1 Gana jugador 1), 2 (Gana jugador 2)   
 *  
 */

function calcularGanador (String $valor1, String $valor2): int{
    
    $ganador =0;
    
    if ( $valor1 == $valor2 ) return $ganador;
    
    switch ($valor1){
        case PIEDRA:  $ganador = ( $valor2 == TIJERAS)?1:2; break;
        case TIJERAS: $ganador = ( $valor2 == PAPEL  )?1:2; break;
        case PAPEL:   $ganador = ( $valor2 == PIEDRA )?1:2; break;
    }
    return $ganador;
}


$valores = [PIEDRA,TIJERAS,PAPEL];
$jugador1 = $valores[rand(0,2)];
$jugador2 = $valores[rand(0,2)];


?>

<html>
<head>
<title>Online PHP Script Execution</title>
</head>
<body>
<h1>¡Piedra, papel, tijera!</h1>

    <p>Actualice la página para mostrar otra partida.</p>

    <table>
      <tr>
        <th>Jugador 1</th>
        <th>Jugador 2</th>
      </tr>
      <tr>
        <td><span style="font-size: 7rem"><?= $jugador1; ?></span></td>
        <td><span style="font-size: 7rem"><?= ($jugador2 == PIEDRA)?PIEDRA2:$jugador2; ?></span></td>
      </tr>
      <tr>
        <th colspan="2"><?= $msg[calcularGanador($jugador1,$jugador2)] ?></th>
      </tr>
    </table>
</body>
</html>