<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<link href="web/default.css" rel="stylesheet" type="text/css" />
	<script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<body>
	<div id="container" style="width: 400px;">
		<div id="header">
			<h1>ACCESO AL SISTEMA</h1>
		</div>
		<div id="content">
			<?= $mensaje ?>
			<form name='entrada' method="POST">
				<table style="border: node; ">
					<tr>
						<td>identificador:</td>
						<td><input type="text" name="login" size="20"></td>
					</tr>
					<tr>
						<td>Contraseña:</td>
						<td><input type="password" name="passwd" size="20"></td>
					</tr>
				</table>
				<?php if ( isset($activarcaptcha ))  :?>
				<div class="g-recaptcha" data-sitekey="6Ldpv......"></div>
				<?php endif; ?>
				<input type="submit" name="orden" value="Entrar">
			</form>
		</div>
		<p>
	</div>
</body>

</html>