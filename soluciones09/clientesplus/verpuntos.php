<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link href="default.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="container" style="width: 380px;">
<div id="header">
<h1>CLIENTESPLUS</h1>
</div>
<div id="content">
<?php
if (isset ($_POST['puntos']) && is_numeric($_POST['puntos'])){
    $puntos= $_POST['puntos'];
} else {
    echo " Introduzca un valor de puntos correcto.<br>";
    exit();
}

$conex = new mysqli("localhost", "root", "root", "telefonia"); // Abre una conexión
if ($conex->connect_errno) {
    // Comprueba conexión
    printf("Conexión fallida: %s\n", mysqli_connect_error());
    exit();
}
$conex->set_charset("utf8");
$stmt = $conex->prepare("SELECT * FROM clientes WHERE puntos >= ?");
$puntos= $conex->escape_string($puntos); // No es necesario
$stmt->bind_param("i",$puntos);

$stmt->execute();
$result = $stmt->get_result();
if ( $result ){
    if ($result->num_rows > 0){
    echo "</table>";
    echo "<hr>";
    echo "<table border=1><th>Teléfono</th><th>Nombre</th><th>Puntos</tr>";
    while ( $fila = $result->fetch_array() ) {
        echo "<tr>";
        echo "<td>$fila[0]</td>";
        echo "<td>$fila[1]</td>";
        echo "<td>$fila[2]</td>";
        echo "</tr>";
    }
    echo "</table>";   
    } else {
        echo " No se encuentran clientes con esos puntos.<br>";
    }
}
?>
</div>
</div>
</body>
</html>




