<!DOCTYPE unspecified PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
<meta charset="utf-8">
<link href="default.css" rel="stylesheet" type="text/css" />
</head>
<script>
// No se puede borrar con el reset si tiene value fijados 
function borrarvalores(){
    document.getElementsByName('num1').value = "";
    document.getElementsByName('num2').value = "";
}
</script>
<body>
	<div id="container" style="width: 400px;">
	<div id="header">
		<h1>Mini Calculadora</h1>
	</div>

	<div id="content">
	<form>
	<!--  Incluyo código PHP para conservar el valor recibido por en $_POST -->
	Nº1:<input type="text" name="num1" size=10 value="<?=isset($num1)?$num1:''?>"> 
	<br>
	Nº2:<input type="text" name="num2" size=10 value="<?=isset($num2)?$num2:''?>">
	<br>
	<fieldset>
	<button name='operacion' value='+'> +</button>
	<button name='operacion' value='-'> -</button>
	<button name='operacion' value='*'> *</button>
	<button name='operacion' value='/'> /</button>
	<button name='borrar' value="Borrar" onclick='borrarvalores()' >Borrar</button>
	</fieldset>
	<br>
	<fieldset>
	<!-- Por defecto es decimal -->
	<input type="radio" name="formato" value="dec" 
	    <?=(!isset($formato) || $formato =="dec")? "checked='checked'":""?> >Decimal 
	<input	type="radio" name="formato" value="bin"
	    <?=(isset($formato)  && $formato =="bin")? "checked='checked'":""?> >Binario 
	<input type="radio" name="formato" value="hex"
        <?=(isset($formato)  && $formato =="hex")? "checked='checked'":""?> >Hexadecimal<br>
	</fieldset>
	<input type="reset" value=" borrar con reset ">
	</form>
	<?= isset($msg)?$msg:""?><br>
</div>
</div>

</body>
</html>



