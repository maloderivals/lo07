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

    function cursus_conforme(array $regles, array $elementsFormation) {
        $valide = TRUE;
        $length = count($elementsFormation);
        $failedConditions = array();
        foreach ($regles as $value) {
            $regle = new Regle($value);
            $y = 0;
            if ($regle->getAction() === "SUM") {
                if ($regle->getType() === "UTT(CS+TM)") {
                    $cstm = 0;
                    while ($y < $length) {
                        $element = new ElementFormation($elementsFormation[$y]);
                        if ($element->getAffectation() === $regle->getTemps_cursus() && ($element->getCategorie() === "CS" || $element->getCategorie() === "TM") && $element->getUtt() === "Y" && !preg_match('#F#', $element > getResultat())) {
                            $cstm += $element->getCredit();
                        }
                        $y ++;
                    }
                    if ($cstm < $regle->getCredits()) {
                        $cred = $regle->getCredits() - $cstm;
                        $failedConditions[] = "Il manque " . $cred . " crédits de CS/TM à l'UTT.";
                    }
                } elseif ($regle->getType() == " UTT(ME+CT) ") {
                    $mect = 0;
                    while (($mect <= $regle->getCredits()) || ($y < $length)) {
                        $element = new ElementFormation($elementsFormation[$y]);
                        if ($element->getAffectation() === $regle->getTemps_cursus() && ($element->getCategorie() === "ME" || $element->getCategorie() === "CT") && $element->getUtt() === "Y" && !preg_match('#F#', $element->getResultat())) {
                            $mect += $element->getCredit();
                        }
                        $y ++;
                    }
                    if ($mect < $regle->getCredits()) {
                        $cred = $regle->getCredits() - $mect;
                        $failedConditions[] = "Il manque " . $cred . " crédits de ME/CT à l'UTT.";
                    }
                } elseif ($regle->getType() == "CS+TM") {
                    $cstm = 0;
                    while ($y < $length) {
                        $element = new ElementFormation($elementsFormation[$y]);
                        if ($element->getAffectation() === $regle->getTemps_cursus() && ($element->getCategorie() === "CS" || $element->getCategorie() === "TM") && !preg_match('#F#', $element->getResultat())) {
                            $cstm += $element->getCredit();
                        }
                        $y ++;
                    }
                    if ($cstm < $regle->getCredits()) {
                        $cred = $regle->getCredits() - $cstm;
                        $failedConditions[] = "Il manque " . $cred . " crédits de CS/TM .";
                    }
                } elseif ($regle->getType() == "ME+CT") {
                    $mect = 0;
                    while ($y < $length) {
                        $element = new ElementFormation($elementsFormation[$y]);
                        if ($element->getAffectation() === $regle->getTemps_cursus() && ($element->getCategorie() === "ME" || $element->getCategorie() === "CT") && !preg_match('#F#', $element->getResultat())) {
                            $mect += $element->getCredit();
                        }
                        var_dump($element->getCategorie());
                        var_dump($regle->getTemps_cursus());
                        $y ++;
                    }
                    if ($mect < $regle->getCredits()) {
                        $cred = $regle->getCredits() - $mect;
                        $failedConditions[] = "Il manque " . $cred . " crédits de ME/CT .";
                    }
                } elseif ($regle->getType() == "ALL") {
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
                } else { //if($element->getCategorie() === $regle->getType())
                    $credits = 0;
                    while ($y < $length) {
                        $element = new ElementFormation($elementsFormation[$y]);
                        if ($element->getCategorie() === $regle->getType() && $element->getAffectation() === $regle->getTemps_cursus() && !preg_match('#F#', $element->getResultat())) {
                            $credits += $element->getCredit();
                        }
                        $y ++;
                    }
                    if ($credits < $regle->getCredits()) {
                        $cred = $regle->getCredits() - $credits;
                        $failedConditions[] = "Il manque " . $cred . " crédits de " . $regle->getType() . ".";
                    }
                }
            } elseif ($regle->getAction() === "EXIST") { // Cas du EXIST
                while ($y < $length) {
                    $exist = FALSE;
                    $element = new ElementFormation($elementsFormation[$y]);
                    if ($element->getCategorie() === $regle->getType() && $element->getAffectation() === $regle->getTemps_cursus() && !preg_match('#F#', $element->getResultat())) {
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
