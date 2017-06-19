<html>
    <head>
        <title>Import du règlement</title>
        <link rel="stylesheet" href="../Bootstrap/css/bootstrap.min.css" >
    </head>
    <body>
        <?php
        include '../Classes/Reglement.php';
        include '../Classes/ReglementManager.php';
//include '../Classes/Regle.php';
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
        $bdd = new PDO('mysql:host=localhost;dbname=projet_lo07;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $ligne = fgets($fp, 4096);
        $liste = explode(";", $ligne);
        $nom = $liste[1];
        $reglement = new Reglement($nom); //Il faut ddemander à l'utilisateur de choisir un id plutôt
        $manager_reglement = new ReglementManager($bdd);
        $manager_reglement->add($reglement);



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
            if ($liste[2] === "ALL") {
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


//Fermeture du fichier
        fclose($fp);
        ?>

        <div class="container">
            <h2><p align="center">Fin de l'import du règlement !</p></h2>

            <form method="post" enctype="multipart/form-data" action="../Fonctio5/importcsv_form.html">
                <input class='btn btn-primary' name="submit" type="submit" value="Importer d'autres fichiers"/>
            </form>
        </div>
    </body>
</html>