<?php
include_once 'Magic.php';

$objm = new Magic(10);
echo $objm;  

$objm->atributo1 = 10;
$objm->atributo2 = 23;
$objm->atributo23 = 10002; // No existe el atributo
echo "\n ".$objm->atributo1;
echo "\n <br> ".$objm->atributo2;
echo "\n <br> ".$objm->atributo23; 

echo $objm;
$objm->incrementa();
$objm->decrementa(334,"Hola"); // No existe el método
$objm->hacerAlgo();
echo $objm;