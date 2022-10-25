<html>
<head>
<meta charset="UTF-8">
<title>EJERMPLO FORMULARIO Y PROCESAMIENTO</title>
</head>
<body>
<?php echo pintaBarraNavegacion($_SESSION['paso']);?>

<form method="post" action="index.php">
<fieldset>
<legend>Datos Bancarios</legend>
Cuenta Bancaria <input name="cuenta" type="text" value=<?=$cuenta;?> >
</fieldset>
<br>
<input type="submit" name="Anterior" value="Anterior">
<input type="submit"  name="Siguiente" value="Siguiente">
</form>
</body>
</html>
