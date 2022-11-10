<?php

Class Usuario {

   private $login;
   private $nombre;
   private $clave;
   private $comentario;

   function __set($name, $value)
   {
    if ( property_exists($this,$name)){
        $this->$name = $value;
    }
   }

   function __get($name)
   {
       if ( property_exists($this,$name)){
           return $this->$name;
       }
   }


}