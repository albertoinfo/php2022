<?php
$menuNavegacion = array(1 => array('index.php?nav=1', 'Number-1-icon.png', 'Datos personales'),
						2 => array('index.php?nav=2', 'Number-2-icon.png', 'Datos profesionales'),
						3 => array('index.php?nav=3', 'Number-3-icon.png', 'Datos bancarios'),
						4 => array('index.php?nav=4', 'checkered-flag-icon.png', 'Resumen')
					);

function pintaBarraNavegacion($pasoActivo) {
  global $menuNavegacion;	
  $salida = '<div id="navegacion">';
  
  foreach ($menuNavegacion as $clave => $valor) {
  	if ($clave  == $pasoActivo) {
  	  $salida .= "<a href=\"$valor[0]\"><img src=\"img/$valor[1]\" title=\"$valor[2]\" width=\"40\" height=\"40\" /></a>";	
  	} else {
  	  $salida .= "<a href=\"$valor[0]\"><img src=\"img/$valor[1]\" title=\"$valor[2]\" width=\"40\" height=\"40\" style=\"opacity:0.4;\" /></a>";
  	}
  }	
  $salida .= '</div>';
  return $salida;
}

?>