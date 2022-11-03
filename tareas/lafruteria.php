<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>LA FRUTERIA</title>
</head>
<body>
<H1> La Frutería del siglo XXI</H1>
<?php
if ( isset($_GET['cliente'])){
    $_SESSION['cliente'] = $_GET['cliente'];
    $_SESSION['pedidos'] = [];
}


if ( isset($_POST["accion"])){
    
    if ( $_POST["accion"] == " Anotar " ){
        if ( isset ($_SESSION['pedidos'][$_POST['fruta']]) )
        $_SESSION['pedidos'][$_POST['fruta']] += $_POST['cantidad'];
        else {
        $_SESSION['pedidos'][$_POST['fruta']] = $_POST['cantidad'];
        }
    }
   
    echo "Este es su pedido :";
    echo "<table style='border: 1px solid black;'>";
    foreach ( $_SESSION['pedidos'] as $key => $value) {
    echo "<tr><td><b>".$key."</b><td></td><td>".$value."</td></tr>";
    }
    echo "</table>";
        
     if ( $_POST["accion"] == " Terminar " ){    
        ?>
        <br> Muchas gracias, por su pedido. <br><br>
        <input type="button" value=" NUEVO CLIENTE " onclick="location.href='<?=$_SERVER['PHP_SELF'];?>'">
        <?php 
        session_destroy();
        exit;
    }
    
}
if ( !isset ($_SESSION['cliente'])){ ?>
     <B>BIENVENIDO A LA NUESTRA FRUTERÍA DEL SIGLO XXI</B><br>
    <form action="<?=$_SERVER['PHP_SELF'];?>" method="get">
    Introduzca su nombre del cliente:<input name="cliente" type="text"> <br>
    </form> 
	<?php 
      
} else {
?>
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
<?php } ?>
   
