<html>
<head>
 <meta charset="UTF-8">
 <title>Ejercicio 03 - La pirámide</title>
<style>
</style>
</head>
<body>
<?php
   $numero =  random_int(1,9);
   $contEspacios = $numero -1;
   $contAsteriscos = 1;
   ?>
   <!-- Utilizo code para que sea monospace -->
   <code>
    <?php
   for($i = 1; $i <=$numero;$i++){
       for($j = 1; $j<=$contEspacios; $j++){
           echo "&nbsp"; // Caracter espacio en HTML
       }
       for($k = 1; $k<=$contAsteriscos;$k++){
           echo "*";
       }
       $contAsteriscos +=2;
       $contEspacios--;
       echo "<br/>";
       
   }
?>
</code>
<hr>
<?php show_source(__FILE__); ?>
<hr>
</body>
</html>
