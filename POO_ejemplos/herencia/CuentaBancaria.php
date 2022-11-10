<?php 
class CuentaBancaria {
    // -------------------------------------
    // Atributos de Clase
    // -------------------------------------
    
    protected $saldo;          // Saldo actual de la cuenta
    protected $numMovimientos; // Número de movimientos realizados
    private static $numCuentas = 0; // Número de cuentas creadas
    
    // -------------------------------------
    //   METODOS:
    // -------------------------------------
    // Método estático

    // Devuelve el total de cuentas creadas
    static public function totaldeCuentas(){
        return self::$numCuentas;
    }


    // Constructores
    public function __construct(int $saldo = 0){
        $this->saldo = $saldo;
        $this->numMovimientos = 0;
        //CuentaBancaria::$numCuentas++; // Otra forma menos general
        self::$numCuentas++;
    }
    
    //Ingreso, incrementa el saldo en una cantidad indicada como parámetro.
    public function ingreso (int $cantidad){
        $this->saldo += $cantidad;
        $this->numMovimientos++;
    }
    
    // Abono, decremento el saldo en la cantidad indicada como parámetro.
    public function abono (int $cantidad){
        if ( ($this->saldo - $cantidad) > 0){
            $this->saldo -= $cantidad;
            $this->numMovimientos++;
        } else {
            echo " Error: no tiene saldo suficente \n";
        }
        
    }
    

    // Consultar estado de la cuenta, mostrá el saldo actual y
    // el número de operaciones realizadas
    public function consultarEstado ():string{
        return "CUENTA ".get_class($this)." Saldo = ". $this->saldo . 
                          " Nº operaciones = ". $this->numMovimientos;
    }
}

