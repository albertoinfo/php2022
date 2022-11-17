<?php


class Reloj
{
    protected $segundos;
    private $formato24;
    
    public function __construct ( int $hora, int $minutos, int $segundos){
        $this->segundos = $hora*3600 + $minutos*60 + $segundos;
        $this->formato24 = true;
        
    }
    
    // Mostrar la hora: genera un String con el  formado de hora  22:30:23
    // o 10:30:23 pm si el atributos Formato24 es falso
    
    public function mostrar(){
        $fhoras    = intval( $this->segundos / 3600);
        $fminutos  = intval(($this->segundos - ($fhoras*3600))/60);
        $fsegundos = intval( $this->segundos - ($fhoras*3600) - ($fminutos*60));
        if ( !$this->formato24 && $fhoras > 12 ) $fhoras = $fhoras -12;
        return sprintf("%02d:%02d:%02d",$fhoras,$fminutos,$fsegundos);
        return "";
    }
    
    // Cambiar formato24, recibe un valor true si quiero formato de
    // 24 o falso si quiero de 12
    public function  cambiarFormato24( bool $formato24){
        $this->formato24 = $formato24;
    }
    
    // Incrementa en un segundo el valor de reloj
    public function tictac ():void{
        $this->segundos++;
        if ($this->segundos > 86400) $this->segundos = 0;
    }
    
    // Comparar Hora, recibe como parámetro otro objeto Reloj
    // y me devuelve el número de segundos que tienen de diferencia
    
    public function comparar ( Reloj $otroreloj){
        
        return $this->segundos - $otroreloj->segundos;
    }
    
    
}


