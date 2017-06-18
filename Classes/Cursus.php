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

    function __construct(string $label, int $etudiant) {
        $this->label = $label;
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

/*    
    function cursus_conforme(array $regles, array $elementsFormation) {
        $valide = TRUE;
        $length = count($elementsFormation);
        $failedConditions = array();
        foreach ($regles as $value) {
            $regle = new Regle($value);
            $y = 0;
            if ($regle->getAction() = "SUM") {
                if ($regle->getType() = "UTT(CS+TM)") {
                    $cstm = 0;
                    while ($cstm <= $regle->getCredits() || $y < $length) {
                        $element = new ElementFormation($elementsFormation[$y]);
                        if ($element->getAffectation() === $regle->getTemps_cursus() && ($element->getCategorie() === "CS" || $element->getCategorie() === "TM") && $element->getUtt() === "Y" && $element->getResultat() !== "F") {
                            $cstm += $element->getCredit();
                        }
                        $y ++;
                    }
                    if ($cstm < $regle->getCredits()) {
                        $valide = FALSE;
                        $failedConditions[] = "Il manque " . $regle->getCredits() - $cstm . " crédits de CS/TM à l'UTT .";
                    }
                } elseif ($regle->getType() = "UTT(ME+CT)") {
                    $mect = 0;
                    while ($mect <= $regle->getCredits() || $y < $length) {
                        $element = new ElementFormation($elementsFormation[$y]);
                        if ($element->getAffectation() === $regle->getTemps_cursus() && ($element->getCategorie() === "ME" || $element->getCategorie() === "CT") && $element->getUtt() === "Y" && $element->getResultat() !== "F") {
                            $mect += $element->getCredit();
                        }
                        $y ++;
                    }
                    if ($mect < $regle->getCredits()) {
                        $valide = FALSE;
                        $failedConditions[] = "Il manque " . $regle->getCredits() - $mect . " crédits de ME/CT à l'UTT.";
                    }
                } elseif ($regle->getType() = "CS+TM") {
                    $cstm = 0;
                    while ($cstm <= $regle->getCredits() || $y < $length) {
                        $element = new ElementFormation($elementsFormation[$y]);
                        if ($element->getAffectation() === $regle->getTemps_cursus() && ($element->getCategorie() === "CS" || $element->getCategorie() === "TM") && $element->getResultat() !== "F") {
                            $cstm += $element->getCredit();
                        }
                        $y ++;
                    }
                    if ($cstm < $regle->getCredits()) {
                        $valide = FALSE;
                        $failedConditions[] = "Il manque " . $regle->getCredits() - $cstm . " crédits de CS/TM .";
                    }
                } elseif ($regle->getType() = "ME+CT") {
                    $mect = 0;
                    while ($mect <= $regle->getCredits() || $y < $length) {
                        $element = new ElementFormation($elementsFormation[$y]);
                        if ($element->getAffectation() === $regle->getTemps_cursus() && ($element->getCategorie() === "ME" || $element->getCategorie() === "CT") && $element->getResultat() !== "F") {
                            $mect += $element->getCredit();
                        }
                        $y ++;
                    }
                    if ($mect < $regle->getCredits()) {
                        $valide = FALSE;
                        $failedConditions[] = "Il manque " . $regle->getCredits() - $mect . " crédits de ME/CT .";
                    }
                } elseif ($regle->getType() = "ALL") { // Comment dire de ne vérifier que dans les ue de branches, de tc ou des 2 ? ce n'est pas dans la règle
                    $credits = 0;
                    while ($credits <= $regle->getCredits() || $y < $length) {
                        $element = new ElementFormation($elementsFormation[$y]);
                        if (($element->getAffectation() === "TCBR" || $element->getAffectation() === "FCBR" || $element->getAffectation() === "BR") && $element->getResultat() !== "F") {
                            $credits += $element->getCredit();
                        }
                        $y ++;
                    }
                    if ($credits < $regle->getCredits()) {
                        $valide = FALSE;
                        $failedConditions[] = "Il manque " . $regle->getCredits() - $credits . " crédits au total.";
                    }
                } else { //if($element->getCategorie() === $regle->getType())
                    $credits = 0;
                    while ($credits <= $regle->getCredits() || $y < $length) {
                        $element = new ElementFormation($elementsFormation[$y]);
                        if ($element->getCategorie() === $regle->getType() && $element->getAffectation() === $regle->getTemps_cursus() && $element->getResultat() !== "F") {
                            $credits += $element->getCredit();
                        }
                        $y ++;
                    }
                    if ($credits < $regle->getCredits()) {
                        $valide = FALSE;
                        $failedConditions[] = "Il manque " . $regle->getCredits() - $credits . " crédits de " . $regle->getType() . ".";
                    }
                }
            } else { // Cas du EXIST
                while ($y < $length) {
                    $exist = FALSE;
                    $element = new ElementFormation($elementsFormation[$y]);
                    if ($element->getCategorie() === $regle->getType() && $element->getAffectation() === $regle->getTemps_cursus() && $element->getResultat() !== "F") {
                        $exist = TRUE;
                    }
                    $y ++;
                }
                if (!$exist) {
                    $valide = FALSE;
                    $failedConditions[] = "Il manque " . $regle->getType() . " à votre cursus.";
                }
            }
        }
        return $failedConditions;
   } */
}

?>
