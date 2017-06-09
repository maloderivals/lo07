<?php
session_start(); // sur toutes nos pages 
 function Rentrez_UV($Nbre_UV){
 form_start('POST', 'element_formation_form_action.php');
 echo'<div>';
    for ($i=0;$i<$Nbre_UV;$i++){
        input('UV$i', 'text', $name, $text);
    }
 echo'</div>';
 
 }



 $elem= new ElementFormation($sem_seq, $sem_label, $sigle, $categorie, $affectation, $utt, $profil, $credit, $resultat);


include '../include/Formulaire_Dynamique_fonction.php';
include '../Classes/ElementFormationManager.php';
include '../Classes/ElementFormation.php';

// Sous MAMP (Mac)
$bdd = new PDO('mysql:host=localhost;dbname=Projet_LO07;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

$elem= new ElementFormation();
$elem->setcredit('38');

?>
 <html>
    <head>
        <title>Enregistrement de l'élément de formation</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
       
        <h1>
        <div>
           <?php 
           $Nbre_elem=$_POST['Nbre'];
           echo "'Vous avez donc ".$Nbre_elem." d'élement de formation à rentrée si vous voulez continuer";
           ?>
        </div>
        </h1>
        <div><?php
        
        ?></div>
        <div><?php
        
        ?></div>
        <div><?php
        
        ?></div>
        <div><?php
        
        ?></div>
        <div><?php
        
        ?></div>
        <div><?php
        
        ?></div>
        <div><?php?></div>
        <div><?php?></div>
        <div><?php?></div>
        <div><?php?></div>
        <div><?php?></div>
        
        

        <h1>
        <div>
           <?php 
           $Nbre_elem=$_POST['Nbre'];
           echo "'Vous avez donc ".$Nbre_elem." d'élement de formation à rentrée si vous voulez continuer";
           ?>
        </div>
        </h1>

    </body>
</html>