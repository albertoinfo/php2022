<?php
// PARTE SERVIDOR SOLO GENERA DATOS
$red   = random_int(50,500);
$green = random_int(50,500);
$blue  = random_int(50,500);
$datos = [$red,$green,$blue];
header('Content-Type: application/json; charset=utf-8');
echo json_encode($datos);
?>