<?php
require_once('CuentaBancaria.php');
require_once('CuentaBancariaConCredito.php');

$cb = new CuentaBancaria(100);
$cc = new CuentaBancariaConCredito(100,0.5);
$aux = new CuentaBancariaConCredito();

unset($aux);

echo " Cuentas creadas".CuentaBancaria::totaldeCuentas()."\n";

$cb->ingreso(5);
$cc->ingreso(5);

echo $cb->consultarEstado()."\n";
echo $cc->consultarEstado()."\n";

$cb->abono(200); // Da error
$cc->abono(200); // Queda con saldo negativo con interés

echo $cb->consultarEstado()."\n";
echo $cc->consultarEstado()."\n";




