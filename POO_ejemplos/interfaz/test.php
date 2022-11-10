<?php
require_once('Molino.php');
require_once('Batidora.php');

$represa= new Molino(3);
$mibatidora = new Batidora(500);

$represa->darpresion(10);

$represa->encender();
$mibatidora->encender();
echo " MOLINO : \n";
echo $represa->infoEstado();
echo " BATIDORA: \n";
echo $mibatidora->infoEstado();
