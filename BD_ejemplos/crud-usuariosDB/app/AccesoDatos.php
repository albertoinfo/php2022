<?php
include_once "Usuario.php";
include_once "config.php";

/*
 * Acceso a datos con BD Usuarios : 
 * Usando la librería mysqli
 * Uso el Patrón Singleton :Un único objeto para la clase
 * Constructor privado, y métodos estáticos 
 */
class AccesoDatos {
    
    private static $modelo = null;
    private $dbh = null;
    
    public static function getModelo(){
        if (self::$modelo == null){
            self::$modelo = new AccesoDatos();
        }
        return self::$modelo;
    }
    
    

   // Constructor privado  Patron singleton
   
    private function __construct(){
        
       
         $this->dbh = new mysqli(DB_SERVER,DB_USER,DB_PASSWD,DATABASE);
         
      if ( $this->dbh->connect_error){
         die(" Error en la conexión ".$this->dbh->connect_errno);
        } 

    }

    // Cierro la conexión anulando todos los objectos relacioanado con la conexión PDO (stmt)
    public static function closeModelo(){
        if (self::$modelo != null){
            $obj = self::$modelo;
            // Cierro la base de datos
            $obj->dbh->close();
            self::$modelo = null; // Borro el objeto.
        }
    }


    // SELECT Devuelvo la lista de Usuarios
    public function getUsuarios ():array {
        $tuser = [];
        // Crea la sentencia preparada
        $stmt_usuarios  = $this->dbh->prepare("select * from Usuarios");
        // Si falla termian el programa
        if ( $stmt_usuarios == false) die (__FILE__.':'.__LINE__.$this->dbh->error);
        // Ejecuto la sentencia
        $stmt_usuarios->execute();
        // Obtengo los resultados
        $result = $stmt_usuarios->get_result();
        // Si hay resultado correctos
        if ( $result ){
            // Obtengo cada fila de la respuesta como un objeto de tipo Usuario
            while ( $user = $result->fetch_object('Usuario')){
               $tuser[]= $user;
            }
        }
        // Devuelvo el array de objetos
        return $tuser;
    }
    
    // SELECT Devuelvo un usuario o false
    public function getUsuario (String $login) {
        $user = false;
        
        $stmt_usuario   = $this->dbh->prepare("select * from Usuarios where login =?");
        if ( $stmt_usuario == false) die ($this->dbh->error);

        // Enlazo $login con el primer ? 
        $stmt_usuario->bind_param("s",$login);
        $stmt_usuario->execute();
        $result = $stmt_usuario->get_result();
        if ( $result ){
            $user = $result->fetch_object('Usuario');
            }
        
        return $user;
    }
    
    // UPDATE
    public function modUsuario($user):bool{
      
        $stmt_moduser   = $this->dbh->prepare("update Usuarios set nombre=?, password=?, comentario=? where login=?");
        if ( $stmt_moduser == false) die ($this->dbh->error."En la línea:".__LINE__);

        $stmt_moduser->bind_param("ssss",$user->nombre,$user->password, $user->comentario, $user->login);
        $stmt_moduser->execute();
        $resu = ($this->dbh->affected_rows  == 1);
        return $resu;
    }

    //INSERT
    public function addUsuario($user):bool{
       
        $stmt_creauser  = $this->dbh->prepare("insert into Usuarios (login,nombre,password,comentario) Values(?,?,?,?)");
        if ( $stmt_creauser == false) die ($this->dbh->error);

        $stmt_creauser->bind_param("ssss",$user->login, $user->nombre, $user->password, $user->comentario);
        $stmt_creauser->execute();
        $resu = ($this->dbh->affected_rows  == 1);
        return $resu;
    }

    //DELETE
    public function borrarUsuario(String $login):bool {
        $stmt_boruser   = $this->dbh->prepare("delete from Usuarios where login =?");
        if ( $stmt_boruser == false) die ($this->dbh->error);
       
        $stmt_boruser->bind_param("s", $login);
        $stmt_boruser->execute();
        $resu = ($this->dbh->affected_rows  == 1);
        return $resu;
    }   
    
     // Evito que se pueda clonar el objeto. (SINGLETON)
    public function __clone()
    { 
        trigger_error('La clonación no permitida', E_USER_ERROR); 
    }
}

