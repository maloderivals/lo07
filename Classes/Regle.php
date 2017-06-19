<?php

class Regle {

    private $id_regle;
    private $num_regle;
    private $action; //SUM ou EXIST
    private $type; //CS, TM...
    private $temps_cursus; //Concerne le TC, TCBR ou les deux
    private $credits; //Nombre de crédits nécessaires pour remplis la quantité.
    private $idReglement;

    function __construct(array $donnes) {
        $this->hydrate($donnes);
    }

    function getId_regle() {
        return $this->id_regle;
    }

    function setId_regle($id_regle) {
        $this->id_regle = $id_regle;
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

    function getIdReglement() {
        return $this->idReglement;
    }

    function setNum_regle(int $num_regle) {
        $this->num_regle = $num_regle;
    }

    function setAction($action) {
        if (is_string($action)) {
            $this->action = $action;
        }
    }

    function setType($type) {
        if (is_string($type)) {
            $this->type = $type;
        }
    }

    function setTemps_cursus($temps_cursus) {
        $this->temps_cursus = $temps_cursus;
    }

    function setCredits($credits) {
        $this->credits = $credits;
    }

    function setIdReglement($idReglement) {
        $this->idReglement = $idReglement;
    }

    function __toString() {
        return "$this->id_regle, $this->num_regle, $this->action, $this->type, $this->temps_cursus, $this->credits, $this->idReglement";
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
