<?php

class Regle {

    private $num_regle;
    private $action; //SUM ou EXIST
    private $type; //CS, TM...
    private $temps_cursus; //Concerne le TC, TCBR ou les deux
    private $credits; //Nombre de crédits nécessaires pour remplis la quantité.

    function getNum_regle() {
        return $this->num_regle;
    }

    function getAction() {
        return $this->action;
    }

    function getType() {
        return $this->type;
    }

    function getTemps_cursus() {
        return $this->temps_cursus;
    }

    function getCredits() {
        return $this->credits;
    }

    function setNum_regle($num_regle) {
        $this->num_regle = $num_regle;
    }

    function setAction($action) {
        $this->action = $action;
    }

    function setType($type) {
        $this->type = $type;
    }

    function setTemps_cursus($temps_cursus) {
        $this->temps_cursus = $temps_cursus;
    }

    function setCredits($credits) {
        $this->credits = $credits;
    }

    public function __toString() {
        return "$this->num_regle, $this->action, $this->type, $this->temps_cursus, $this->credits.";
    }

}