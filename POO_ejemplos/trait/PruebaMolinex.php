<?php

include_once 'Molinex.php';
include_once 'Canario.php';

$p1 = new Molinex(100);
$p1->setprecio(30);
$p1->encender();
echo $p1;

Canario::comoEsElCanto();

$c1 = new Canario("blanco");
$c1->setprecio(50);
echo $c1;
