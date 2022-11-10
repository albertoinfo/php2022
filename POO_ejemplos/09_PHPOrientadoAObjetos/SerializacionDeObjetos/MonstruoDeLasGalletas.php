<?php

  class MonstruoDeLasGalletas {
    
    private $galletas; // galletas comidas
    
    public function __wakeup() {
        echo " Tengo hambre...";
    }
    
    public function __construct() {
       
             $this->galletas = 0;
    }
    
    public function getGalletas() {
      return $this->galletas;
    }
    
    public function come($g) {
      $this->galletas = $this->galletas + $g;
    }
  }