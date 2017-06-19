
<?php
include '../Classes/Etudiant.php';
include '../Classes/EtudiantManager.php';
include '../Classes/ElementFormation.php';
include '../Classes/ElementFormationManager.php';
include '../Classes/Cursus.php';
include '../Classes/CursusManager.php';
include '../include/Formulaire_Dynamique.php';



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
$bdd = new PDO('mysql:host=localhost;dbname=projet_lo07;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$manager_etu = new EtudiantManager($bdd);
$manager_etu->add($etudiant);
echo "<h1 align='center'>-Table étudiant remplis-</h1>";

//Création du cursus
// label = nom du fichier Ou sinon on peut demander à l'utilisateur de donner un label
$nom = basename($_FILES['userfile']['name'], '.csv');
$cursus_etu = new Cursus($nom, $etudiant->getId());

// $array_cursus = ['label' => $nom, 'etudiant' => $etudiant->getId()];
// $cursus_etu = new Cursus($array_cursus);

$manager_cursus = new CursusManager($bdd);
$manager_cursus->add($cursus_etu);
echo "<h1 align='center'>-Table cursus remplis-</h1>";
$attributs = array("sem_seq", "sem_label", "sigle", "categorie", "affectation", "utt", "profil", "credit", "resultat", "cursus");

//Importation des éléments du cursus de l'étudiant
$ligne = fgets($fp, 4096);
$liste = explode(";", $ligne); // On créé un tableau des éléments séparés par des ;
$table = filter_input(INPUT_POST, 'userfile');

//$elementFormation['cursus']=$array_cursus['label'];
while ($liste[0] !== "END") {
    if ($liste[0] === "EL") {
        $elementForm = array("id" => $liste[3] . $etudiant->getId());
        for ($i = 0; $i < 9; $i++) {
            $elementForm[$attributs[$i]] = $liste[$i + 1];   //Récupère les attributs de l'élément de formation en cours
        }
        //$elementForm['cursus'] = $array_cursus['label'];
        $elementFormation = new ElementFormation($elementForm);
        $manager_elementFormation = new ElementFormationManager($bdd);
        $manager_elementFormation->add($elementFormation, $cursus_etu);
        $manager_elementFormation->addToCursus($cursus_etu);
    }
    $ligne = fgets($fp, 4096);
    $liste = explode(";", $ligne); // On créé un tableau des éléments séparés par des ;
    $table = filter_input(INPUT_POST, 'userfile');
}
echo "<h1 align='center'>-Table Element de formation remplis-</h1>";

//Fermeture du fichier
fclose($fp);
?>
<<<<<<< HEAD

<h2><p align="center">Fin de l'import du cursus !</p></h2>

<form method="post" enctype="multipart/form-data" action="importcsv_form.html">
    <input name="submit" type="submit" value="Importer d'autres fichiers"/>
</form>
=======
<html>
    <head>
        <title>Page d'import</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="Bootstrap/css/bootstrap.min.css" >
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>

        <h2><p align="center">Fin de l'import du cursus !</p></h2>
        <div class="container">
<?php
button_Submit('../index.php', 'Acceuil');
?>
        </div>
    </body>
</html>
>>>>>>> grucheta
