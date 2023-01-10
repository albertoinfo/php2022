<?php
include_once "Cliente.php";
/*
 * Acceso a datos con BD y Patrón Singleton
 */
class AccesoDatos {
    
    private static $modelo = null;
    private $dbh = null;
    private $stmt = null;
    
    public static function initModelo(){
        if (self::$modelo == null){
            self::$modelo = new AccesoDatos();
        }
        return self::$modelo;
    }
    
    // Creo un lista de alimentos, podría obtenerse de una base de datos
    private function __construct(){
        
        try {
            $dsn = "mysql:host=localhost;dbname=telefonia;charset=utf8";
            $this->dbh = new PDO($dsn, "root", "root");
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            echo "Error de conexión ".$e->getMessage();
            exit();
        }
        // Construyo la consulta
        $this->stmt = $this->dbh->prepare("select * from clientes where puntos >= ?");
        
    }
    
    // Devuelvo la lista de Clientes
    public function obtenerListaClientes ($puntos):array {
        $tclientes = [];
        $this->stmt->bindValue(1,$puntos);
        // Devuelvo una tabla asociativa
        $this->stmt->setFetchMode(PDO::FETCH_CLASS, 'Cliente');
        // Devuelve objectos clientes llamando a constructor y a métodos setter
        if ( $this->stmt->execute() ){
            while ( $cli = $this->stmt->fetch()){
               $tclientes[]= $cli;
            }
        }
        return $tclientes;
    }
    
     // Evito que se pueda clonar el objeto.
    public function __clone()
    { 
        trigger_error('La clonación no permitida', E_USER_ERROR); 
    }
}

