<?php


class Reglement{

 // private $regles;
    private $nom_reglement;
    private $id_reglement;

    function getNom_reglement() {
        return $this->nom_reglement;
    }

    function setNom_reglement(string $nom_reglement) {
        $this->nom_reglement = $nom_reglement;
    }

    /*function getRegles() {
        return $this->regles;
    }
*/
    function getId_reglement() {
        return $this->id_reglement;
    }

    function setId_reglement($id_reglement) {
        $this->id_reglement = $id_reglement;
    }

      /*  function setRegles($regles) {
        if(is_array($regles)){
            $this->regles = $regles;
        }
    }*/

    function __construct($nom, $id) {
        $this->nom_reglement = $nom;
        $this->id_reglement = $id;
    }
    
   

}