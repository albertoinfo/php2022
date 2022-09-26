<html>
<head>
<meta charset="UTF-8">
<title>Ejercicio 3 Funciones (por referencia)</title>
</head>
<body>
<?php
require_once ("funcionesref.php");
$n1 = rand(1, 10);
$n2 = rand(1, 10);
echo "1º Número: $n1</br>";
echo "2º Número : $n2</br>";
$resu = 0;
calSuma($n1, $n2,$resu);
echo "$n1 + $n2 = " .$resu. "</br>";
calResta($n1, $n2,$resu);
echo "$n1 - $n2 = " . $resu . "</br>";
calMulti($n1, $n2,$resu);
echo "$n1 * $n2 = " . $resu . "</br>";
calDivi($n1, $n2,$resu);
echo "$n1 / $n2 = " . $resu . "</br>";
calModulo($n1, $n2,$resu);
echo "$n1 % $n2 = " . $resu . "</br>";
calPotencia($n1, $n2, $resu);
echo "$n1<sup>$n2</sup> = " . $resu . "</br>";
?>
<hr>
<?php show_source(__FILE__); ?>
<hr>
</body>
</html>
