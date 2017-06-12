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
$nom = basename($_FILES['userfile']['name'], '.csv');
$reglement = new Reglement($nom, $nom); //Il faut décider comment on définit un id
$manager_reglement = new ReglementManager($bdd);



//Importation des regles
//$count = 1; // compter les règles
while (!feof($fp)) {
    $ligne = fgets($fp, 4096);
    $liste = explode(";", $ligne); // On créé un tableau des éléments séparés par des ;
    $length = count($liste);
    $table = filter_input(INPUT_POST, 'userfile');

    $regle_array = array("id_regle" => $reglement->getId_Reglement() . $liste[0]);
    $num = (int) substr($liste[0], +1);
    $regle_array["num_regle"] = $num; //$count;
    $regle_array["action"] = $liste[1];
    $regle_array["type"] = $liste[2];
    if ($length < 5) {
        $regle_array["temps_cursus"] = "total";
        $regle_array["credits"] = $liste[3];
    } else {
        $regle_array["temps_cursus"] = $liste[3];
        $regle_array["credits"] = $liste[4];
    }
    $regle_array["idReglement"] = $reglement->getId_Reglement();

    $regle = new Regle($regle_array);
    $manager_regle = new RegleManager($bdd);
    $manager_regle->add($regle);
    //$count++;
}

$manager_reglement->add($reglement);
//Fermeture du fichier
fclose($fp);
?>

<h2><p align="center">Fin de l'import du règlement !</p></h2>

<form method="post" enctype="multipart/form-data" action="../Fonctio5/importcsv_form.html">
    <input name="submit" type="submit" value="Importer d'autres fichiers"/>
</form>