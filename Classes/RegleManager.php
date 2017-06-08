<?php
class RegleManager {
   private $_db; // Instance de PDO.

  public function __construct($db)
  {
    $this->setDb($db);
  }

  public function add(Regle $regle)
  {
    // Préparation de la requête d'insertion.
      $q=$this->_db->prepare('INSERT INTO regle(id, num_regle, action, type, temps_cursus, credits) VALUES(:id, :num_regle, :action, :type, :temps_cursus, :credits)');
    
    // Assignation des valeurs.
      $q->bindValue(':id',$regle->getId());
      $q->bindValue(':num_regle',$regle->getNum_regle());
      $q->bindValue(':action',$regle->getAction());
      $q->bindValue(':type',$regle->getType());
      $q->bindValue(':temps_cursus',$regle->getTemps_cursus());
      $q->bindValue(':credits',$regle->getCredits());
      
    // Exécution de la requête.
      $q->execute();
      
  }

  public function delete(Regle $regle)
  {
    // Exécute une requête de type DELETE.
      $this->_db->exec('DELETE FROM regle WHERE id='.$regle->getId());
  }

  public function get($id)
  {
    // Exécute une requête de type SELECT avec une clause WHERE, et retourne un objet regle.
      $q=$this->_db->query('SELECT * FROM regle WHERE id='.$id);
      
      $donnee = $q->fetch(PDO::FETCH_ASSOC);
      
      return new Regle($donnees);
  }

  public function getList()
  {
    $regle = [];

    $q = $this->_db->query('SELECT * FROM regle ORDER BY num_regle');

    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $regle[] = new Regle($donnees);
    }

    return $regle; 
  }

  
  
  public function update(Regle $regle)
  {
    // Prépare une requête de type UPDATE.
    // Assignation des valeurs à la requête.
    // Exécution de la requête.
      $q=$this->_db->prepare('UPDATE etudiant SET num_regle = :num_regle, action = :action, type = :type, temps_cursus = :temps_cursus, credits = :credits WHERE id = :id');
      $q->bindValue(':id',$regle->getId(),PDO::PARAM_INT);
      $q->bindValue(':num_regle',$regle->getNum_regle(),PDO::PARAM_INT);
      $q->bindValue(':action',$regle->getAction(),PDO::PARAM_INT);
      $q->bindValue(':type',$regle->getType(),PDO::PARAM_INT);
      $q->bindValue(':temps_cursus',$regle->getTemps_cursus(),PDO::PARAM_INT);
      $q->bindValue(':credits',$regle->getCredits(),PDO::PARAM_INT);
      
  }

  public function setDb(PDO $db)
  {
    $this->_db = $db;
  }  
  
 }
