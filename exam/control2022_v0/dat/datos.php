<?php
define ('ROL_PROFESOR',100);
define ('ROL_ALUMNO',  101);

// Tabla de usuarios
// login => nombre, clave y rol

$usuarios=[
    200001 =>["Alberto López"   ,"123456"   ,ROL_PROFESOR],
    100001 =>["Ana Pérez"       ,"ana01"     ,ROL_ALUMNO],   
    100002 =>["Andrés Pío"      ,"andres2"  ,ROL_ALUMNO],    
    100003 =>["Julio García"    ,"julio3"   ,ROL_ALUMNO],
    100004 =>["María Goméz"     ,"maria4"   ,ROL_ALUMNO],
    100005 =>["Luisa Tortos"    ,"luis5"    ,ROL_ALUMNO],
];

$nombreModulos=[
    "Prog. Entorno Servidor",
    "Prog. Entorno Cliente ",
    "Despliegue de aplicaciones",
    "Diseño de interfaces Web"
];
// Tabla de notas
// Código =>  notas de las asignaturas
$notas = [
    "100001" =>[6.5, 8, 6.5,  9],
    "100002" =>[7.3, 6, 5.4,  1],
    "100003" =>[5.3, 2,   5,  8],
    "100004" =>[7.0, 6, 5.4, 10],
    "100005" =>[5.5, 4, 7.2,  9]    
];

