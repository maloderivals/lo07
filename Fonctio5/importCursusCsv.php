<head>
    <title>Import en cours</title>
</head>
<?php
include '../Classes/Etudiant.php';
include '../Classes/EtudiantManager.php';
include '../Classes/ElementFormation.php';
include '../Classes/ElementFormationManager.php';
include '../Classes/Cursus.php';
include '../Classes/CursusManager.php';



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
$nom = $fichier->getElementbyID;
print_r("Label : ".$nom);


//Importation de l'étu
$etu = array();
for ($i = 0; $i < 5; $i ++) {
    $ligne = fgets($fp, 4096);
    $liste = explode(";", $ligne);
    $table = filter_input(INPUT_POST, 'userfile');
    $etu[$i] = $liste[1];
}

$hashEtu = array("id" => $etu[0], "nom" => $etu[1], "prenom" => $etu[2], "admission" => $etu[3], "filiere" => $etu[4]);

$etudiant = new etudiant($hashEtu);
$bdd = new PDO('mysql:host=localhost;dbname=projet_lo07;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$manager_etu = new EtudiantManager($bdd);
//$manager_etu->add($etudiant);


//Création du cursus
// label = nom du fichier Ou sinon on peut demander à l'utilisateur de donner un label
$cursus_etu = new Cursus($fichier, $etudiant->getId());
$manager_cursus = new CursusManager($bdd);
$manager_cursus->add($cursus_etu);

$attributs = array("sem_seq", "sem_label", "sigle", "categorie", "affectation", "utt", "profil", "credit", "resultat");

//Importation des éléments du cursus de l'étudiant
$ligne = fgets($fp, 4096);
$liste = explode(";", $ligne); // On créé un tableau des éléments séparés par des ;
$table = filter_input(INPUT_POST, 'userfile');

while ($liste[0] !== "END") {
    if ($liste[0] === "EL") {
        $elementForm = array("id" => $liste[3] . $etudiant->getId());
        for ($i = 0; $i < 9; $i++) {
            $elementForm[$attributs[$i]] = $liste[$i + 1];   //Récupère les attributs de l'élément de formation en cours
        }
        $elementFormation = new ElementFormation($elementForm);
        $manager_elementFormation = new ElementFormationManager($bdd);
        $manager_elementFormation->add($elementFormation);
        $manager_elementFormation->addToCursus($cursus_etu);
        
    }
    $ligne = fgets($fp, 4096);
    $liste = explode(";", $ligne); // On créé un tableau des éléments séparés par des ;
    $table = filter_input(INPUT_POST, 'userfile');
}


//Fermeture du fichier
fclose($fp);
?>

<h2><p align="center">Fin de l'import du cursus !</p></h2>