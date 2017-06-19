<?php

class ElementFormationManager {

    private $_db; // Instance de PDO.

  public function __construct($db)
  {
    $this->setDb($db);
  }

  public function add(ElementFormation $elem, Cursus $cursus){
    // Préparation de la requête d'insertion.
    // Assignation des valeurs 
    // Exécution de la requête.
      $q=$this->_db->prepare("INSERT INTO element_formation(id, sem_seq, sem_label, sigle, categorie, affectation, utt, profil, credit, resultat, cursus) VALUES(:id, :sem_seq, :sem_label, :sigle, :categorie, :affectation, :utt, :profil, :credit, :resultat, :cursus)");
      
      $q->bindValue(':id',$elem->getId());
      $q->bindValue(':sem_seq',$elem->getSem_seq());
      $q->bindValue(':sem_label',$elem->getSem_label());
      $q->bindValue(':sigle',$elem->getSigle());
      $q->bindValue(':categorie',$elem->getCategorie());
      $q->bindValue(':affectation',$elem->getAffectation());
      $q->bindValue(':utt',$elem->getUtt());
      $q->bindValue(':profil',$elem->getProfil());
      $q->bindValue(':credit',$elem->getCredit());
      $q->bindValue(':resultat',$elem->getResultat());
      $q->bindValue(':cursus',$cursus->getLabel());
      
      $q->execute();
      
  }
  
  public function addToCursus(ElementFormation $element, Cursus $cursus) {
      $q = $this->_db->prepare("UPDATE element_formation SET cursus = :cursus WHERE id = :id");
      $q->bindValue(':cursus', $cursus->getLabel());
      $q->bindValue(':id', $element->getId());
  }

  public function delete(ElementFormation $elem){
    // Exécute une requête de type DELETE.
      $this->_db->exec('DELETE FROM element_formation WHERE id='.$elem->getId());
  }
  
  public function getAllCursus()
  {
    $cursus = [];

    $q = $this->_db->query("SELECT * FROM element_formation e, cursus c WHERE e.cursus = c.label");

    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $cursus[] = $donnees; //new Cursus($donnees);
    }

    return $cursus;
  
  }    
  public function get($id){
    // Exécute une requête de type SELECT avec une clause WHERE, et retourne un objet ElementFormation.
      $q=$this->_db->query('SELECT * FROM element_formation WHERE id='.$id);
      
      $donnee = $q->fetch(PDO::FETCH_ASSOC);
      
      return new ElementFormation($donnee);
  }

  public function getList(){
    $elem = [];

    $q = $this->_db->query('SELECT * FROM element_formation ORDER BY categorie & sigle');
    $i=0;
    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $elem[$i] = $donnees;
      $i++;
    }

    return $elem;    
  }

  
  
  public function update(ElementFormation $elem){
    // Prépare une requête de type UPDATE.
    // Assignation des valeurs à la requête.
    // Exécution de la requête.
      $q=$this->_db->prepare('UPDATE element_formation SET sem_seq = :sem_seq, sem_label = :sem_label, sigle = :sigle, categorie = :categorie, affectation = :affectation, utt = :utt, profil = :profil, credit = :credit, resultat = :resultat WHERE id = :id');
      $q->bindValue(':id',$elem->getId(),PDO::PARAM_INT);
      $q->bindValue(':sem_seq',$elem->getSem_seq(),PDO::PARAM_INT);
      $q->bindValue(':sem_label',$elem->getSem_label(),PDO::PARAM_INT);
      $q->bindValue(':sigle',$elem->getSigle(),PDO::PARAM_INT);
      $q->bindValue(':categorie',$elem->getCategorie(),PDO::PARAM_INT);
      $q->bindValue(':affectation',$elem->getAffectation(),PDO::PARAM_INT);
      $q->bindValue(':utt',$elem->getUtt(),PDO::PARAM_INT);
      $q->bindValue(':profil',$elem->getProfil(),PDO::PARAM_INT);
      $q->bindValue(':credit',$elem->getCredit(),PDO::PARAM_INT);
      $q->bindValue(':resultat',$elem->getResultat(),PDO::PARAM_INT);
      
  }

  public function setDb(PDO $db)
  {
    $this->_db = $db;
  }
}
