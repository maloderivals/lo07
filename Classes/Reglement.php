<?php

require_once 'Regle.php';

class Reglement extends Regle{

    private $regles = array();
    private $nom_reglement;
    private $id_reglement;

    function getNom_reglement() {
        return $this->nom_reglement;
    }

    function setNom_reglement($nom_reglement) {
        $this->nom_reglement = $nom_reglement;
    }

    function getRegles() {
        return $this->regles;
    }

    function getId_reglement() {
        return $this->id_reglement;
    }

    function setId_reglement($id_reglement) {
        $this->id_reglement = $id_reglement;
    }

        function setRegles($regles) {
        if(is_array($regles)){
            $this->regles = $regles;
        }
    }

    function __construct(array $donnes) {
        $this->hydrate($donnes);
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