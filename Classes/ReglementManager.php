<?php

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

  public function __construct($db)
  {
    $this->setDb($db);
  }

  public function add(Reglement $reglement)
  {
    // Préparation de la requête d'insertion.
      $q=$this->_db->prepare('INSERT INTO reglement(nom_reglement) VALUES(:nom_reglement)');
    
    // Assignation des valeurs.
      $q->bindValue(':nom_reglement',$reglement->getId_reglement());
      
    // Exécution de la requête.
      $q->execute();
      
  }

  public function delete(Personnage $perso)
  {
    // Exécute une requête de type DELETE.
  }

  public function get($id)
  {
    // Exécute une requête de type SELECT avec une clause WHERE, et retourne un objet Personnage.
  }

  public function getList()
  {
    // Retourne la liste de tous les personnages.
  }

  public function update(Personnage $perso)
  {
    // Prépare une requête de type UPDATE.
    // Assignation des valeurs à la requête.
    // Exécution de la requête.
  }

  public function setDb(PDO $db)
  {
    $this->_db = $db;
  }}
