<head>Import du règlement</head>

<?php
include '../Classes/Reglement.php';
include '../Classes/ReglementManager.php';
include '../Classes/Regle.php';
include '../Classes/RegleManager.php';

extract(filter_input_array(INPUT_POST));
$fichier = $_FILES["userfile"]["name"];

if ($fichier) { //ouverture du fichier temporaire
    $fp = fopen($_FILES["userfile"]["tmp_name"], "r");
} else { //fichier inconnu 
    ?>
    <p align="center">- Importation échouée -</p>
    <p align="center"><B>Veuillez spécifier un chemin valide</B></p>
    <?php
    exit();
}
?>
<p align="center">- Fichier trouvé -</p>

<?php

// label = nom du fichier Ou sinon on peut demander à l'utilisateur de donner un label
$bdd = new PDO('mysql:host=localhost;dbname=projet_lo07;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$nom = basename($_FILES['userfile']['name'],'.csv');
$reglement = new Reglement($nom, $nom); //Il faut décider comment on définit un id
$manager_reglement = new ReglementManager($bdd);
$manager_reglement->add($reglement);

//Importation des regles

while (!feof($fp)) {
    $ligne = fgets($fp, 4096);
    $liste = explode(";", $ligne); // On créé un tableau des éléments séparés par des ;
    $table = filter_input(INPUT_POST, 'userfile');
    
    $regle = array();
    $regle["num_regle"] = liste[0];
    $regle["action"] = liste[1];
    $regle["type"] = liste[2];
    $regle["temps_cursus"] = liste[3];
    $regle["credit"] = liste[4];
    $regle["idReglement"] = $reglement->getIdReglement();
    
    $elementFormation = new ElementFormation($elementForm);
    $manager_elementFormation = new ElementFormationManager($bdd);
    $manager_elementFormation->add($elementFormation);
    $manager_elementFormation->addToCursus($cursus_etu);

    
}

//Fermeture du fichier
fclose($fp);
?>

<h2><p align="center">Fin de l'import du cursus !</p></h2>