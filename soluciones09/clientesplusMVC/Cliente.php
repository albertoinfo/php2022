<?php

class Cliente {
    
    private $telefono;
    private $nombre;
    private $puntos;
    
    // Getter con método mágico
    public function __get($atributo){
        if(property_exists($this, $atributo)) {
            return $this->$atributo;
        }
    }
    // Setter con método mágioc
    public function __set($atributo,$valor){
        if(property_exists($this, $atributo)) {
            $this->$atributo = $valor;
        }
    }
    // Seter manuales
    public function setTelefono(string $telefono)
    {
        $this->telefono = $telefono;
    }

    public function setNombre(string $nombre)
    {
        $this->nombre = $nombre;
    }

    public function setPuntos(int $puntos)
    {
        $this->puntos = $puntos;
    }

    
    
}