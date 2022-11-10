<?php


include_once 'MotorInterface.php';

class Batidora implements MotorInterface
{
    private $electricidad;
    protected $potencia;
    

    function __construct(int $potencia){
        $this->potencia = $potencia;
        $this->electricidad = false;
    }
    public function encender():bool
    {
        $this->electricidad = true;
        return true;
    }

    public function apagar():bool
    {
        $this->electricidad = false;
        return false;
    }

    public function estaEncendido():bool
    {
        return ( $this->electricidad == true);
    }

    public function infoEstado():string{
        return "Electricidad:".$this->electricidad."\n".
               "Potencia    :".$this->potencia."\n";
    }
}

