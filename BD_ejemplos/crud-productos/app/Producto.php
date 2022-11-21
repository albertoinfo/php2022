<?php
/**
 * CREATE TABLE `PRODUCTOS` (
  `PRODUCTO_NO` int(4) NOT NULL,
  `DESCRIPCION` varchar(30) DEFAULT NULL,
  `PRECIO_ACTUAL` float(8,2) DEFAULT NULL,
  `STOCK_DISPONIBLE` int(9) DEFAULT NULL
) 
 */

class Producto
{
    public $PRODUCTO_NO;
    public $DESCRIPCION;
    public $PRECIO_ACTUAL;
    public $STOCK_DISPONIBLE;

}

