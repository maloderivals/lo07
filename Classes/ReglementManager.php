<?php
include 'Regle.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ReglementManager
 *
 * @author antoinegruchet
 */
class ReglementManager {
    

    private $_db; // Instance de PDO.

    public function __construct($db) {
        $this->setDb($db);
    }

    public function add(Reglement $reglement) {
        // Préparation de la requête d'insertion.
        $q = $this->_db->prepare('INSERT INTO reglement(nom_reglement) VALUES(:nom_reglement)');

        // Assignation des valeurs.
        $q->bindValue(':nom_reglement', $reglement->getId_reglement());

        // Exécution de la requête.
        $q->execute();
    }

    public function delete(Reglement $reglement) {
        // Exécute une requête de type DELETE.
        $this->_db->exec('DELETE FROM reglement WHERE nom_reglement=' . $reglement->getId_reglement());
    }

    public function get($id) {
        // Exécute une requête de type SELECT avec une clause WHERE, et retourne un objet Règleemnt.
        $q = $this->_db->query('SELECT * FROM reglement WHERE nom_reglement=' . $id);

        $donnees = $q->fetch(PDO::FETCH_ASSOC);

        return new Reglement($donnees);
    }

    public function getRegles(Reglement $reglement) {
        // Retourne la liste de toutes les règles.
        $regles = [];

        $q = $this->_db->query("SELECT * FROM regle WHERE idReglement='" . $reglement->getId_reglement() . "' ORDER BY num_regle" );

        while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
            $regles[] = $donnees;
        }

        return $regles;
    }

    public function getList() {
        // Retourne la liste de toutes les règles.
        $reglements = [];
        $i=0;
        $q = $this->_db->query("SELECT * FROM reglement" );

        while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
            $reglements[$i] = $donnees;
            $i++;
        }

        return $reglements;
    }
    
    
    public function update(Reglement $reglement) {
        // Prépare une requête de type UPDATE.
       // $q = $this->_db->prepare('UPDATE etudiant SET nom = :nom, prenom = :prenom, admission = :admission, filiere = :filiere WHERE id = :id');
        //$q->bindValue(':id

        
 
        // Exécution de la requête.
    }

    function Array_out(Reglement $reg){
      $donnees= ['nom_reglement'=>$reg->getId_reglement()];
      
      return $donnees;
              
    }
    public function setDb(PDO $db) {
        $this->_db = $db;
    }

}
