<html>
<head>
<meta charset="UTF-8">
<title>GESTIÓN DE PEDIDOS </title>
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
<h1>CONSULTA Y PROCESAMENTO DE PEDIDOS </h1>
<form  name="consulta2"  method="POST" >
Indicar el código de cliente:<input type="text" name="cliente_no" size=8><br>
</form>
<?php 
include_once('AccesoDatos2.php');

session_start();

$db = AccesoDatos2::initModelo();
// Ver los pedidos 
if (!empty($_POST['cliente_no']) && empty($_POST['procesar'])){
    $cliente_no = $_POST['cliente_no'];
    if (!$db->checkCliente($cliente_no)){
        echo "ERROR: El código de cliente no existe.</body></html>";
        exit;
    }
    // Lo guardo en la sesion para poder procesarlo
    $_SESSION['cliente_no']=$cliente_no;
    
    echo " <h2> Pedidos disponibles para entregar </h2> ";
    $tabla1 = $db->consultaPedidosDisponibles($cliente_no);
    verresu($tabla1);
    echo " <h2> Pedidos pendientes </h2> ";
    $tabla2 = $db->consultaPedidosPedientes($cliente_no);
    verresu($tabla2);
    ?>
    <br>
    <form name="procesar" method="POST">
    <input type="submit" name="procesar" value=" Procesar Pedidos ">
    <input type="button" name="cancel"   value="Cancelar" onClick="window.location.href = './consultapedidos.php';" />
	</form>
    <?php      
}
if (!empty($_POST['procesar'])){
    $cliente_no = $_SESSION['cliente_no'];
    // Deberia procesarse en una transacción o bloqueo
    $db->bloquear();
    // Lista de posible pedidos
    $tabladisponibles = $db->consultaPedidosDisponibles($cliente_no);
    // Lista de pedidos procesados (Stock decrementado en Producto)
    $tablaprocesados  = $db->actualizarProductos($tabladisponibles);
    $num = $db->borrarPedidosDisponibles($tablaprocesados);
    $db->desbloquear();
    echo "Se han procesado $num pedidos. </body></html>";
    session_destroy();
}


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






