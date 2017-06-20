<?php

class Regle {

    private $id_regle;
    private $num_regle;
    private $action; //SUM ou EXIST
    private $type; //CS, TM...
    private $temps_cursus; //Concerne le TC, TCBR ou les deux
    private $credits; //Nombre de crédits nécessaires pour remplis la quantité.
    private $id_reglement;

    function getId_regle() {
        return $this->id_regle;
    }

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

    function getId_reglement() {
        return $this->id_reglement;
    }

    function setId_regle($id_regle) {
        $this->id_regle = $id_regle;
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

    function setId_reglement($id_reglement) {
        $this->id_reglement = $id_reglement;
    }

    public function hydrate(array $donnees) {
        foreach ($donnees as $key => $value) {

            $method = 'set' . ucfirst($key);
            //print_r("<h1>".$method."</h1>");
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

}
