<html>
  <head>
    <meta charset="UTF-8">
</head>
<body>  
<h1>Ejercicio 1</h1>
<hr> 
<?php

$n1 =  random_int(1,10);
$n2 =  random_int(1,10);
echo "Suma: $n1 + $n2 = ".          ($n1+$n2)."<br/>";
echo "Resta: $n1 - $n2 = ".         ($n1-$n2)."<br/>";
echo "Multiplicación: $n1 * $n2 = ".($n1*$n2)."<br/>";
echo "División: $n1 / $n2 = ".      ($n1/$n2)."<br/>";
echo "Módulo: $n1 % $n2 = ".        ($n1%$n2)."<br/>";
echo "Potencia: $n1 ** $n2 = ".     ($n1**$n2)."<br/>";
//Calculando la potencia en de forma manual
$n3 = 1;
for($i = 0;$i < $n2;$i++){
    $n3 = $n1 * $n3;
}
?>
<hr>
<?php show_source(__FILE__); ?>
<hr>
</body>
</html>
