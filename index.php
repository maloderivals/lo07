<?php 
session_start(); 

include 'include/Formulaire_Dynamique_fonction.php';
include 'Classes/EtudiantManager.php';
include 'Classes/Etudiant.php';

if(isset($_POST['choix'])){
if ($_POST['choix']=='inscription' || $_POST['choix']=='authentification'){
$id = $_POST['id'];
}
$db = new PDO('mysql:host=localhost;dbname=projet_lo07;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

$manager = new EtudiantManager($db);
/*echo "<h1>POST</h1>";
echo"<pre>";
print_r($_POST);
echo"</pre>";
*/

// Pour celui qui s'inscrit 
if ($_POST['choix']=='inscription'){
    $donnes=$_POST;
    
    $_SESSION['id']=$_POST['id'];
    //fonction ajouter étudiant dans la base de donnée
    $etu = new etudiant($donnes);
    $manager->add($etu);
    echo "<h1>Etudiant importé</h1>";
    
}
//Pour celui qui s'authentifie
else if ($_POST['choix']=='authentification'){
    
    //Fonction récupérer information de l'étudiant dans la base de données
    $etu = $manager->get($id);
    $donnes=$manager->Array_out($etu);
   /* echo "<h1 aligne='center'>------Données------</h1>";
    
    echo"<pre>";
    
    print_r($donnes);
    echo"</pre>";
    */
}
if ($_POST['choix']=='inscription' || $_POST['choix']=='authentification'){
    
$_SESSION=$donnes;
}
}


?>
<html>
    <head>
        <title>Index</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="Bootstrap/css/bootstrap.min.css" >
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div class="container">
            <h1>INDEX</h1>
            <div class="row">
                <div class="col-xs-10">
                Salut<strong> <?php 
                if (isset($_SESSION['prenom']))
                {
                    echo $_SESSION['prenom']; 
                }
                ?> </strong>!!!! Bienvenue sur notre nouveau site spécial ISI, fais ton choix : 
                </div>
            </div>
                
            <div class="row">
                <?php
             echo "<br>";
             echo "<br>";
                button_Submit('Fonctio5/importcsv_form.php', 'Importer un cursus ou un reglement','0');
                button_Submit('Formulaires_Fonctio1/label_cursus_form.php', 'Créer un cursus','1');
                button_Submit('Fonctio2/choisirCursus.php', 'Visualiser cursus','0');
            echo"</div>";
            echo "<br>";
            echo "<div class= 'row'>";
                button_Submit('Fonctio2/choisirCursus.php', 'Comparer un cursus','0');
                button_Submit('Fonctio3/ChoisirCursusVerifier.php', 'Analyser un cursus','1');
                button_Submit('1erePage.php', 'Se déconnecter','0');
                ?>

                



                
            </div>
        </div>
    </body>
</html>