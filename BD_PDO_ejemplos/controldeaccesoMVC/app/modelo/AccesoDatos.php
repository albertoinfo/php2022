<?php
include_once "User.php";

/*
 * Acceso a datos con BD Usuarios y Patrón Singleton 
 * Un único objeto para la clase
 */
class AccesoDatos {
    
    private static $modelo = null;
    private $dbh = null;
    private $stmt_usuario    = null;
    private $stmt_incaccesos  = null;
    private $stmt_bloquear   = null;
   
    
    public static function getModelo(){
        if (self::$modelo == null){
            self::$modelo = new AccesoDatos();
        }
        return self::$modelo;
    }
    
    

   // Constructor privado  Patron singleton
   
    private function __construct(){
        
        try {
            $dsn = "mysql:host=localhost;dbname=Prueba";
            $this->dbh = new PDO($dsn, "root", "root");
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            echo "Error de conexión ".$e->getMessage();
            exit();
        }
       
        $this->stmt_usuario     = $this->dbh->prepare("select * from Users where login=:login");
        $this->stmt_incaccesos  = $this->dbh->prepare("update Users set accesos=accesos+1 where login=:login");
        $this->stmt_bloquear    = $this->dbh->prepare("update Users set bloqueo=1 where login=:login");
    
    }

    // Cierro la conexión anulando todos los objectos relacioanado con la conexión PDO (stmt)
    public static function closeModelo(){
        if (self::$modelo != null){
            $obj = self::$modelo;
            $obj->dbh = null;
            self::$modelo = null; // Borro el objeto.
        }
    }


    // Devuelvo un usuario o null
    public function getUsuario (String $login) {
        $user = null;
        
        $this->stmt_usuario->setFetchMode(PDO::FETCH_CLASS, 'User');
        $this->stmt_usuario->bindParam(':login', $login);
        if ( $this->stmt_usuario->execute() ){
             if ( $obj = $this->stmt_usuario->fetch()){
                $user= $obj;
            }
        }
        return $user;
    }


    public function incrementarAccesos($login):bool {
        $this->stmt_incaccesos->bindValue(":login",$login);
        $this->stmt_incaccesos->execute();
        $resu = ($this->stmt_incaccesos->rowCount () == 1);
        return $resu;
    }
    
    public function bloquearUsuario($login):bool {
        $this->stmt_bloquear->bindValue(":login",$login);
        $this->stmt_bloquear->execute();
        $resu = ($this->stmt_bloquear->rowCount () == 1);
        return $resu;
    }
    



     // Evito que se pueda clonar el objeto. (SINGLETON)
    public function __clone()
    { 
        trigger_error('La clonación no permitida', E_USER_ERROR); 
    }
}
