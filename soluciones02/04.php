<html>
<head>
<meta charset="UTF-8">
<title>Ejercicio 4º (Máximo, Mínimo)</title>
<style>
    table,th,td{
       border:1px solid black;
       border-collapse:collapse;
    }
    th{
        color:white;
        background-color:black;
        text-align: center;
        padding-left:30px;
        padding-right:30px;
        
    }
    .izq{
        text-align:left;
    }
    .der{
        text-align:right;
    }
</style>
</head>
<body>
<?php

define('CANTIDAD', 50);
define('VALORMAX',100);

$numero=random_int(1,VALORMAX);
// Máximo y mínimo provisionales
$minimo=$numero;
$maximo=$numero;
$suma=$numero;

for($i=1; $i<CANTIDAD; $i++){
    $numero=random_int(1,VALORMAX);

    if($numero>$maximo){
        $maximo=$numero;
    }
    if($numero<$minimo){
        $minimo=$numero;
    }
    $suma+=$numero;
}
$media=$suma/CANTIDAD;

   echo <<<FOO
   <table> 
      <tr>
          <th colspan = "2">Generación de 50 valores aleatorios</th>
      </tr>
      <tr>
          <td class="izq">Mínimo</td>
          <td class="der">$minimo</td>
      </tr>
      <tr>
          <td class="izq">Máximo</td>
          <td class="der">$maximo</td>
      </tr>
      <tr>
          <td class="izq">Media</td>
          <td class="der">$media</td>
      </tr>      
   </table>
FOO;
?>
<hr>
<?php show_source(__FILE__); ?>
<hr>
</body>
</html>
