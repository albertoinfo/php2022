<?php
class Datos {
    private $nombre;
    private $edad;
    private $color;
    
    public function __construct ($nom){
        $this->nombre = $nom;
        $this->edad   = 10;
        $this->color  = "rojo";
    }
    
    public function __set($propiedad, $valor){
        if(property_exists($this, $propiedad) ) {
            if ( $propiedad == "edad"){
                $this->edad = $valor+2;
            } else {
            $this->$propiedad = $valor;
            }
        } else {
            echo " Error: acceso al un atributo inexistente ";
        }
    }
    
    public function __get($propiedad){
        if( property_exists($this, $propiedad) ){
            return $this->$propiedad;
        } else {
            return "???";
        }
    }
        
    public function __isset($propiedad){
        return property_exists($this, $propiedad);
    }
    
         
}
$datos = new Datos("Pepe");

 $datos->edad = 25;
 $datos->nombre ="Ana";
 $datos->cosa = 45;

 echo $datos->nombre."\n";
 echo $datos->cosa."\n";



if ( isset($datos->nombre)){
      $datos->nombre = "Juan";
      echo "La nombre es ahora ".$datos->nombre;
}


$datos->nombre="José";
$datos->edad = 39;
$atributo = "edad";
$datos->$atributo = 41;
$datos->color = "amarillo";
$datos->noexisto = "Ahora si que existo";
var_dump($datos);

