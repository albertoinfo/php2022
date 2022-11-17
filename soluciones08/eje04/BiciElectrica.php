<?php

class BiciElectrica {
    private $id; // Identificador de la bicicleta (entero)
    private $coordx; // Coordenada X (entero)
    private $coordy; // Coordenada Y (entero)
    private $bateria; // Carga de la batería en tanto por ciento (entero)
    private $operativa; // Estado de la bicleta ( true operativa- false no disponible)
    
    function __get($atributo)
    {
      if ( property_exists($this,$atributo)){
          return $this->$atributo;
      }   
    }

    function __set($name, $value){
        if ( property_exists($this,$name)){
            $this->$name = $value;
        }
        
    }

    function __toString()
    {
        return $this->id." Bateria ".$this->bateria;
    }

    function distancia ($x,$y):int{
          return intval(round( sqrt( ($x-$this->coordx)*($x-$this->coordx) +
                      ($y-$this->coordy)*($y-$this->coordy) ) ));
    }
}