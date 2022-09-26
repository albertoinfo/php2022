<html>
<head>
<meta charset="UTF-8">
<title>Ejercicio 6.1º Generar Almenas</title>
</head>
<body>
<code>
<?php
$almenas = random_int(1, 10);
echo "$almenas <br/>";
for ($i = 0; $i < 3; $i ++) {
    if ($i == 2) {
        // La ultima almena tiene **** en vez de *****
        for ($m = 0; $m < $almenas - 1; $m ++) {
            echo "*****";
        }
        echo "****";
    } else {
        for ($h = 0; $h < $almenas; $h ++) {
            echo "****&nbsp";
        }
    }
    echo "<br/>";
}
?>
</code>
<hr>
<?php show_source(__FILE__); ?>
<hr>
</body>
</html>
