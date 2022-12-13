<?php
/*
Ejemplo de control de acceso consultando a una base de datos

- Manejando la sesión para conectar y desconectar
- Utilizando un timeout para desconectarse a los 60 sg.
- Bloqueando al usuarios si hay más de tres intentos sucesivos
con el mismo usuario.

*/

session_start();

// Control de tiempo de la sesión 
if (isset($_SESSION['timeout'])) {
    $horaActual = time();
    // Si han pasado 60 sg cierra la sesión
    if (($horaActual - $_SESSION['timeout']) > 60) {
        session_destroy();
        header("refresh:0");
        exit();
    }
}



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

// Proceso el formulario
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if ($_POST['orden'] == "Salir") {
        session_destroy();
        header("refresh:0");
        exit();
    }

    try {
        $dsn = "mysql:host=localhost;dbname=Prueba";
        $dbh = new PDO($dsn, "root", "root");
        // $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error de conexión " . $e->getMessage();
            exit();
        }

    $hayerror = true;
    $login =  $_POST['login'];
    $passwd = $_POST['passwd'];

    // Sentencia preparada
    $stmt = $dbh->prepare("SELECT * FROM Users WHERE login = :login");
    $stmt->bindValue(':login', $login);
    // Devuelvo una tabla asociativa
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    if ($stmt->execute()) {
        if ($fila = $stmt->fetch()) {
            // Si la password es correcta
            if ($passwd == $fila['passwd']) {
                unset($_SESSION['NombreError']); // No hay usuario con error
                if ($fila['bloqueo'] == 0) {
                    $_SESSION['Nombre'] = $fila['Nombre'];
                    $_SESSION['accesos'] = $fila['accesos'];
                    $fila['accesos']++;
                    $hayerror= false;
                    $consulta = "UPDATE Users SET accesos = $fila[accesos] where login ='$_POST[login]'";
                    // Consulta directa 
                        if ($dbh->exec($consulta) == 0) {
                                echo " ERROR UPDATE en la BD " . print_r($dbh->errorInfo()) . "<br>";
                            } else {
                                    header("refresh:0");
                            }
                } else {
                    echo " Lo sentimos la cuenta $login está bloqueada ";
                }
            // Login Ok password error
            } else {
            echo "El identificador y/o la contraseña no son correctos**.<br>";
            // Si ha fallado en el mismo usuario 
            if (isset($_SESSION['NombreError']) && $_SESSION['NombreError'] == $login) {
                $_SESSION['errorPassword']++;
                if ($_SESSION['errorPassword'] > 3) {
                    $stmt = $dbh->prepare("UPDATE Users SET bloqueo = 1 where login =:login");
                    $stmt->bindValue(":login", $login);
                    $stmt->execute();
                    echo " la cuenta $login ha sido bloqueada pongase en contacto con el administrador.";
                }
                } else {
                    $_SESSION['NombreError'] = $login;
                    $_SESSION['errorPassword'] = 1;
                }
            }
        } else {
             echo "El identificador y/o la contraseña no son correctos.<br>";
        }
    } else {
        echo " ERROR de consulta a la BD " . print_r($dbh->errorInfo()) . "<br>";
    }
} // END POST
        

if  ( $_SERVER['REQUEST_METHOD'] == "GET" && isset($_SESSION['Nombre'])) {
    // Identificado 
        echo " $_SESSION[Nombre] Bienvenido al sistema <br>";
        echo " Has entrado $_SESSION[accesos] veces <br>";
        $_SESSION['timeout'] = time(); // Actualizo la temporización
        
        echo '<form method="POST">';
        echo '<input type="submit" name="orden" value="Salir">';
        echo  '</form>';
    } 

if  ( $_SERVER['REQUEST_METHOD'] == "GET" || $hayerror ) {
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
    <?php
}


?> 
</div>
</div>
</html>