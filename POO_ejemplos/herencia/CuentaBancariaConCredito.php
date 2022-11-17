<?php 
class CuentaBancariaConCredito extends CuentaBancaria
{
    // -------------------------------------
    // Atributos de Clase
    // -------------------------------------
    
    private $interes;   // Interes a pagar con saldo negativo

    // -------------------------------------
    //   METODOS:
    // -------------------------------------
    
    // Constructores
    public function __construct(int $saldo = 0, $interes =0.10){
        parent::__construct($saldo);
        $this->interes = $interes;
    }
    
    public function __destruct()
    {
        echo "\n Objeto de clase ".get_class($this)." Destruido \n";
    }

    
    // Abono, decremento el saldo en la cantidad indicada como parámetro.
    // Sobreescribo la clase padre
    public function abono (int $cantidad){
        if ( ($this->saldo - $cantidad) > 0){
            $this->saldo -= $cantidad;
        } else {
            // Se queda con una deuda con interes
            $credito = $cantidad - $this->saldo;
            $this->saldo = - ($credito + $credito*$this->interes);
            echo "Crédito concedido \n";
        }
        $this->numMovimientos++;
    }
    
}

