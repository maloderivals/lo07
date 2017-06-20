<?php

require_once 'Reglement.php';
require_once 'Etudiant.php';
require_once 'ElementFormation.php';

class Cursus {

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

    function __construct($donnees) {
        $this->hydrate($donnees);
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

    function cursus_conforme(array $regles, array $elementsFormation) {
        
        $length = count($elementsFormation);
        if ($length==0){
            return "Mais vous n'avez rien validé.... Retournez travailler";
        }
        $failedConditions = array();
            echo "<div>";
            echo "<pre>";
            var_dump($regles);
            //var_dump($listRegles);
            //var_dump($listElements);
            echo "</pre>";
            echo "</div>";
        foreach ($regles as $value) {
            //print_r($value);
            $regle = new Regle($value);
            
            //var_dump($regle);
            //var_dump($listRegles);
            //var_dump($listElements);
            
            
            $y = 0;
            if ($regle->getAction() === " SUM ") {
                if ($regle->getType() === " UTT(CS+TM) ") {
                    $cstm = 0;
                    while ($y < $length) {
                        $element = new ElementFormation($elementsFormation[$y]);
                        if ($regle->getTemps_cursus() === "BR" && ($element->getCategorie() === "CS" || $element->getCategorie() === "TM") && $element->getUtt() === "Y") {
                            if (!preg_match('#F#', $element->getResultat())) {
                                if ($element->getAffectation() === "TCBR" || $element->getAffectation() === "FCBR" || $element->getAffectation() === "BR") {
                                    $cstm += $element->getCredit();
                                }
                            }
                        } elseif ($element->getAffectation() === $regle->getTemps_cursus() && ($element->getCategorie() === "CS" || $element->getCategorie() === "TM") && $element->getUtt() === "Y" && !preg_match('#F#', $element > getResultat())) {
                            $cstm += $element->getCredit();
                        }
                        $y ++;
                    }
                    if ($cstm < $regle->getCredits()) {
                        $cred = $regle->getCredits() - $cstm;
                        $failedConditions[] = "Il manque " . $cred . " crédits de CS/TM en " . $regle->getTemps_cursus() . " à l'UTT.";
                    }
                } elseif ($regle->getType() == " UTT(ME+CT) ") {
                    $mect = 0;
                    while (($mect <= $regle->getCredits()) || ($y < $length)) {
                        $element = new ElementFormation($elementsFormation[$y]);
                        if ($regle->getTemps_cursus() === "BR" && ($element->getCategorie() === "ME" || $element->getCategorie() === "CT") && $element->getUtt() === "Y") {
                            if (!preg_match('#F#', $element->getResultat())) {
                                if ($element->getAffectation() === "TCBR" || $element->getAffectation() === "FCBR" || $element->getAffectation() === "BR") {
                                    $mect += $element->getCredit();
                                }
                            }
                        } elseif ($element->getAffectation() === $regle->getTemps_cursus() && ($element->getCategorie() === "ME" || $element->getCategorie() === "CT") && $element->getUtt() === "Y" && !preg_match('#F#', $element->getResultat())) {
                            $mect += $element->getCredit();
                        }
                        $y ++;
                    }
                    if ($mect < $regle->getCredits()) {
                        $cred = $regle->getCredits() - $mect;
                        $failedConditions[] = "Il manque " . $cred . " crédits de ME/CT en " . $regle->getTemps_cursus() . " à l'UTT.";
                    }
                } elseif ($regle->getType() == "CS+TM") {
                    $cstm = 0;
                    while ($y < $length) {
                        $element = new ElementFormation($elementsFormation[$y]);
                        if ($regle->getTemps_cursus() === "BR" && ($element->getCategorie() === "CS" || $element->getCategorie() === "TM")) {
                            if (!preg_match('#F#', $element->getResultat())) {
                                if ($element->getAffectation() === "TCBR" || $element->getAffectation() === "FCBR" || $element->getAffectation() === "BR") {
                                    $cstm += $element->getCredit();
                                }
                            }
                        } elseif ($element->getAffectation() === $regle->getTemps_cursus() && ($element->getCategorie() === "CS" || $element->getCategorie() === "TM") && !preg_match('#F#', $element->getResultat())) {
                            $cstm += $element->getCredit();
                        }
                        $y ++;
                    }
                    if ($cstm < $regle->getCredits()) {
                        $cred = $regle->getCredits() - $cstm;
                        $failedConditions[] = "Il manque " . $cred . " crédits de CS/TM en " . $regle->getTemps_cursus() . ".";
                    }
                } elseif ($regle->getType() == "ME+CT") {
                    $mect = 0;
                    while ($y < $length) {
                        $element = new ElementFormation($elementsFormation[$y]);
                        if ($regle->getTemps_cursus() === "BR" && ($element->getCategorie() === "ME" || $element->getCategorie() === "CT")) {
                            if (!preg_match('#F#', $element->getResultat())) {
                                if ($element->getAffectation() === "TCBR" || $element->getAffectation() === "FCBR" || $element->getAffectation() === "BR") {
                                    $mect += $element->getCredit();
                                }
                            }
                        } elseif ($element->getAffectation() === $regle->getTemps_cursus() && ($element->getCategorie() === "ME" || $element->getCategorie() === "CT") && !preg_match('#F#', $element->getResultat())) {
                            $mect += $element->getCredit();
                        }
                        $y ++;
                    }
                    if ($mect < $regle->getCredits()) {
                        $cred = $regle->getCredits() - $mect;
                        $failedConditions[] = "Il manque " . $cred . " crédits de ME/CT en " . $regle->getTemps_cursus() . ".";
                    }
                } elseif ($regle->getType() == " ALL ") {
                    $credits = 0;
                    while ($y < $length) {
                        $element = new ElementFormation($elementsFormation[$y]);
                        if (!preg_match('#F#', $element->getResultat())) {
                            $credits += $element->getCredit();
                        }
                        $y ++;
                    }
                    if ($credits < $regle->getCredits()) {
                        $cred = $regle->getCredits() - $credits;
                        $failedConditions[] = "Il manque " . $cred . " crédits au total.";
                    }
                } else {//if($element->getCategorie() === $regle->getType())
                    $credits = 0;
                    while ($y < $length) {
                        $element = new ElementFormation($elementsFormation[$y]);
                        if ($element->getCategorie() === $regle->getType() && $regle->getTemps_cursus() === "BR" && !preg_match('#F#', $element->getResultat())) {
                            if ($element->getAffectation() === "TCBR" || $element->getAffectation() === "FCBR" || $element->getAffectation() === "BR") {
                                $credits += $element->getCredit();
                            }
                        } elseif ($element->getCategorie() === $regle->getType() && $element->getAffectation() === $regle->getTemps_cursus() && !preg_match('#F#', $element->getResultat())) {
                            $credits += $element->getCredit();
                        }
                        $y ++;
                    }
                    if ($credits < $regle->getCredits()) {
                        $cred = $regle->getCredits() - $credits;
                        $failedConditions[] = "Il manque " . $cred . " crédits de " . $regle->getType() . " en " . $regle->getTemps_cursus() . ".";
                    }
                }
            } elseif ($regle->getAction() === " EXIST ") { // Cas du EXIST
                $exist = FALSE;
                while ($y < $length) {                    
                    $element = new ElementFormation($elementsFormation[$y]);
                    if (($element->getCategorie() === $regle->getType() && preg_match('#^ADM#', $element->getResultat()))) {
                        $exist = TRUE;
                    }
                    $y ++;
                }
                if (!$exist) {
                    $failedConditions[] = "Il manque " . $regle->getType() . " à votre cursus.";
                }
            }
        }
        return $failedConditions;
    }

}

?>
