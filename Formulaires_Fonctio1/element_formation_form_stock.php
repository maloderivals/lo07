<?php
session_start();

include '../include/Formulaire_Dynamique_fonction.php';
include '../Classes/ElementFormationManager.php';
include '../Classes/ElementFormation.php';
include '../Classes/EtudiantManager.php';
include '../Classes/Etudiant.php';
include '../Classes/Cursus.php';
include '../Classes/CursusManager.php';
$db = new PDO('mysql:host=localhost;dbname=projet_lo07;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$manager = new ElementFormationManager($db);


//Variable intermediares
$nom=$_SESSION['nom'];
$id=$_SESSION['id'];



//Calcul de 'crédit' en fonction du résultat
    if ($_POST['resultat']=='A' || $_POST['resultat']=='B' || $_POST['resultat']=='C'|| $_POST['resultat']=='D'){
        $_POST['credit'] = 6;    
    }
    else{
        $_POST['credit'] = 0; 
    }
    

    

    
 
    
    
    
//adaptation de l'id et de cursus de element de formation dans la bdd    
$_POST['cursus']=$_SESSION['label'];
$_POST['id']=$_POST['sigle'].$id;
$donnes=$_POST;


echo "<h1>POST</h1>";
echo '<pre>';
print_r($_POST);

echo "<h1>Session</h1>";
print_r($_SESSION);
echo '</pre>';

//ajout de l'élément de formation dans la base de données
$elem= new ElementFormation($donnes);
$manager->add($elem);
echo "<h1>EF importé</h1>";

echo "<div>";
form_start('POST', 'element_formation_form_action.php');
?>
<input type="submit" value="Rentrer un autre Element de Formation" name="choix" />
<?php
form_end(); 
echo "</div>";
echo "<div>";
form_start('POST', '../index.php');
?>
<input type="submit" value="Acceuil principal" name="choix" />
<?php
form_end(); 
echo "</div>";
// Cette page peut me renvoiyer à l'acceuil
// Cette page peut me faire rerentrer une UE
?>



<html>
    <head>
        
        <title></title>
        <link rel="stylesheet" href="../../../TD_TP/Include/Tp01_02.css">
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../Bootstrap/css/bootstrap.css" >
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        
    </body>
</html>