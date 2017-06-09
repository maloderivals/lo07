<head>
    <title>Import en cours</title>
</head>
<?php

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
<p align="center">- Importation réussie -</p>

<?php

//Importation de l'étu
$etu = array();
for ($i = 0; $i < 5; $i ++) {
    $ligne = fgets($fp, 4096);
    $liste = explode(";", $ligne);
    $table = filter_input(INPUT_POST, 'userfile');
$liste[$i] = (isset($liste[$i])) ? $liste[$i] : Null;
    $etu[$i] = $liste[$i];
}

$db = new mysqli('localhost', 'root', '', 'projet_lo07');
$sql = ("INSERT INTO etudiant(id, nom, prenom, admission, filiere) VALUES('$etu[0]','$etu[1]','$etu[2]','$etu[3]','$etu[4]')");
$resultEtu = $db->query($sql);

//Importation des éléments de l'étu
$ligne = fgets($fp, 4096);
$liste = explode(";", $ligne);
$table = filter_input(INPUT_POST, 'userfile');
$resultElem = array();
$r = 0;
while ($liste[0]!== "END") {
    if ($liste[0] === "EL") {
        $elementForm = array(); //Récupère les attributs de l'élément de formation en cours
        $i = 0;
        foreach ($liste as $element) { //plutot while debut ligne != END ...
            $element = (isset($element)) ? $element : Null;
            $elementForm[$i] = $element;
            $i ++;
        }
        $sql = ("INSERT INTO element_formation(sem_seq, sem_label, sigle, categorie, affectation, utt, profil, credit, resultat) "
                . "VALUES('$elementForm[1]','$elementForm[2]', '$elementForm[3]', $elementForm[4]', $elementForm[5]','$elementForm[6]','$elementForm[7]','$elementForm[8]','$elementForm[9]')");
        $resultElem[$r] = $db->query($sql);
        $r++;
    }
    $ligne = fgets($fp, 4096);
    $liste = explode(";", $ligne); // On créé un tableau des éléments séparés par des ;
    $table = filter_input(INPUT_POST, 'userfile');
}
//Fermeture du fichier
fclose($fp);
?>

<h2>Fin de l'import du cursus !</h2>