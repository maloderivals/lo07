<?php

require_once 'Reglement.php';
require_once 'Etudiant.php';
require_once 'ElementFormation.php';

class Cursus extends etudiant {

    private $label;
    private $etudiant;

    function getLabel() {
        return $this->label;
    }

    function getEtudiant() {
        return $this->etudiant;
    }

    function setLabel($label) {
        if (is_string($label)) {
            $this->label = $label;
        }
    }

    function setEtudiant($etudiant) {
        $this->etudiant = $etudiant;
    }





    public function hydrate(array $donnees) {
        foreach ($donnees as $key => $value) {
            // On récupère le nom du setter correspondant à l'attribut.
            $method = 'set' . ucfirst($key);

            // Si le setter correspondant existe.
            if (method_exists($this, $method)) {
                // On appelle le setter.
                $this->$method($value);
            }
        }

     
      }

   
   

    
}

?>
