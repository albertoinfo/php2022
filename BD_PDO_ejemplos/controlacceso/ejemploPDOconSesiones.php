<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link href="default.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="container" style="width: 400px;">
<div id="header">
<h1>ACCESO AL SISTEMA</h1>
</div>
<div id="content">

<?php

if ( isset($_SESSION['Nombre']) &&  $_SERVER['REQUEST_METHOD'] == "GET") {
    echo " $_SESSION[Nombre] Bienvenido al sistema <br>";
    echo " Has entrado $_SESSION[accesos] veces <br>";
    ?>
    <form method="POST">
     <input type="submit" name="orden" value="Salir">
    </form>
    </div>
    </body>
    </html>
    <?php
    exit();
}

// EJEMPLO DE CONEXIÓN A LA BASE DE DATOS
// Utilizando el interfaz PDO

if ( $_SERVER['REQUEST_METHOD'] == "POST"){

    if ($_POST['orden'] == "Salir"){
        session_destroy();
        header("refresh:0");
        exit();
    }
    
    try {
        $dsn = "mysql:host=localhost;dbname=Prueba";
        $dbh = new PDO($dsn, "root", "root");
        // $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e){
        echo "Error de conexión ".$e->getMessage();
        exit();
    }
    
    
    $login=   $_POST['login'];
    $passwd = $_POST['passwd'];
    
    // Sentencia preparada
    $stmt = $dbh->prepare("SELECT * FROM Users WHERE login = ? and passwd = ?");
    $stmt->bindValue(1,$login);
    $stmt->bindValue(2,$passwd);
    // Devuelvo una tabla asociativa
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    if ( $stmt->execute() ){
        if ( $fila = $stmt->fetch()) {
            $_SESSION['Nombre'] = $fila['Nombre'];
            $_SESSION['accesos'] =$fila['accesos'];
            $fila['accesos']++;
            $consulta = "UPDATE Users SET accesos = $fila[accesos] where login ='$_POST[login]'";
            // Consulta directa
            if ($dbh->exec($consulta) == 0){
                echo " ERROR UPDATE en la BD ".print_r($dbh->errorInfo())."<br>";
            } else {
                header("refresh:0");
            }

        } else {
            echo "El identificador y/o la contraseña no son correctos.<br>";
            // Incluir mejora bloqueo de cuenta tras 3 fallos consecutivos !!!
                
        }
    } else {
        echo " ERROR de consulta a la BD ".print_r($dbh->errorInfo())."<br>";
    }
    
}
?>
			<form name='entrada' method="POST" >
				<table  style="border: node; ">
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
		</div>
		<p>
	</div>
</body>
</html>