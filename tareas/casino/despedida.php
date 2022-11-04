<html>
<head>
<meta charset="UTF-8">
<title>Minicasino</title>
</head>
<body>
<p><?= $msg ?> </p>
<p>
 Muchas gracias por jugar con nosotros. <br> 
 Su resultado final es de <?= $_SESSION['disponible'] ?> Euros <br>
 <input type="button" value="  VOLVER A JUGAR " onclick="location.href='<?=$_SERVER['PHP_SELF'];?>'" >
</p>
</body>
</html>
        
