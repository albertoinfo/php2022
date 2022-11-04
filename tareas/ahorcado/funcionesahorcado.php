<?php


/*
 *  Devuelve una palabra al azar del array de palabras
 */
function elegirPalabra(){
    static $tpalabras = ["madrid","sevilla","murcia","malaga","mallorca","menorca"];
   
   return $tpalabras[array_rand($tpalabras)]; 
}

/*
 * Devuelve true o false si la letra se encuentra en la cadena
 */
function comprobarLetra($letra,$cadena){
    $letramin = strtolower($letra[0]);
    return !( strpos ( $cadena , $letramin ) === false ); 
}

/*
 * Devuelve una cadena donde aparecen las letras de la cadenapalabra en su posición si
 * cada letra se encuentra en la cadenaletras
 * 
 * Ej  generaPalabraconHuecos("aeiou"    ,"hola pepe") -->"-o-a--e-e"
 *     generaPalabraconHuecos("abcdefghi ","hola pepe") -->"h--a -e-e"
 * 
 */


function generaPalabraconHuecos ( $cadenaletras, $cadenapalabra) {
    
    // Genero una cadena resultado inicialmente con todas las posiciones con -
    $resu = $cadenapalabra;
    for ($i = 0; $i<strlen($resu); $i++){
        $resu[$i] = '-';
    }
    // Rellenar la cadena resu
    
    for ($i = 0; $i<strlen($cadenapalabra); $i++){
        
        if ( strpos ($cadenaletras,$cadenapalabra[$i]) !== false){
            $resu[$i]= $cadenapalabra[$i];
        }
    }
    return $resu;
}
