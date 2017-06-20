<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Importe un fichier gros</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../Bootstrap/css/bootstrap.min.css" >
    </head>
    <body>
        
        <div><a href='../Fonctio2/choisirCursus.php' title="n'ayez pas peur cliquez !!!! ">choisir un cursus à analyser</a></div>
        
        <div>
            <h2>Choisis ton cursus p'tit gars</h2>
            <form method="post" enctype="multipart/form-data" action="importCursusCsv.php">
                <input name ="userfile" type="file" value="table" />
                <input name="submit" type="submit" value="Importer"/><br>
            </form>
        </div>

        <div>
            <h2>Choisis ton règlement poto</h2>
            <form method="post" enctype="multipart/form-data" action="../Fonctio3/importReglementCsv.php">
                <input name ="userfile" type="file" value="table" />
                <input name="submit" type="submit" value="Importer"/>
            </form>
        </div>

        <div>
            <h2>Sélectionne un cursus à vérifier</h2>
            try
            {
            $bdd = new PDO('mysql:host=localhost;dbname=projet_lo07;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            }
            catch(Exception $e)
            {
            die('Erreur : '.$e->getMessage());
            }
            ?>
            <form method="post" action="../Fonctio3/verificationCursus.php">
                <p>
                    <label>Cursus</label><br />
                    <select name="cursus" id="cursus">

                        <?php

                        $q = $this->bdd->query("SELECT label FROM cursus");

                        while ($donnees = $q->fetch()){
                        ?>
                        <option value="<?php echo $donnees['cursus']; ?>"> <?php echo $donnees['label']; ?></option>
                        <?php
                        }

                        ?>
                    </select>

                    <label>Nom du règlement</label>
                    <select name="reglement" id="reglement">

                        <?php

                        $q = $this->bdd->query("SELECT nom_reglement FROM reglement");

                        while ($donnees = $q->fetch()){
                        ?>
                        <option value="<?php echo $donnees['reglement']; ?>"> <?php echo $donnees['nom_reglement']; ?></option>
                        <?php
                        }

                        ?>
                    </select>

                    <input name="submit" type="submit" value="Vérifier"/>
                </p>
            </form>
        </div>

        <div>
            <form method="post" action="../Fonctio2/visualiserCursus.php">
                <p>
                    <label>Visualiser un cursus</label>
                    <input name="submit" type="submit" value="Check ça !"/>
                </p>
            </form>
        </div>
    </body>

</html>