<!-- VERSION DONDE TODO ESTÁ GENERADO POR EL SERVIDOR -->
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="refresh" content="2"/>
<style>

table, td, th {
	border: 0px;
}
</style>
</head>
<body>
<h1> CON PHP </h1>
   <?php
   $red = 	random_int(50,500);
   $green = random_int(50,500);
   $blue = 	random_int(50,500);
   ?>
    <table style="background-color:red">
		<tr>
			<td  width="<?= $red ?>px" height="40px"> &nbsp; Rojo(<?=$red?>)</td>
		</tr>
	</table>
   <table style="background-color:green">
		<tr>
			<td  width="<?= $green ?>px" height="40px"> &nbsp;Verde(<?=$green?>) </td>
		</tr>
	</table>	
	<table style="background-color:blue">
		<tr>
			<td  width="<?= $blue ?>px" height="40px"> &nbsp;Azul(<?=$blue?>) </td>
		</tr>
	</table>
   
<hr>
</body>
</html>
