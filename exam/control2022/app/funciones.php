<?php
require_once ('dat/datos.php');
/**
 *  Devuelve true si el código del usuario y contraseña se 
 *  encuentra en la tabla de usuarios
 *  @param $login : Código de usuario
 *  @param $clave : Clave del usuario
 *  @return true o false
 */
function userOk($login,$clave):bool {
    global $usuarios;
    if ( key_exists($login,$usuarios)){
        return $usuarios[$login][1] == $clave;
    }
    return false;
}
/**
 *  Devuelve el rol asociado al usuario
 *  @param $login: código de usuario
 *  @return ROL_ALUMNO o ROL_PROFESOR
 */
function getUserRol($login){
    global $usuarios;
    return $usuarios[$login][2];
}


/**
 *  Muestra las notas del alumno indicado.
 *  @param $codigo: Código del usuario
 *  @return $devuelve una cadena con una tabla html con los resultados 
 */
function verNotasAlumno($codigo):String{
    $msg="";
    global $nombreModulos;
    global $notas;
    global $usuarios;

    if ( !key_exists($codigo,$notas) ){
        return " Sin Datos para el código ".$codigo;
    }

    $msg .= " Bienvenido/a alumno/a: ".$usuarios[$codigo][0];
    $notasAlumno = $notas[$codigo];
    $msg .= "<hr><table>";
    $msg .= "<th >Módulo </th><th> Nota </th>";
    
    for ($i =0; $i< count($nombreModulos); $i++) {
        $msg .="<tr>";
        $msg .="<td>".$nombreModulos[$i]."</td>";
        $msg .="<td>".$notasAlumno[$i]."</td>";
        $msg .= "</tr>";
    }
    $msg .= "</table>";
    return $msg;
}
/**
 *  Muestra las notas de todos alumnos. 
 *  @param $codigo: Código del profesor
 *  @return $devuelve una cadena con una tabla html con los resultados 
 */
function verNotaTodas ($codigo): String {
    $msg="";
    global $nombreModulos;
    global $notas;
    global $usuarios;
    $msg .= " Bienvenido Profesor: ".$usuarios[$codigo][0];
    $msg .= "<hr><table>";
    $msg .= "<th >Nombre </th>";
    foreach ($nombreModulos as $modulo) {
        $msg .="<th>$modulo</th>";
    }
    foreach ($notas as $codigo => $notasAlumno ){
        $msg .="<tr>";
        $msg .="<td>".$usuarios[$codigo][0]."</td>";
        foreach ($notasAlumno as $nota){
            $msg .="<td style='text-align: right;'>$nota</td>";
        }
        $msg .= "</tr>";
    }
    $msg .= "</table>";
    return $msg;
}