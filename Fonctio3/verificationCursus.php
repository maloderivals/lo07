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

$bdd = new PDO('mysql:host=localhost;dbname=projet_lo07;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

$i = 0;
foreach ($_GET as $cle => $valeur) {
    echo ("<li>$i) $cle = $valeur </li>");
    $i += 1;
}

// Mettre un formulaire pour récupérer ces données
$nomCursus = "cursusPrior";
$nomReglement = "R_Actuel_Br";
$etu = 12456;
$manager_etu = new EtudiantManager($bdd);
$etudiant = $manager_etu->get($etu);
print_r($etudiant);

$reglement = new Reglement($nomReglement, $nomReglement);
$managerReglement = new ReglementManager($bdd);

$cursus = new Cursus($nomCursus, $etu);
$managerCursus = new CursusManager($bdd);S

$regles = $managerReglement->getList($reglement);
$elementFormation = $managerCursus->getList($cursus);

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