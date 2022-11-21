<?php
include_once 'app/config.php';
include_once 'app/AccesoDatos.php';



// MUESTRA TODOS LOS USUARIOS
function mostrarDatos (){
    
    $titulos = [ "Nº","DESCRIPCIÓN","PRECIO","STOCK"];
    $msg = "<table>\n";
     // Identificador de la tabla
    $msg .= "<tr>";
    for ($j=0; $j < count($titulos); $j++){
        $msg .= "<th>$titulos[$j]</th>";
    }  
    $msg .= "</tr>";
    $auto = $_SERVER['PHP_SELF'];
    $db = AccesoDatos::getModelo();
    $tpro = $db->getProductos();
    foreach ($tpro as $pro) {
        $msg .= "<tr>";
        $msg .= "<td>$pro->PRODUCTO_NO</td>";
        $msg .= "<td>$pro->DESCRIPCION</td>";
        $msg .= "<td>$pro->PRECIO_ACTUAL</td>";
        $msg .= "<td>$pro->STOCK_DISPONIBLE</td>";
        $msg .="<td><a href=\"#\" onclick=\"confirmarBorrar('$pro->DESCRIPCION','$pro->PRODUCTO_NO');\" >Borrar</a></td>\n";
        $msg .="<td><a href=\"".$auto."?orden=Modificar&id=$pro->PRODUCTO_NO\">Modificar</a></td>\n";
        $msg .="<td><a href=\"".$auto."?orden=Detalles&id=$pro->PRODUCTO_NO\" >Detalles</a></td>\n";
        $msg .="</tr>\n";
        
    }
    $msg .= "</table>";
   
    return $msg;    
}

/*
 *  Funciones para limpiar la entreda de posibles inyecciones
 */

function limpiarEntrada(string $entrada):string{
    $salida = trim($entrada); // Elimina espacios antes y después de los datos
    $salida = strip_tags($salida); // Elimina marcas
    return $salida;
}
// Función para limpiar todos elementos de un array
function limpiarArrayEntrada(array &$entrada){
 
    foreach ($entrada as $key => $value ) {
        $entrada[$key] = limpiarEntrada($value);
    }
}

