<?php
/*
 *  Ejemplo básico de consulta a la base de datos Empresa
 */
echo " Conectando a la base de datos <br>";
$conex = new mysqli("localhost", "root", "root", "Empresa"); // Abre una conexión
if (mysqli_connect_errno()) {
    // Comprueba conexión
    printf("Conexión fallida: %s\n", mysqli_connect_error());
    exit();
}
$query = "SELECT EMP_NO,APELLIDO FROM EMPLEADOS ORDER BY APELLIDO";
// Sí hay resultados
if ($result = $conex->query( $query)) {
    // Apunta a la primera fila, no es necesaria en este caso
    $result->data_seek(0);
    // Extrae fila apuntada y apunta a la siguiente
    // Obtiene un array asociativo
    while ( $fila = $result->fetch_assoc()) {
        // Muestra sus datos
        printf ("Nº: %s Apellido: %s <br>\n", $fila['EMP_NO'], $fila['APELLIDO'] );
    }
    $result->close(); // libera recursos de la consulta
}
$conex->close(); // cierra conexión
?>