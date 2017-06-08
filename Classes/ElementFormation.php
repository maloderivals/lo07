<?php
session_start(); // sur toutes nos pages 

class ElementFormation {

    private $sem_seq; //
    private $sem_label;
    private $sigle;
    private $categorie;
    private $affectation;
    private $utt;
    private $profil;
    private $credit;
    private $resultat;

    /*function __construct($sem_seq, $sem_label, $sigle, $categorie, $affectation, $utt, $profil, $credit, $resultat) {
        $this->sem_seq = $sem_seq;
        $this->sem_label = $sem_label;
        $this->sigle = $sigle;
        $this->categorie = $categorie;
        $this->affectation = $affectation;
        $this->utt = $utt;
        $this->profil = $profil;
        $this->credit = $credit;
        $this->resultat = $resultat;
    }*/

    public function __destruct() {      
        echo ">> class module : destruct ($this->sem_seq,$this->sem_label,$this->sigle,$this->categorie, $this->affectation,$this->utt,$this->profil,$this->credit, $this->resultat) <br/>\n" ;             
    }

    public function __toString() {
        return "Elément de formation : $this->sem_seq, $this->sem_label, "
                . "$this->sigle, $this->categorie, $this->affectation, $this->utt,"
                . " $this->profil, $this->credit, $this->resultat.";
    }

    function getSem_seq() {
        return $this->sem_seq;
    }

    function getSem_label() {
        return $this->sem_label;
    }

    function getSigle() {
        return $this->sigle;
    }

    function getCategorie() {
        return $this->categorie;
    }

    function getAffectation() {
        return $this->affectation;
    }

    function getUtt() {
        return $this->utt;
    }

    function getProfil() {
        return $this->profil;
    }

    function getCredit() {
        return $this->credit;
    }

    function getResultat() {
        return $this->resultat;
    }

    function setSem_seq($sem_seq) {
        if (is_int($sem_seq)){
            $this->sem_seq = $sem_seq;
        }
    }

    function setSem_label($sem_label) {
        if(is_string($sem_label)){
        $this->sem_label = $sem_label;
        }
    }

    function setSigle($sigle) {
        if(is_string($sigle)){
            $this->sigle = $sigle;
        }
    }

    function setCategorie($categorie) {
        if(is_string($categorie)){
            $this->categorie = $categorie;
        }
    }

    function setAffectation($affectation) {
        if(is_string($affectation)){
        $this->affectation = $affectation;
        }
    }

    function setUtt($utt) {
        if(is_bool($utt)){
            $this->utt = $utt;
        }
    }

    function setProfil($profil) {
        if(is_bool($profil)){
            $this->profil = $profil;
        }
    }

    function setCredit($credit) {
        if(is_int($credit)){
        $this->credit = $credit;
        }    
    }

    function setResultat($resultat) {
        if(is_string($resultat)){
        $this->resultat = $resultat;
        }
    }

    
    function hydrate(array $donnees)
    {
      foreach ($donnees as $key => $value)
      {
        // On récupère le nom du setter correspondant à l'attribut.
        $method = 'set'.ucfirst($key);

        // Si le setter correspondant existe.
        if (method_exists($this, $method))
        {
          // On appelle le setter.
          $this->$method($value);
        }
      }
    }
    
    
}

?>