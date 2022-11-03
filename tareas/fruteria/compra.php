<html>
<head>
<meta charset="UTF-8">
<title>Minicasino</title>
</head>
<body>
<H1> La Frutería del siglo XXI</H1>
<?=$compraRealizada ?>
<B><br> REALICE SU COMPRA  <?= $_SESSION['cliente']?></B><br>
     <form action="<?=$_SERVER['PHP_SELF'];?>" method="post">
     <b>Selecciona la fruta: <select name="fruta">
			<option value="Platanos">Platanos</option>
			<option value="Naranjas">Naranjas</option>
			<option value="Limones">Limones</option>
			<option value="Manzanas">Manzanas</option>
			</select>
     Cantidad: <input name="cantidad" type="number" value=0 size=4 >
     <input type="submit" name="accion" value=" Anotar ">	
     <input type="submit" name="accion" value=" Terminar ">	
   </form>
</body>
</html>