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
            $this->id = $id;
    }

    //Modifier les setter et mettre des conditions pour éviter la casse

    function setNom(string $nom) {
        if (strlen($nom) <= 30) {
            $this->nom = $nom;
        }
    }

    function setPrenom(string $prenom) {
        if (strlen($prenom) <= 30) {
            $this->prenom = $prenom;
        }
    }

    function setLabel_etu($label_etu) {
        if(is_string($prenom) & strlen($nom) <= 30 ){
            $this->prenom = $prenom;
        }
    }




    function __construct(array $donnees) {
        $this->hydrate($donnees);

    }

        function setAdmission(string $admission) {

        if (strlen($admission) <= 10) {
            $this->admission = $admission;
        }
    }

    function setFiliere(string $filiere) {
        if (strlen($filiere) <= 5) {
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

