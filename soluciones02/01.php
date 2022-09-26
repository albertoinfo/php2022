<html>
<head>
<meta charset="UTF-8">
<title>Ejercicio 1º (El Mayor)</title>
</head>
<body>
<?php

// A y B por valor y $C por referencia
function elMayor($A, $B, &$C)
{
    if ($A > $B) {
        $C = $A;
    } else if ( $B > $A) {
        $C = $B;
    } else {
        $C = 0;
    }
}
$num1 = random_int(1, 10);
$num2 = random_int(1, 10);
$resu=3434; // Sin valor previo

elMayor($num1, $num2, $resu);

?>
1º Número es <?php echo $num1?><br/>
2º Número es <?php echo $num2?><br/>
El mayor es <?php echo $resu?><br/>
<hr>
<?php show_source(__FILE__); ?>
<hr>
</body>
</html>
