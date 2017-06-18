<head>
    <title>Vérification du Cursus</title>
    <link rel="stylesheet" href="../Bootstrap/css/bootstrap.min.css" >
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
//$recupReg = $_POST['listReglements'];
$reglement = new Reglement("R_Actuel_Br");
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
$listRegles = $reglement_manager->getRegles($reglement);



$res = $cursus->cursus_conforme($listRegles, $listElements);

if ( count($res) === 0) {
    print_r("Ce cursus est conforme, ton diplôme t'attends à la scolarité. Bravo !");
} else {
    print_r("Retourne bosser !");
    var_dump($res);
}
