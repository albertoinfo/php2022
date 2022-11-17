<?php


class Coche
{
    // Definir los atributos
    private $modelo;  //  Una cadena con el modelo de vehículo.
    private $motor;  // Arrancado o parado ( true / false)
    private $velocidad;  // velocidad en km/h
    private $velocidadMax; // Máxima velocidad con la que puede circular el vehículo
    private $distanciaParcial;
    private $distanciaTotal;
    
    // Completar los métodos
    
    function __construct ( String $modelo, int $velocidadMax){
        $this->modelo = $modelo;
        $this->distanciaParcial = 0;
        $this->distanciaTotal = 0;
        $this->velocidad = 0;
        $this->velocidadMax = $velocidadMax;
        $this->motor = false;	
    }
    
    public function  arrancar():bool{
        if ( $this->motor ){
            $this->infoError("Motor ya arrancado");
            return false;
        }
        else{
           $this->motor = true;
            return true;
        }
    }
    
    public function parar():bool{
        if ( !$this->motor ){
            $this->infoError("Motor ya esta parado");
            return false;
        }
        else{
            $this->motor = false;
            $this->velocidad = 0;
            $this->distanciaParcial = 0;
            return true;
        }	
    }
    
    public function acelera( int $cantidad):bool{
        if ( $this->motor){
            $this->velocidad = $this->velocidad + $cantidad;
            // Control de la velocidad Máxima
            if ( $this->velocidad > $this->velocidadMax){
                $this->velocidad = $this->velocidadMax;
            }
            return true;
        }
        else{
            $this->infoError(" Motor parado. No se puede acelerar");
            return false;
        }
    }
    
    public function frena ( int $cantidad):bool{
        if ( $this->motor){
            $this->velocidad = $this->velocidad - $cantidad;
            // Control de la velocidad Mínima 0
            if ( $this->velocidad < 0){
                $this->velocidad = 0;
            }
            return true;
        }
        else{
            $this->infoError(" Motor parado. No se puede frenar");
            return false;
        }
    }
    
    public function recorre ():bool{
        if ( $this->motor){
            // Incremento la velocidad
            $this->distanciaParcial += $this->velocidad;
            $this->distanciaTotal   += $this->velocidad;
            return true;
        }
        else{
            $this->infoError(" Motor parado. No se puede avanzar ");
            return false;
        }
    }
    
    public function info():string{
        return $this->modelo.": km =". $this->distanciaParcial ." Velocidad:=". $this->velocidad ."<br>";
    }
    
    public function getKilometros():int{
        return $this->distanciaParcial;
    }
    
    private function infoError( String $mensaje):void{
        print($mensaje."<br>");
    }	
    
    static function compara (Coche $a,Coche $b){
        return $a->getKilometros() - $b->getKilometros();
    }
}

