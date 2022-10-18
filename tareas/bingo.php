<?php
define('VACIO','X');
function generarCarton() {
$carton = [];
$columnas = [0,10,20,30,40,50,60,70,80];    // Columnas de fichas
$columnassimples = array_rand($columnas,3); // 3 Columnas tiene un solo valor y el resto 3 valores
$anterior1 = 0;
$anterior2 = 0;
for ( $ccol =0; $ccol <9 ; $ccol++){
      $valorescolumna = [];
      for ( $i=0; $i < 10; $i++){
          // Primera no tiene el 0 [1,2,3,4,5,6,7,8,9]
          if (( $i != 0) || ($ccol != 0)){
          $valorescolumna[]= $columnas[$ccol]+$i;
          }
      }
      // Ultima tiene el 90  [81,82..88,89,90]
      if ( $ccol == 8){ 
          $valorescolumna[] = 90;
      }
      // Si es una columna simple ?
      if ( in_array($ccol,$columnassimples) ){
        $anterior2 = 0;
        // Obtengo un valor aleatorio
        $valor = array_rand($valorescolumna);
        // Generar en distintas posiciones X00 0X0 00X pero sin esta filas iguales
        $anterior1 = ++$anterior1 % 3 +1; //Cambia 1,2,3,1,2,3 (No es aleatorio del todo se puede mejorar)
            switch ( $anterior1 ){
            case 1: $carton[$ccol]= [$valorescolumna[$valor],VACIO,VACIO];break;
            case 2: $carton[$ccol]= [VACIO,$valorescolumna[$valor],VACIO];break;
            case 3: $carton[$ccol]= [VACIO,VACIO,$valorescolumna[$valor]];break;
        }
        
            
      }
      else {
          $anterior1 = 0;
          // Es un columna con dos valores
          $valores = array_rand($valorescolumna,2);
          // Generar en distintas posiciones X0X XX0 0XX
          $anterior2 = ++$anterior2 % 3 +1; //Cambia 1,2,3,1,2,3 (No es aleatorio del todo se puede mejorar)
          switch ( $anterior2){
              case 1:$carton[$ccol] = [$valorescolumna[$valores[0]],VACIO, $valorescolumna[$valores[1]]];break;
              case 2:$carton[$ccol] = [VACIO, $valorescolumna[$valores[0]], $valorescolumna[$valores[1]]];break;
              case 3:$carton[$ccol] = [$valorescolumna[$valores[0]], $valorescolumna[$valores[1]],VACIO];break;
           }
          
       }
      
}
 return $carton;
}

// CHEQUEO QUE TODAS LAS FILAS TIENE 4 HUECOS / 5 VALORES
// Se ha probado que normalment en menos de 20 intentos se genera un carton válido
function testCarton ($carton){
    for($i=0;$i<3;$i++){
        $contvacios = 0;
        for ($j=0; $j<9; $j++){
            if ($carton[$j][$i] == VACIO){
                $contvacios++;
            }
        }
        if ($contvacios != 4 ){
            return false;
        } 
    }
    return true;
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<!--  Estilos del alumno Alberto Fernández-->
<style type="text/css">
table {
       font-family: arial; 
       font-size: 35px; 
       font-weight: bold; 
       color: rgb(0, 0, 120) ; 
       border: 5px double rgb(0, 0, 120); 
       border-collapse: collapse 
       }
#rellena { 
       text-align: center; 
       width:50px; 
       height:80px; 
       border:2px solid rgb(120, 120, 180); 
       background-color:rgb(230, 230, 255);
       }
       
#numerito {
       font-size: 10px;
       text-align:left; 
       margin-top: -14px; 
       margin-bottom: 14px;
       }

#vacia {
        text-align: center; 
        width:50px; 
        height:80px; 
        border:2px solid rgb(120, 120, 180); 
        background-color:rgb(170, 170, 205);
       }


       
       
</style>
<title>generador de cartones de Bingo 1.0</title>
</head>
<body>


<?php
//------------------------------------
// Hasta que el carton no sea correcto

do {
    // No es eficiente que se genere un nuevo carton cada vez
    $cartonnuevo = generarCarton();
    }
while ( !testCarton($cartonnuevo));

echo "<table>";
for ($i=0; $i < 3; $i++) {
    echo "<tr>";
    for ($j=0; $j < 9; $j++) {
        if ($cartonnuevo[$j][$i] !=VACIO ){
            // Los imprimo al reves por fila
            echo "<td id='rellena'><div id='numerito'>",$cartonnuevo[$j][$i],"</div>",$cartonnuevo[$j][$i], "</td>";
        }else{
            echo "<td id='vacia'></td>";
        }
    }
    echo "</tr>";
}
echo "</table>";
?>

</body>
</html>