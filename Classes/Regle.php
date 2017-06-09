<?php

class Regle {

    private $id;
    private $num_regle;
    private $action; //SUM ou EXIST
    private $type; //CS, TM...
    private $temps_cursus; //Concerne le TC, TCBR ou les deux
    private $credits; //Nombre de crédits nécessaires pour remplis la quantité.

    
   
  
    function getId() {
        return $this->id;
    }

    function setId($id) {
        if (is_int($id)){
            $this->id = $id;
        }
    }

        function getNum_regle() {
        return $this->num_regle;
    }

    function getAction() {
        return $this->action;
    }

    function getType() {
        return $this->type;
    }

    function getTemps_cursus() {
        return $this->temps_cursus;
    }

    function getCredits() {
        return $this->credits;
    }

    function setNum_regle($num_regle) {
        if(is_int($num_regle)){
            $this->num_regle = $num_regle;
        }
    }

    function setAction($action) {
        if(is_string($action)){
            $this->action = $action;
        }
    }

    function setType($type) {
        if(is_string($type)){
            $this->type = $type;
        }
    }

    function setTemps_cursus($temps_cursus) {
        if(is_int($temps_cursus)){
            $this->temps_cursus = $temps_cursus;
        }
    }

    function setCredits($credits) {
        if(is_int($credits)){
            $this->credits = $credits;
        }
    }
    
    public function hydrate(array $donnees)
    {
      foreach ($donnees as $key => $value)
      {
        $method = 'set'.ucfirst($key);

        if (method_exists($this, $method))
        {
          $this->$method($value);
        }
      }
    }
  
    public function __construct(array $donnees)
    {
      $this->hydrate($donnees);
    }  

     function __toString() 
    {
        return "$this->num_regle, $this->action, $this->type, $this->temps_cursus, $this->credits";
    }

}
