<html>
<head>
<meta charset="UTF-8">
<title>Ejercicio 2 Funciones</title>
</head>
<body>
<?php

function calSuma($valor1, $valor2)
{
    $resultado = $valor1 + $valor2;
    return $resultado;
}

function calResta($valor1, $valor2)
{
    $resultado = $valor1 - $valor2;
    return $resultado;
}

function calMulti($valor1, $valor2)
{
    $resultado = $valor1 * $valor2;
    return $resultado;
}

function calDivi($valor1, $valor2)
{
    $resultado = $valor1 / $valor2;
    return $resultado;
}

function calModulo($valor1, $valor2)
{
    $resultado = $valor1 % $valor2;
    return $resultado;
}

function calPotencia($valor1, $valor2)
{
    
    $resultado = $valor1 ** $valor2;
    return $resultado;
}
$n1 = rand(1, 10);
$n2 = rand(1, 10);
echo "1º Número: $n1</br>";
echo "2º Número : $n2</br>";
echo "$n1 + $n2 = " . (calSuma($n1, $n2)) . "</br>";
echo "$n1 - $n2 = " . (calResta($n1, $n2)) . "</br>";
echo "$n1 * $n2 = " . (calMulti($n1, $n2)) . "</br>";
echo "$n1 / $n2 = " . (calDivi($n1, $n2)) . "</br>";
echo "$n1 % $n2 = " . (calModulo($n1, $n2)) . "</br>";
echo "$n1<sup>$n2</sup> = " . (calPotencia($n1, $n2)) . "</br>";

?>
<hr>
<?php show_source(__FILE__); ?>
<hr>
</body>
</html>
