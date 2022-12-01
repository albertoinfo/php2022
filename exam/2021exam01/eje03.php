<?php

// Valor del cookie
$tfrutas = "";
if (isset($_COOKIE["galletadefrutas"])){
  $tfrutas = $_COOKIE['galletadefrutas'];
}

// Nuevo valor a asignar
if (isset($_GET["orden"])){
  $tfrutasnuevas = "" ;
  if ( ! empty($_GET['listafrutas'])){
  foreach ($_GET['listafrutas'] as $fruta ){
    $tfrutasnuevas .=",".$fruta;
   }
  }
  setcookie("galletadefrutas",$tfrutasnuevas);
  $tfrutas = $tfrutasnuevas;
}

function sele($fruta){
  global $tfrutas;
  if ( strstr($tfrutas,$fruta) !== false){
    return " selected ";
  }
  return "";

}


?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title> las frutas </title>
</head>
<body>
<form>
<fieldset>
  <legend>Sus frutas preferidas </legend>
    <label for="nombre">Lista de frutas:</label><br>
    <select name="listafrutas[]" multiple >
        <option value="Platano" <?= sele("Platano") ?> >Platano</option>
        <option value="fresa"   <?= sele("fresa")   ?> >fresa</option>
        <option value="Naranja" <?= sele("Naranja")  ?> >Naranja</option>
        <option value="Melón"   <?= sele("Melón")   ?> >Melón</option>
        <option value="Manzana" <?= sele("Manzana") ?> >Manzana</option>
    </select>
    <input type="submit" name="orden" value=" Cambiar ">
</fieldset>
</form>
</body>
</html>