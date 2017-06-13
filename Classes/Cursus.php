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

    function setEtudiant(int $etudiant) {
        $this->etudiant = $etudiant;
    }

    function __construct(string $label, int $etudiant) {
        $this->label = $label;
        $this->etudiant = $etudiant;
    }

    public function cursus_conforme(array $regles, array $ElementFormation) {
        $valide = true;
        $i = 0;
        while ($valide) {
            $regle = new Regle($regles[i]);
            

                // je ne connais pas encore l'organisation
                //if SUM => voir quel type d'UE ça concerne puis branche ou filière
                //check si SUM est bon 
                //Sinon dire ce qu'il manque (printout)
                //
            //if EXIST
                //Check si ça existe notifier ce qui n'existe pas (printout)
            
            $i++;
        }
        return $valide;
    }

}

?>