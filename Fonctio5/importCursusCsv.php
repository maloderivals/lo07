<html>
<head>
    <link rel="stylesheet" href="../Bootstrap/css/bootstrap.min.css" >
    <title>Import en cours</title>
</head>
<body>
    <?php
include '../Classes/Etudiant.php';
include '../Classes/EtudiantManager.php';
include '../Classes/ElementFormation.php';
include '../Classes/ElementFormationManager.php';
include '../Classes/Cursus.php';
include '../Classes/CursusManager.php';



extract(filter_input_array(INPUT_POST));
$csv = file_get_contents($_FILES["userfile"]["tmp_name"]);






$csv_lines = preg_split('/\\r\\n|\\r|\\n/', $csv);

//Importation de l'étu
$etu = array();
for ($i = 0; $i < 5; $i ++) {
    
    

    $liste = explode(";", $csv_lines[$i]);
    
    $etu[$i] = $liste[1];
     
}

$hashEtu = array("id" => $etu[0], "nom" => $etu[1], "prenom" => $etu[2], "admission" => $etu[3], "filiere" => $etu[4]);

$etudiant = new etudiant($hashEtu);
$bdd = new PDO('mysql:host=localhost;dbname=projet_lo07;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$manager_etu = new EtudiantManager($bdd);
$manager_etu->add($etudiant);


//Création du cursus
// label = nom du fichier Ou sinon on peut demander à l'utilisateur de donner un label
$nom = basename($_FILES['userfile']['name'], '.csv');
$array_cursus = array ('label' => $nom, 'etudiant' => $etudiant->getId());
$cursus_etu = new Cursus($array_cursus);
$manager_cursus = new CursusManager($bdd);
$manager_cursus->add($cursus_etu);

$attributs = array("sem_seq", "sem_label", "sigle", "categorie", "affectation", "utt", "profil", "credit", "resultat");

//Importation des éléments du cursus de l'étudiant





$y=6;

while ($liste[0] !== "END") {
    if ($liste[0] === "EL") {
        $elementForm = array("id" => $liste[3] . $etudiant->getId());
        for ($i = 0; $i < 9; $i++) {
            $elementForm[$attributs[$i]] = $liste[$i + 1];   //Récupère les attributs de l'élément de formation en cours
        }
        
        $elementForm['cursus']=$cursus_etu->getLabel();
        $elementFormation = new ElementFormation($elementForm);
        $manager_elementFormation = new ElementFormationManager($bdd);
        $manager_elementFormation->add($elementFormation, $cursus_etu);
    }
    $liste = explode(";", $csv_lines[$y]);
    $y++;
}


//Fermeture du fichier

?>

<h2><p align="center">Fin de l'import du cursus !</p></h2>
<br/>
<br/>

<div class="container">

                    <div class="row">
                        <div class='col-xs-2 '>
                            <a class='btn btn-primary btn-lg active' role='button' aria-pressed='true' href='../Fonctio3/ChoisirCursusVerifier.php' role='button'>Analysercursus</a>
                            </div>
                        <div class="col-xs-9">
                            <div class='col-xs-2 col-xs-offset-1'>
                                <a class='btn btn-primary btn-lg active' role='button' aria-pressed='true' href='../index.php' role='button'>Accueil</a>
                            </div>
                            <div class='col-xs-3'>
                                <a class='btn btn-primary btn-lg active' role='button' aria-pressed='true' href='../Fonctio2/choisirCursus.php' role='button'>Visualiser Cursus</a>
                            </div>
                            <div class='col-xs-3 '>
                                <a class='btn btn-primary btn-lg active' role='button' aria-pressed='true' href='importcsv_form.php' role='button'>Importer un autre Cursus</a>
                            </div>
                        </div>
                    </div>
                </div>

</body>
</html>