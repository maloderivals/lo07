<?php

//session_start(); // sur toutes nos pages 

class etudiant {

    private $id; //numéro étudiant
    private $nom; // chaine de char
    private $prenom; //chaine de car
    private $admission; // chaine de  car
    private $filiere; //chaine de car

    function getId() {
        return $this->id;
    }

    function getNom() {
        return $this->nom;
    }

    function getPrenom() {
        return $this->prenom;
    }

    function getAdmission() {
        return $this->admission;
    }

    function getFiliere() {
        return $this->filiere;
    }

    function setId($id) {
        $id = (int) $id;
        if ($id >= 0) {
            $this->id = $id;
        }
    }

    //Modifier les setter et mettre des conditions pour éviter la casse

    function setNom($nom) {
        if (is_string($nom) && strlen($nom) <= 30) {
            $this->nom = $nom;
        }
    }

    function setPrenom($prenom) {
        if (is_string($prenom) && strlen($prenom) <= 30) {
            $this->prenom = $prenom;
        }
    }

    function __construct(array $donnes) {
        $this->hydrate($donnes);
    }

        function setAdmission($admission) {

        if (is_string($admission) && strlen($admission) <= 10) {
            $this->admission = $admission;
        }
    }

    function setFiliere($filiere) {
        if (is_string($filiere) && strlen($filiere) <= 5) {
            $this->filiere = $filiere;
        }
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

    public function _AfficherEtu() {
        
    }

}

?>