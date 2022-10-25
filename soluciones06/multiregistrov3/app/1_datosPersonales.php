<html>
<head>
<meta charset="UTF-8">
<title>EJERMPLO FORMULARIO Y PROCESAMIENTO</title>
</head>
<body>
<?php echo pintaBarraNavegacion($_SESSION['paso']);?>
<form method="post" action="index.php">
<fieldset>
	<legend>Datos personales</legend>		
	Nombre <input name="nombre" id="nombre" value="<?php echo $nombre; ?>" /><br>
	Apellidos <input name="apellidos" id="apellidos" value="<?php echo $apellidos; ?>" /> <br />
	Fecha de nacimiento <input type="date" name="fechaNacimiento" value="<?php echo $fechaNacimiento; ?>" /> <br />
	Género :
	<label> Mujer </label>
	<input type="radio" name="genero" value="Mujer"  <?= ($genero=='Mujer')?"checked= \"checked\"":""; ?> >
	<label> Hombre</label>
	<input type="radio" name="genero" value="Hombre" <?= ($genero=='Hombre')?"checked= \"checked\"":""; ?> >
	<label> Otro  </label>
	<input type="radio" name="genero" value="Otro"   <?= ($genero=='Otro')?"checked= \"checked\"":""; ?> >
	<br>
	<label>Casado o Pareja de hecho </label>
	<input type="checkbox" name="casado" value="SI" <?= ($casado == "SI")?"checked= \"checked\"":""; ?> />
	<label> Hijos </label>
	<input type="checkbox" name="hijos" value="SI"  <?= ($hijos == "SI")?"checked= \"checked\"":""; ?> />
	<br />
	<label>Nacionalidad</label><br> 
	<select name="nacionalidad[]" multiple="multiple" size="3">
     <option value="Española"   <?= in_array("Española"  ,$nacionalidad)?"selected=\"selected\"":""; ?>   >Española</option>
     <option value="Francesa"   <?= in_array("Francesa"  ,$nacionalidad)?"selected=\"selected\"":""; ?>   >Francesa</option>
     <option value="Italiana"   <?= in_array("Italiana"  ,$nacionalidad)?"selected=\"selected\"":""; ?>   >Italiana</option>
     <option value="Portuguesa" <?= in_array("Portuguesa",$nacionalidad)?"selected=\"selected\"":""; ?> >Portuguesa</option>
    </select>
	
	</fieldset>
<br>
<input type="submit"  name="Siguiente" value="Siguiente">
</form>
</body>
</html>
