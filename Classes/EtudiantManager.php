<?php

class EtudiantManager {
    
  private $_db; // Instance de PDO.

  public function __construct($db)
  {
    $this->setDb($db);
  }

  public function add(etudiant $etu)
  {
    // Préparation de la requête d'insertion.
    // Assignation des valeurs.
    // Exécution de la requête.
      $q=$this->_db->prepare('INSERT INTO etudiant(id, nom, prenom, admission, filiere) VALUES(:id, :nom, :prenom, :admission, :filiere)');
      $q->bindValue(':id',$etu->getId());
      $q->bindValue(':nom',$etu->getNom());
      $q->bindValue(':prenom',$etu->getPrenom());
      $q->bindValue(':admission',$etu->getAdmission());
      $q->bindValue(':filiere',$etu->getFiliere());
      $q->execute();
      
  }

  public function delete(etudiant $etu)
  {
    // Exécute une requête de type DELETE.
      $this->_db->exec('DELETE FROM etudiant WHERE id='.$etu->getId());
  }

  public function get($id)
  {
    // Exécute une requête de type SELECT avec une clause WHERE, et retourne un objet etudiant.
      $q=$this->_db->query('SELECT * FROM etudiant WHERE id='.$id);
      
      $donnee = $q->fetch(PDO::FETCH_ASSOC);
      
      return new etudiant($donnees);
  }

  public function getList()
  {
    $etudiant = [];

    $q = $this->_db->query('SELECT * FROM etudiant ORDER BY nom');

    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $etudiant[] = new etudiant($donnees);
    }

    return $etudiant;    
  }

  
  
  public function update(etudiant $etu)
  {
    // Prépare une requête de type UPDATE.
    // Assignation des valeurs à la requête.
    // Exécution de la requête.
      $q=$this->_db->prepare('UPDATE etudiant SET nom = :nom, prenom=:prenom, admission = :admission, filiere = :filiere WHERE id = :id');
      $q->bindValue(':id',$etu->getId(),PDO::PARAM_INT);
      $q->bindValue(':nom',$etu->getNom(),PDO::PARAM_INT);
      $q->bindValue(':prenom',$etu->getNom(),PDO::PARAM_INT);
      $q->bindValue(':admission',$etu->getAdmission(),PDO::PARAM_INT);
      $q->bindValue(':filiere',$etu->getFiliere(),PDO::PARAM_INT);
      
  }

  public function setDb(PDO $db)
  {
    $this->_db = $db;
  }  
}
