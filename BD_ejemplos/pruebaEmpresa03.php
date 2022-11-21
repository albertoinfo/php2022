<?php
echo " Conectando a la base de datos <br>";
$conex = new mysqli("localhost", "root", "root", "Empresa"); // Abre una conexión
if ($conex->connect_errno) {
    // Comprueba conexión
    printf("Conexión fallida: %s\n", mysqli_connect_error());
    exit();
}

//SELECT NombreProducto, Precio FROM Productos
// WHERE Precio > (SELECT AVG (Precio) FROM Productos);

$query = "SELECT VENDEDOR_NO, APELLIDO , count(CLIENTE_NO) FROM CLIENTES, EMPLEADOS ".
        " WHERE VENDEDOR_NO = EMP_NO group by VENDEDOR_NO ";
if ($result = $conex->query( $query)) {
    
    // Array Asociativo por nombre de campo
    echo "<table border=1><th>Nº VENDEDOR</th><th>APELLIDOS</th><th>Nº DE CLIENTES</th></tr>";
    while ( $fila = $result->fetch_row()) {
        echo "<tr>";
        foreach ($fila as $valor) {
            echo "<td>$valor</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
    $result->close();
} else {
    echo " Error en la consultar $conex->error ";
}
$conex->close();



