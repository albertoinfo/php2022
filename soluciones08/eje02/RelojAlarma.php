<?php
include_once 'Reloj.php';

class RelojAlarma extends Reloj
{
    private $segundosalarma;
    private $alarmaActivada;

    public function __construct(int $hora, int $minutos, int $segundos)
    {
        parent::__construct($hora, $minutos, $segundos);
        $this->segundosalarma =0;
        $this->alarmaActivada = false;
    }
    
    // Nuevo método
    public function setAlarma ($hora,$minutos):void{
        $this->segundosalarma = $hora * 3600 + $minutos*60;
        $this->alarmaActivada = true;
    }
    
    // Nuevo método
    public function activarAlarma ( bool $estado):void{
        $this->alarmaActivada = $estado;
    }
    
    // Incrementa en un segundo el valor de reloj y chequea la alarma
    // Sobrescribe el método de tictac
    public function tictac ():void{
        $this->segundos++;
        // Mayor 3600 * 24
        if ($this->segundos > 86400) $this->segundos = 0;
        if ( $this->segundos == $this->segundosalarma  && $this->alarmaActivada ){
            print( "<br> ¡¡¡ ALARMA !!! ". $this->mostrar()."<br>");
        }
    }
}

