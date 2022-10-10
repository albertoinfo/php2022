<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link href="default.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<div id="container" style="width: 600px;">
		<div id="header">
			<h1>Procesando formulario</h1>
		</div>

		<div id="content">
		<?php 
		
		// Se declara una variable para cada campo del formulario y se inicializa a vacío
		$nombre= '';
		$clave= '';
		$semaforo= '';
		$publicidad= '';
		$tablaIdiomas= [];
		$anioFinEstudios= '';
		$codigosPostales= '';
		$comentarios= '';
		
		// Se captura cada campo proviniente del formulario, comprobando que contenga datos
		if (isset($_REQUEST['txtNombre'])) {
		    $nombre= $_REQUEST['txtNombre'];
		}
		if (isset($_REQUEST['pswClave'])) {
		    $clave= $_REQUEST['pswClave'];
		}	
		if (isset($_REQUEST['hdnOculto'])) {
		    $oculto= $_REQUEST['hdnOculto'];
		}	
		// Boton de radios
		if (isset($_REQUEST['rdSemaforo'])) {
		    $semaforo= $_REQUEST['rdSemaforo'];
		}
		// Boton de checkbox
		if (isset($_REQUEST['cbPublicidad'])) {
		    $publicidad= 'SI publicidad';
		} else {
		    $publicidad= 'NO publicidad';
		}
		// Array de checkbox
		if (isset($_REQUEST['cbIdioma'])) {
		    $tablaIdiomas = $_REQUEST['cbIdioma'];
		    
		}
		if (isset($_REQUEST['selAnioFinEstudios'])) {
		    $anioFinEstudios= $_REQUEST['selAnioFinEstudios'];
		}
		
		if (isset($_REQUEST['selCodigosPostales'])) {
		    foreach ($_REQUEST['selCodigosPostales'] as $opcionSeleccionada) {
		        $codigosPostales.= $opcionSeleccionada . ' ';
		    }
		}
		 
		 if (!empty($_REQUEST['txaComentarios'])) {
		     $comentarios= $_REQUEST['txaComentarios'];
		 }
		 
		 
		 ?>

Nombre: <?php echo $nombre; ?> <br />
Clave: <?php echo $clave; ?> <br />
Semáforo: <?php echo $semaforo; ?> <br />
Publicidad: <?php echo $publicidad; ?> <br />
Idiomas: <?php 
    if ( count($tablaIdiomas) > 0){
        foreach ( $tablaIdiomas as $valor ){
        echo "$valor,";
        }
     }
     else {
         echo " Sin conocimiento de Idiomas ";
     }

 ?> <br />
Año de fin de estudios: <?php echo $anioFinEstudios; ?> <br />
Lista de los códigos postales de provincias: <?php echo $codigosPostales; ?> <br />
Comentarios: <?php echo $comentarios; ?> <br />

		</div>
	</div>
<hr>
<?php show_source(__FILE__); ?>
<hr>
</body>
</html>
