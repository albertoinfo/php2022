<?php


include_once 'Batidora.php';
include_once 'Ejemplotrait.php';

class Molinex extends Batidora
{

    use Ejemplotrait;
    
    public function __toString(){
        return 
            "Potencia  = ".$this->potencia." W \n".
            "Estado del Motor = ".(($this->estaEncendido())?"Encendido":"Apagado")."<br>".
            "Precio    = ".$this->getprecio()." Euros \n";
    }
}

