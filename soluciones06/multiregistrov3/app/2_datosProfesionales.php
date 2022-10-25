<html>
<head>
<meta charset="UTF-8">
<title>EJERMPLO FORMULARIO Y PROCESAMIENTO</title>
</head>
<body>
<?php echo pintaBarraNavegacion($_SESSION['paso']);?>

<form method="post" action="index.php">
<fieldset>
	<legend>Datos profesionales</legend>		
	Departamento <select name="departamento">
	<option value="Ventas"       <?= ($departamento =="Ventas")?"selected=\"selected\"":"" ?>>Ventas</option>
	<option value="Contabilidad" <?= ($departamento =="Contabilidad")?"selected=\"selected\"":"" ?>>Contabilidad</option>
	<option value="Informática"  <?= ($departamento =="Informática")?"selected=\"selected\"":"" ?>>Informática</option>
	<option value="Almacén"      <?= ($departamento =="Almacén")?"selected=\"selected\"":"" ?>>Almacén</option>
	</select>
	 <br />
	Salario <input name="salario" value="<?php echo $salario; ?>" /> <br />
    Comentarios <textarea name="comentarios" cols="40" rows="5"><?php echo $comentarios; ?></textarea> <br />
</fieldset>
<br>
<input type="submit" name="Anterior"  value="Anterior">
<input type="submit" name="Siguiente" value="Siguiente">
</form>
</body>
</html>
