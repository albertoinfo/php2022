<?php
session_start();
?>
<html>
<head>
<meta charset="UTF-8">
<title>Ejercicio Adivinar número </title>
</head>
<body>
<?php

if (!isset ($_SESSION['numeroOculto'])){
    $_SESSION['numeroOculto'] = random_int(1, 20);
    echo "<H1> !! BIENVENIDO !! </H1> ";
  }
  else {
      if ( isset ($_REQUEST['numeroUsuario'])){
          $numu = $_REQUEST['numeroUsuario'];
          $numx = $_SESSION['numeroOculto'];
          if ($numx == $numu){
              echo " Enhorabuena has acertado <br> ";
              session_destroy();
              echo " Se ha generando un nuevo número a adivinar ";
              header("Refresh:3");
              exit();
          } else 
               if ( $numx > $numu){
                  echo " No llegas <br> ";
                 } else {
                 echo " Te pasas <br> ";
                 }
          }          
      }
  
?>
<h2> Adivina un número entre 1 y 20 <h2>
<form method="get">
Introduce un número: <input name="numeroUsuario" type="number" size="5">
</form>




    
