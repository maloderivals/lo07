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

$cpt = 0; //Permet de compter le nombre d'enregistrements réalisés
?>
<p align="center">- Importation réussie -</p>

<?php  //Importation
  while (!feof($fp)){
      $ligne = fgets($fp, 4096);
      $liste = explode(" ; ", $ligne); // On créé un tableau des éléments séparés par des ;
      $table = filter_input(INPUT_POST, 'userfile');
  }
