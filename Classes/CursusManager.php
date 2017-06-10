<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CursusManager
 *
 * @author antoinegruchet
 */
class CursusManager {
    
private $_db; // Instance de PDO.

  public function __construct($db)
  {
    $this->setDb($db);
  }

  public function add(Cursus $cursus)
  {
    // Préparation de la requête d'insertion.
    // Assignation des valeurs.
    // Exécution de la requête.
      $q=$this->_db->prepare("INSERT INTO `cursus` (`label`, `etudiant`, `element_formation`) VALUES (:label, :etu, :element)");
      $q->bindValue(':label',$cursus->getLabel());
      $q->bindValue(':etu',$cursus->getEtudiant());
      $q->bindValue(':element',$cursus->getElementFormation());
      
      $q->execute();
      
  }

  public function delete(Cursus $cursus)
  {
    // Exécute une requête de type DELETE.
      $this->_db->exec('DELETE FROM cursus WHERE label='.$cursus->getLabel());
  }

  public function get($label)
  {
    // Exécute une requête de type SELECT avec une clause WHERE, et retourne un objet etudiant.
      $q=$this->_db->query('SELECT * FROM cursus WHERE label='.$label);
      
      $donnee = $q->fetch(PDO::FETCH_ASSOC);
      
      return new etudiant($donnee);
  }

  public function getList()
  {
    $cursus = [];

    $q = $this->_db->query('SELECT * FROM cursus ORDER BY label');

    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $cursus[] = new Cursus($donnees);
    }

    return $etudiant;    
  }

  
  
  public function update(cursus $cursus)
  {
    // Prépare une requête de type UPDATE.
    // Assignation des valeurs à la requête.
    // Exécution de la requête.
      $q=$this->_db->prepare('UPDATE cursus SET etudiant = :etudiant, element_formation = :element WHERE label = :label');
      $q->bindValue(':label',$cursus->getLabel(),PDO::PARAM_INT);
      $q->bindValue(':etudiant',$cursus->getEtudiant(),PDO::PARAM_INT);
      $q->bindValue(':element',$cursus->getElementFormation(),PDO::PARAM_INT);
  }

  public function setDb(PDO $db)
  {
    $this->_db = $db;
  }
  
}
