<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>MiniBank</title>
</head>
<body>
<h2> Minibanco 1.0</h2>
<?php 
if (!empty($_GET['msg'])) echo "RESULTADO:". $_GET['msg']."<br>";
?>
<form action="minibancopro.php" method="POST">
<fieldset>
<legend>Operación a realizar</legend>
Importe: <input name="importe" type="number" focus><br>
<input type="submit" name="Orden" value="Ingreso">
<input type="submit" name="Orden" value="Reintegro">
<input type="submit" name="Orden" value="Ver Saldo">
<input type="submit" name="Orden" value="Terminar">
</fieldset>
</form>
</body>
</html>

