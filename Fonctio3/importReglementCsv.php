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

        
        $bdd = new PDO('mysql:host=localhost;dbname=projet_lo07;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $csv = file_get_contents($_FILES['userfile']['tmp_name']);
        $csv_lines = preg_split('/\\r\\n|\\r|\\n/', $csv);
        $liste=explode(';',$csv_lines[0]);
        $nom = $liste[1];
        
        $reglement = new Reglement($nom); //Il faut ddemander à l'utilisateur de choisir un id plutôt
        $manager_reglement = new ReglementManager($bdd);
        $manager_reglement->add($reglement);



//Importation des regles
$count = count($csv_lines); // compter les règles
        for ($i=1;$i<$count;$i++) {
            
            $liste = explode(";", $csv_lines[$i]); 
            
            $regle_array = array("id_regle" => $reglement->getId_reglement() . $liste[0]);
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
             
            $regle_array["id_reglement"] = $reglement->getId_Reglement();
            
            $regle = new Regle($regle_array);
            $manager_regle = new RegleManager($bdd);
            $manager_regle->add($regle);
        }
        ?>

        <div class="container">
            <h2><p align="center">Fin de l'import du règlement !</p></h2>

            <form method="post" enctype="multipart/form-data" action="../Fonctio5/importcsv_form.php">
                <input class='btn btn-primary' name="submit" type="submit" value="Importer d'autres fichiers"/>
            </form>
            <a class="btn btn-primary" href="../index.php">Accueil</a>
        </div>
    </body>
</html>