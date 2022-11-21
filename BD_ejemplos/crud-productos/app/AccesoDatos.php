<?php
include_once "Producto.php";
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
            // Cierro la base de datos
            self::$dbh->close();
            self::$modelo = null; // Borro el objeto.
        }
    }


    // SELECT Devuelvo la lista de Producto
    public function getProductos ():array {
        $tpro = [];
        // Crea la sentencia preparada
        $stmt_productos  = $this->dbh->prepare("select * from PRODUCTOS");
        // Si falla termian el programa
        if ( $stmt_productos == false) die (__FILE__.':'.__LINE__.$this->dbh->error);
        // Ejecuto la sentencia
        $stmt_productos->execute();
        // Obtengo los resultados
        $result = $stmt_productos->get_result();
        // Si hay resultado correctos
        if ( $result ){
            // Obtengo cada fila de la respuesta como un objeto de tipo Usuario
            while ( $pro = $result->fetch_object('Producto')){
               $tpro[]= $pro;
            }
        }
        // Devuelvo el array de objetos
        return $tpro;
    }
    
    // SELECT Devuelvo un Producto o false
    public function getProducto (String $npro) {
        $pro = false;
        
        $stmt_productos   = $this->dbh->prepare("select * from PRODUCTOS where PRODUCTO_NO =?");
         if ( $stmt_productos == false) die ($this->dbh->error);

        // Enlazo $login con el primer ? 
        $stmt_productos->bind_param("s",$npro);
        $stmt_productos->execute();
        $result = $stmt_productos->get_result();
        if ( $result ){
            $pro = $result->fetch_object('Producto');
            }
        
        return $pro;
    }
    
    // UPDATE
    public function modProducto($pro):bool{

        $stmt_modpro = $this->dbh->prepare("update PRODUCTOS set DESCRIPCION=?, PRECIO_ACTUAL=?, STOCK_DISPONIBLE=? where PRODUCTO_NO=?");
        if ( $stmt_modpro == false) die ($this->dbh->error);

        $stmt_modpro->bind_param("ssss",$pro->DESCRIPCION,$pro->PRECIO_ACTUAL, $pro->STOCK_DISPONIBLE, $pro->PRODUCTO_NO);
        $stmt_modpro->execute();
        $resu = ($this->dbh->affected_rows  == 1);
        return $resu;
    }

    //INSERT
    public function addProducto($pro):bool{
       
        $stmt_creapro  = $this->dbh->prepare("insert into PRODUCTOS (PRODUCTO_NO,DESCRIPCION, PRECIO_ACTUAL, STOCK_DISPONIBLE) Values(?,?,?,?)");
        if ( $stmt_creapro == false) die ($this->dbh->error);

        $stmt_creapro->bind_param("ssss", $pro->PRODUCTO_NO,$pro->DESCRIPCION,$pro->PRECIO_ACTUAL, $pro->STOCK_DISPONIBLE);
        $stmt_creapro->execute();
        $resu = ($this->dbh->affected_rows  == 1);
        return $resu;
    }

    //DELETE
    public function borrarProducto(String $npro):bool {
        $stmt_borpro  = $this->dbh->prepare("delete from PRODUCTOS where PRODUCTO_NO =?");
        if ( $stmt_borpro == false) die ($this->dbh->error);
       
        $stmt_borpro->bind_param("s", $npro);
        $stmt_borpro->execute();
        $resu = ($this->dbh->affected_rows  == 1);
        return $resu;
    }   
    
     // Evito que se pueda clonar el objeto. (SINGLETON)
    public function __clone()
    { 
        trigger_error('La clonación no permitida', E_USER_ERROR); 
    }
}

