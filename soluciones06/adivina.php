<html>
<head>
<?php
session_start();
?>
<meta charset="UTF-8">
<title>Ejercicio Adivinar número </title>
</head>
<body>
<?php
define ('MAXINTENTOS',5);

if (!isset ($_SESSION['numeroOculto'])){
    $_SESSION['numeroOculto'] = random_int(1, 20);
    $_SESSION['intentos']     = 0;
    echo "<H1> !! BIENVENIDO !! </H1> ";
  }
  else {
      if ( isset ($_REQUEST['numeroUsuario'])){
          $numu = $_REQUEST['numeroUsuario'];
          $numx = $_SESSION['numeroOculto'];
          $_SESSION['intentos']++;        
          echo " INTENTOS =". $_SESSION['intentos'] ."<br> ";
          if ($numx == $numu){
              echo " Enhorabuena has acertado <br> ";
              session_destroy();
              echo " Se ha generando un nuevo número a adivinar ";
              header("Refresh:3");
              exit();
          } else 
              if ( $_SESSION['intentos'] >= MAXINTENTOS ){
               echo " Superado el número de intentos <br> ";
               session_destroy();
               echo " Se ha generando un nuevo número a adivinar ";
               header("Refresh:3");
               exit();
              }
              else if ( $numx > $numu){
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




    
