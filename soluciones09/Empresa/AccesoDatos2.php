<?php

/*
 * Acceso a datos con BD y Patrón Singleton
 */
class AccesoDatos2 {
    
    private static $modelo = null;
    private $dbh = null;
    private $stmt = null;
    
    
    private static $select0 = "SELECT CLIENTE_NO, NOMBRE FROM CLIENTES WHERE CLIENTES.CLIENTE_NO = ?";
    
    // OJO SI hay varios pedidos con le mismo producto se dirá que es disponible 
    // Aunque la suma de todas las unidades supere el stock actual
    private static $select_disponibles = "SELECT PEDIDOS.PEDIDO_NO, PEDIDOS.PRODUCTO_NO, PRODUCTOS.DESCRIPCION, PEDIDOS.UNIDADES, PRODUCTOS.PRECIO_ACTUAL FROM PEDIDOS, PRODUCTOS ". 
     "WHERE ( PEDIDOS.PRODUCTO_NO = PRODUCTOS.PRODUCTO_NO ) ".
     " AND (PEDIDOS.UNIDADES <= PRODUCTOS.STOCK_DISPONIBLE) ".
     " AND ( PEDIDOS.CLIENTE_NO = ?)";
    private static $select_pedientes = "SELECT PEDIDOS.PEDIDO_NO, PEDIDOS.PRODUCTO_NO, PRODUCTOS.DESCRIPCION, PEDIDOS.UNIDADES, PRODUCTOS.PRECIO_ACTUAL FROM PEDIDOS, PRODUCTOS ".
         "WHERE ( PEDIDOS.PRODUCTO_NO = PRODUCTOS.PRODUCTO_NO ) ".
         " AND (PEDIDOS.UNIDADES > PRODUCTOS.STOCK_DISPONIBLE) ".
         " AND ( PEDIDOS.CLIENTE_NO = ?)";
    
    private static $update_productos = " UPDATE PRODUCTOS, PEDIDOS SET PRODUCTOS.STOCK_DISPONIBLE = PRODUCTOS.STOCK_DISPONIBLE - PEDIDOS.UNIDADES ".
           "WHERE PEDIDOS.PRODUCTO_NO = PRODUCTOS.PRODUCTO_NO ".
           "AND PEDIDOS.UNIDADES <= PRODUCTOS.STOCK_DISPONIBLE AND PEDIDOS.PEDIDO_NO = ? ";
   
    private static $delete_pedidos = "DELETE FROM PEDIDOS WHERE PEDIDOS.PEDIDO_NO = ?";
    
    
    public static function initModelo(){
        if (self::$modelo == null){
            self::$modelo = new AccesoDatos2();
        }
        return self::$modelo;
    }
    
    
    private function __construct(){
        
        try {
            $dsn = "mysql:host=localhost;dbname=Empresa;charset=utf8";
            $this->dbh = new PDO($dsn, "root", "root");
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            echo "Error de conexión ".$e->getMessage();
            exit();
        }
        
    }
    
    
    function checkCliente($cliente_no):bool {
        $stmt = $this->dbh->prepare(self::$select0);
        $stmt->bindValue(1,$cliente_no);
        if ( $stmt->execute() ){  
            return ($stmt->rowCount() > 0 );
        }
        return false;
    }
    
    // Impido la lectura y escritura de la tabla de pedidos y productos
    function bloquear(){
        $this->dbh->exec("LOCK TABLES PRODUCTOS WRITE, PEDIDOS WRITE ");
    }
    
    function desbloquear(){
        $this->dbh->exec("UNLOCK TABLES");
    }
    
    
    function consultaPedidosDisponibles($cliente_no):array {
        $resu = [];
        $stmt = $this->dbh->prepare(self::$select_disponibles);
        $stmt->bindValue(1,$cliente_no);
        // Devuelvo una tabla asociativa
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        if ( $stmt->execute() ){
            while ( $fila = $stmt->fetch()){
                $resu[]= $fila;
            }
        }
        return $resu;
        
    }
    
    function consultaPedidosPedientes($cliente_no):array {
        $resu = [];
        $stmt = $this->dbh->prepare(self::$select_pedientes);
        $stmt->bindValue(1,$cliente_no);
        // Devuelvo una tabla asociativa
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        if ( $stmt->execute() ){
            while ( $fila = $stmt->fetch()){
                $resu[]= $fila;
            }
        }
        return $resu;
        
    }
    // Devuele los pedidos que se han podido actualizar
    // En función de stock_actual
    function actualizarProductos($tablap):array{
        $tabla_pedidos_procesados = [];
        $stmt = $this->dbh->prepare(self::$update_productos);
        foreach ($tablap as $pedido){
            $stmt->bindValue(1,$pedido['PEDIDO_NO']);
            $stmt->execute();  // Intento hacer el UPDATE 
            if ( $stmt->rowCount() == 1){
                $tabla_pedidos_procesados[]=$pedido;
            }     
        }
        return $tabla_pedidos_procesados;
    }
    
    // Borra los pedidos indicados en la tabla
    // Devuelve los pedidos borrados
    function borrarPedidosDisponibles($tablap):int{
        $resu = 0;
        $stmt = $this->dbh->prepare(self::$delete_pedidos);
        foreach ($tablap as $pedido){
            $stmt->bindValue(1,$pedido['PEDIDO_NO']);
            $stmt->execute();
            if ( $stmt->rowCount() == 1){
                $resu++;
            } 
        }  
        return $resu;
    }
    
    
    // Evito que se pueda clonar el objeto.
    public function __clone()
    {
        trigger_error('La clonación no permitida', E_USER_ERROR);
    }
}

