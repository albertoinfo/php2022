<?php
class Usuario {

    private $id;
    private $first_name;
    private $last_name;	
    private $email;	
    private $gender;
    private $ip_address;
    

    
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