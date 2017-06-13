<?php 
session_start(); 

include 'include/Formulaire_Dynamique_fonction.php';
include 'Classes/EtudiantManager.php';
include 'Classes/Etudiant.php';


$_SESSION['NbreEF']=0;


$db = new PDO('mysql:host=localhost;dbname=projet_lo07;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$manager = new EtudiantManager($db);
echo "<h1>POST</h1>";
echo"<pre>";
print_r($_POST);
echo"</pre>";

// Pour celui qui s'inscrit 
if ($_POST['choix']=='inscription'){
    $donnes=$_POST;
    
    $_SESSION['id1']=$_POST['id'];
    //fonction ajouter étudiant dans la base de donnée
    $etu = new etudiant($donnes);
    $manager->add($etu);
    
    
}
//Pour celui qui s'authentifie
else if ($_POST['choix']=='authentification'){
    
    //Fonction récupérer information de l'étudiant dans la base de données
    $etu = $manager->get($_POST['id']);
    $donnes=$manager->Array_out($etu);
    echo "<h1>Données</h1>";
    echo"<pre>";
    print_r($donnes);
    echo"</pre>";
    
}
$_SESSION=$donnes;

echo "<h1 align='center'>INDEX</h1>";
echo "Sacré projet mamene";
?>
<html>
    <head>
        <title>Index</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <h2><div><a href="Formulaires_Fonctio1/Nombre_element_formation.php">Test</a></div></h2>
        
        <h2><div><a href="Classes/ElementFormation.php">Error</a></div></h2>
        
        <h2><div><a href="Formulaires_Fonctio1/element_formation_form_action.php">Creer un cursus</a></div></h2>

    </body>
</html>