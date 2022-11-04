<html>
<head>
<meta charset="UTF-8">
<title>Minicasino</title>
</head>
<body>
<p><?= $msg ?> </p>
Dispone de  <?= $_SESSION["disponible"] ?> para jugar
<form method="POST">
Cantidad a apostar :<input name="cantidad" type="number"> <br>
Tipo de apuesta : 
<input  type="radio"   name="apuesta" value="PAR" checked='checked'> Par
<input  type="radio"   name="apuesta" value="IMPAR"> Impar <br>
<button name='apostar' value='apostar' > Apostar cantidad </button>
<button name='dejar'   value='dejar'   > Abandonar el Casino </button>
</form>
</body>
</html>


