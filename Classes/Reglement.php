<?php

require_once 'Regle.php';

class Reglement extends Regle{

    private $regles = array();
    private $nom_reglement;

    function getNom_reglement() {
        return $this->nom_reglement;
    }

    function setNom_reglement($nom_reglement) {
        $this->nom_reglement = $nom_reglement;
    }

    function getRegles() {
        return $this->regles;
    }

    function setRegles($regles) {
        if(is_array($regles)){
            $this->regles = $regles;
        }
    }

    //A modifier c'est juste pour essayer de poser des bases
    
    function creerReglement($filename) {
        foreach ($filename as $key => $value) { //parcourir chaque ligne du fichier (retrouver la bonne formulation)
            $line = fgetcsv($filename, $length);
            $temp = explode(";", $line);
            $rule = new Regle();
            $rule->setNum_regle($temp(0));
            $rule->setAction($temp(1));
            $rule->setType($temp(2));
            $rule->setTemps_cursus($temp(3));
            $rule->setCredits($temp(4));
            $regles(); //Ajouter $rule à la fin
        }
        return $regles;
    }

}