<head>
    <title>Vérification du Cursus</title>
</head>

<?php
include '../Classes/Etudiant.php';
include '../Classes/EtudiantManager.php';
include '../Classes/ElementFormation.php';
include '../Classes/ElementFormationManager.php';
include '../Classes/Cursus.php';
include '../Classes/CursusManager.php';
include '../Classes/ReglementManager.php';

$bdd = new PDO('mysql:host=localhost;dbname=projet_lo07;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

//Récupération des infos du règlement choisi
$recupReg = $_POST['listReglements'];
$reglement = new Reglement($recupReg);
$reglement_manager = new ReglementManager($bdd);

//Récupération des infos du cursus choisi
$recup = $_POST['listCursus'];
$curs = explode(" - ", $recup);

$cursus = new Cursus($curs[0], $curs[1]);
$cursus_manager = new CursusManager($bdd);
$etu_manager = new EtudiantManager($bdd);
$etudiant = $etu_manager->get($cursus->getEtudiant());
$manager_elem = new ElementFormationManager($bdd);


//Récupération des éléments du cursus
$listElements = $cursus_manager->getList($cursus);


foreach ($regles as $key => $value) {
    print_r("<li>) $cle = $valeur </li>");
}

foreach ($elementFormation as $key => $value) {
    print_r("<li>) $cle = $valeur </li>");
}
/*
if ($cursus->cursus_conforme($regles, $elementsFormation)) {
    print_r("Ce cursus est conforme, ton diplôme t'attends à la scolarité. Bravo !");
} else {
    print_r("Retourne bosser !");
}
*/