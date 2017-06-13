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

    public function cursus_conforme(array $regles, array $elementsFormation) {
        $valide = TRUE;
        $i = 0;
        $length = count($elementsFormation);
        while ($valide) {
            $regle = new Regle($regles[i]);
            $y = 0;
            
            if($regle->getAction()="SUM"){
                if($regle->getType()="UTT(CS+TM)"){
                    $cstm = 0;
                    while($cstm <= $regle->getCredits() || $y < $length) {
                        $element = new ElementFormation($elementsFormation[$y]);                        
                        if ($element->getAffectation() === $regle->getTemps_cursus() && ($element->getCategorie() === "CS" ||  $element->getCategorie() === "TM") && $element->getUtt() === "Y"){
                            $cstm += $element->getCredit();
                        }
                        $y ++;
                    }
                    if($cstm < $regle->getCredits()){
                        $valide = FALSE;
                    }
                    
                } elseif ($regle->getType()="UTT(ME+CT)") {
                    $mect = 0;
                    while($mect <= $regle->getCredits() || $y < $length) {
                        $element = new ElementFormation($elementsFormation[$y]);                        
                        if ($element->getAffectation() === $regle->getTemps_cursus() && ($element->getCategorie() === "ME" ||  $element->getCategorie() === "CT") && $element->getUtt() === "Y"){
                            $mect += $element->getCredit();
                        }
                        $y ++;
                    }
                    if($mect < $regle->getCredits()){
                        $valide = FALSE;
                    }
                    
                } elseif ($regle->getType()="CS+TM") {
                    
                    
                }
                
             elseif ($regle->getType()="ME+CT") {
                
                
            } elseif ($regle->getType()="ALL") {
                
            } else{ //if($element->getCategorie() === $regle->getType())
                
            }
            } else{ // Cas du EXIST
                
            }

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