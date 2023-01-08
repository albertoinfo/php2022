<?php  

include_once('AccesoDatos.php');

$db = AccesoDatos::initModelo();
$tclientes = $db->consulta0();
?>
<html>
<head
<meta charset="UTF-8">
<title>CONSULTAS A EMPRESA </title>
<style>
table {
  border-collapse: collapse;
}
table, td, th {
  border: 1px solid black;
}
</style>
</head>
<body>
<h1> Seleccionar consulta:</h1>
<form  name="consulta"  method="POST" >
<input type="radio" name="consulta" value="1" checked="checked"   >
Mostrar productos con precio superior 
<input type="number" name="precio"  value=0 size=10> ordenado por descripción.<br>
<input type="radio" name="consulta" value="2" >
Mostrar Total de pedidos y unidades pedidas por producto.<br>
<input type="radio" name="consulta" value="3" >
Mostrar el departamento con mayor número de empleados.<br>
<input type="radio" name="consulta" value="4" >
Mostrar Código y apellido de TODOS los empleados y ciudad donde trabajan.<br>
<input type="radio" name="consulta" value="5" >
Mostrar productos no pedidos por el cliente.
<select name="cliente">
<?php   foreach ($tclientes as $cliente): ?>
<option value="<?=$cliente['CLIENTE_NO']?>"
<?= (isset($_POST['cliente']) && $_POST['cliente'] == $cliente['CLIENTE_NO'])?"selected":"" ?>>
 <?=$cliente['NOMBRE'] ?></option>
<?php endforeach; ?>
</select>

<br>
<input type="submit" value=" PROCESAR ">
</form>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
   
    switch ($_REQUEST['consulta']){
        case 1:verresu($db->consulta1(intval($_POST['precio'])));break;
        case 2:verresu($db->consulta2());break;
        case 3:verresu($db->consulta3());break;
        case 4:verresu($db->consulta4());break;
        case 5:verresu($db->consulta5(intval($_POST['cliente'])));break;
    }
}
// Muestra una tabla con el resultado de cualquier consulta
// que devuelva una tabla asociativa

function verresu ( $datos){
    
    if ( count($datos) == 0){
        echo "<br>No hay resultados disponibles.<br>";
        return;   
    }
    
    echo "<table>";
    $cabecera=false;
    foreach ($datos as $fila){
        // Genero los campos de la caberas de la tabla
        if (!$cabecera){
            echo "<tr>";
            foreach($fila as $clave => $valor){
                echo "<th> $clave </th>";
            }
            echo "</tr>";
            $cabecera=true;
        }
        echo "<tr>";
        foreach($fila as $valor){
            echo "<td> $valor </td>";
        }
        echo "</tr>";
    }
    echo "</table>";
 }


?>

</body>
</html>