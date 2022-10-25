<html>
<head>
<meta charset="UTF-8">
<title>EJERMPLO FORMULARIO Y PROCESAMIENTO</title>
</head>
<body>
<?php echo pintaBarraNavegacion($_SESSION['paso']);?>
<h2> Valores recogidos </h2>
<?php
foreach ($_SESSION['valores'] as $clave => $valor){
    // Si el valor es un array no se puede convertir a String
    if (is_array($valor)){
        echo " $clave :[";
        foreach ($valor as $subvalor) {
            echo " $subvalor "; 
        }
        echo " ] <br> ";
    } 
    else{
    echo " $clave : $valor <br>";
    }
}
?>
<form action="index.php">
<input type="submit" name="Anterior" value="Anterior">
<input type="submit"  name="Terminar" value="Terminar">
</form>
</body>
</html>

