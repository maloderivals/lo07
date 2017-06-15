<?php
include '../Classes/EtudiantManager.php';
include '../Classes/Etudiant.php';
include '../Classes/Cursus.php';
include '../Classes/CursusManager.php';
//include '../Classes/ElementFormation.php';
include '../Classes/ElementFormationManager.php';

$bdd = new PDO('mysql:host=localhost;dbname=projet_lo07;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

$recup = $_POST['listCursus'];
$curs = explode(" - ", $recup);

$cursus = new Cursus($curs[0], $curs[1]);
$cursus_manager = new CursusManager($bdd);
$etu_manager = new EtudiantManager($bdd);
$etudiant = $etu_manager->get($cursus->getEtudiant());
$manager_elem = new ElementFormationManager($bdd);


//Récupération des éléments du cursus
$listElements = $cursus_manager->getList($cursus);

foreach ($listElements as $key => $elementForm) {
    
}