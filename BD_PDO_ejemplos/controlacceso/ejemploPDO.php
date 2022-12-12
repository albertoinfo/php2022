<?php
/*
Ejemplo de control de acceso consultando a una base de datos

*/
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
$hayerror=true;

if ( $_SERVER['REQUEST_METHOD'] == "POST"){
    
    try {
        $dsn = "mysql:host=localhost;dbname=Prueba";
        $dbh = new PDO($dsn, "root", "root");
        // $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e){
        echo "Error de conexión ".$e->getMessage();
        exit();
    }
    
    
    
    $login  = $_POST['login'];
    $passwd = $_POST['passwd'];
    
    
    // Sentencia preparada
    $stmt = $dbh->prepare("SELECT * FROM Users WHERE login = ? and passwd = ?");
    $stmt->bindValue(1,$login);
    $stmt->bindValue(2,$passwd);
    // Devuelvo una tabla asociativa
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    if ( $stmt->execute() ){
        if ( $fila = $stmt->fetch()) {
            //var_dump($fila);
            echo " $fila[Nombre]: Bienvenido al sistema <br>";
            echo " Has entrado $fila[accesos] veces <br>";
            $hayerror=false;
            $fila['accesos']++;
            $consulta = "UPDATE Users SET accesos = $fila[accesos]  where login ='$login'";
            // Consulta directa
            if ($dbh->exec($consulta) == 0){
                echo " ERROR UPDATE en la BD ".print_r($dbh->errorInfo())."<br>";
            }
        } else {
            echo "El identificador y/o la contraseña no son correctos.<br>";
                
        }
    } else {
        echo " ERROR de consulta a la BD ".print_r($dbh->errorInfo())."<br>";
    }
    
}
?>
<?php if  ( $_SERVER['REQUEST_METHOD'] == "GET" || $hayerror ): ?>
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
<?php endif ?>
</div>
</div>
</body>
</html>