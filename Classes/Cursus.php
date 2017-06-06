<?php

require_once 'Reglement.php';

class Cursus extends etudiant{
    private $label;
    private $etudiant;
    
    function getLabel() {
        return $this->label;
    }

    function getEtudiant() {
        return $this->etudiant;
    }

    function setLabel($label) {
        $this->label = $label;
    }

    function setEtudiant($etudiant) {
        $this->etudiant = $etudiant;
    }

    function __construct($label, $etudiant) {
        $this->label = $label;
        $this->etudiant = $etudiant;
    }


    public function cursus_conforme($reglement) {
        $valide = true;
        foreach ($reglement->regles as $line => $conditions) {
            
            // je ne connais pas encore l'organisation
            //if SUM => voir quel type d'UE ça concerne puis branche ou filière
            //check si SUM est bon 
            //Sinon dire ce qu'il manque (printout)
            //
            //if EXIST
            //Check si ça existe notifier ce qui n'existe pas (printout)
        }
        return $valide;
    }


    
}
echo "voyons voir"; // pourquoi ??

?>