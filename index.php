<?php 
session_start(); 

include 'include/Formulaire_Dynamique_fonction.php';
include 'Classes/EtudiantManager.php';
include 'Classes/Etudiant.php';



$id = $_POST['id'];

$db = new PDO('mysql:host=localhost;dbname=projet_lo07;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$manager = new EtudiantManager($db);
echo "<h1>POST</h1>";
echo"<pre>";
print_r($_POST);
echo"</pre>";


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
    echo "<h1 aligne='center'>------Données------</h1>";
    echo "<h1 align='right'>Salut ".$donnes['prenom']."!</h1>";
    echo"<pre>";
    
    print_r($donnes);
    echo"</pre>";
    
}
$_SESSION=$donnes;
;

echo "<h1>SESSION</h1>";
echo"<pre>";
print_r($_SESSION);
echo"</pre>";

echo "<h1 align='center'>INDEX</h1>";

?>
<html>
    <head>
        <title>Index</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="Bootstrap/css/bootstrap.min.css" >
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <h2><div><a href="Fonctio5/importcsv_form.html">Test</a></div></h2>
        
        <h2><div><a href="Classes/ElementFormation.php">Error</a></div></h2>
        
        <h2><div><a href="Formulaires_Fonctio1/label_cursus_form.php">Creer un cursus</a></div></h2>

    </body>
</html>