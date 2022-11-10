<?php

  include_once 'Animal.php';

  class Gato extends Animal {

    private $raza;

    public function __construct($s = "macho", $r = "siamés") {
      parent::__construct($s);
      
        $this->raza = $r;
      
    }

    public function __toString() {
      return parent::__toString() . "<br>Raza: $this->raza";
    }

    public function maulla() {
      return "Miauuuu<br>";
    }

    public function ronronea() {
      return "mrrrrrr<br>";
    }

    public function come($comida) {
      if ($comida == "pescado") {
        return "Hmmmm, gracias<br>";
      } else {
        return "Lo siento, yo solo como pescado<br>";
      }
    }

    public function peleaCon($contrincante) {
      if (($this->getSexo()) == "hembra") {
        echo "no me gusta pelear<br>";
      } else if (($contrincante->getSexo()) == "hembra") {
        echo "no peleo contra gatitas<br>";
      } else {
        echo "ven aquí que te vas a enterar<br>";
      }
    }
  }