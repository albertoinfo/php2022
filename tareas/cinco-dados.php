<?php
/**
 * Cinco dados - cinco-dados.php
 *
 * @author Alberto López
 *
 */
define ('NUMDADOS',5);
// Caracteres UTF8( de dados 1 a 6)
$tcharDados = [ 1=> "&#9856;", 2=>"&#9857;",
                3=> "&#9858;", 4=>"&#9859;",
                5=>"&#9860;",  6=>"&#9861;"];



/* Funciones auxiliares */


function generarDados($numdados):array {
    $valores = []; 
    for ($i = 0; $i < $numdados; $i++){
        // Valores del dado
        $valores[]= random_int(1, 6);
    }
    
    return $valores;
}

function calcularPuntos($dados):int{
    $sum = 0;
    foreach ($dados as $valor ){
        $sum += $valor;
    }
    // Quito el valor máximo y mínimo
    $sum = $sum - max($dados)- min($dados);
    return $sum;
}

function generarMensajeGanador ($puntos1,$puntos2):string {
    $msg = "";
    if ($puntos1 == $puntos2){
        $msg = " Han empatado los jugadores";
    } else {
        if ($puntos1 > $puntos2){
            $msg = " Ha Ganado el Jugador 1";
        } else {
            $msg = " Ha Ganado el Jugador 2";
        }
    }
    return $msg;
}

function generarImagenes ( $dados): string{
    $msg ="";
    global $tcharDados;
    foreach ($dados as $valor ){
        $msg .= "<span style='font-size:100px;'>".$tcharDados[$valor]."</span>";
    }
    return $msg;
}

/* Programa principal */

$dadosJugador1 = generarDados(NUMDADOS);
$dadosJugador2 = generarDados(NUMDADOS);
$puntosJugado1 = calcularPuntos($dadosJugador1);
$puntosJugado2 = calcularPuntos($dadosJugador2);
$msgGanador    = generarMensajeGanador($puntosJugado1,$puntosJugado2);

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Cinco dados.
    
  </title>
  
</head>

<body>
  <h1>Cinco dados</h1>

  <p>Actualice la página para mostrar una nueva tirada.</p>


  <table>
    <tbody>
      <tr>
        <th>Jugador 1</th>
        <td style="padding: 10px; background-color: red;">
          <?php echo generarImagenes($dadosJugador1);?>
          
        </td>
        <th> <?= $puntosJugado1; ?> puntos</th>
      </tr>
      <tr>
        <th>Jugador 2</th>
        <td style="padding: 10px; background-color: blue;">
           <?=generarImagenes($dadosJugador2);?>
          
        </td>
        <th> <?= $puntosJugado2 ?> puntos</th>
      </tr>
      <tr>
        <th>Resultado</th>
        <td><?= $msgGanador ?></td>
      </tr>
    </tbody>
  </table>

  <footer>
    <p>Escriba aquí su nombre</p>
  </footer>
</body>
</html>
