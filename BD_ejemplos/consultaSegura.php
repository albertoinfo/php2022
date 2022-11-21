<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link href="default.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<div id="container" style="width: 380px;">
		<div id="header">
			<h1>ACCESO AL SISTEMA</h1>
		</div>
		<div id="content">

<?php
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    // Muestro el formulario de acceso
    ?>   
  <form name='entrada' method="POST">
				<table style="border: node;">
					<tr>
						<td>identificador:</td>
						<td><input type="text" name="login" size="20"></td>
					</tr>
					<tr>
						<td>Contraseña:</td>
						<td><input type="password" name="passwd" size="20"></td>
					</tr>
				</table>
				<input type="submit" name="orden" value="Entrar">
			</form>   
<?php
} else { // Proceso los datos

    $conex = new mysqli("localhost", "root", "root", "Prueba"); // Abre una conexión
    if ($conex->connect_errno) {
        // Comprueba conexión
        printf("Conexión fallida: %s\n", mysqli_connect_error());
        exit();
    }

    $login = $_POST['login'];
    $passwd = $_POST['passwd'];
    // Sin filtro
    $query = "SELECT Nombre FROM Usuario WHERE login = '$login' and passwd = '$passwd'";
    echo "<br> $query <br>";
    
    // ERROR - POSIBLE INYECCIÓN DE CÓDIGO 
    ///////////////////////////////////////////////////////
    $result = $conex->query( $query);
    if ($fila = $result->fetch_assoc()) {
        echo " $fila[Nombre]: Bienvenido al sistema SIN SEGURIDAD <br>";
    } else {
        echo "El identificador y/o la contraseña no son correctos.<br>";
    }
    //////////////////////////////////////////////
    

    // 1º MEDIDA Filtrar: escapa caracteres peligrosos
    $login = $conex->escape_string($_POST['login']);
    $passwd = $conex->escape_string($_POST['passwd']);
    $query = "SELECT Nombre FROM Usuario WHERE login = '$login' and passwd = '$passwd'";
    echo "<br> $query <br>";

    // 2º MEDIDA Utilizar: Sentencia preparada
    $stmt = $conex->prepare("SELECT * FROM Usuario WHERE login = ? and passwd = ?");
    $stmt->bind_param("ss", $login, $passwd);

    $stmt->execute();
    if ($result = $stmt->get_result()) {
        // No uso un while por que lo normal es que haya una sola fila
        if ($fila = $result->fetch_assoc()) {
            echo " $fila[Nombre]: Bienvenido al sistema <br>";
        } else {
            echo "El identificador y/o la contraseña no son correctos.<br>";
        }
    } else {
        echo " ERROR de consulta a la BD " . $conex->error . "<br>";
    }
}

?>
</div>
		<p>
	
	</div>
</body>
</html>