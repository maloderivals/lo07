<?php
session_start(); // sur toutes nos pages 
 

include '../include/Formulaire_Dynamique_fonction.php';
include '../Classes/ElementFormationManager.php';
include '../Classes/ElementFormation.php';


// Sous MAMP (Mac) $elem= new ElementFormation();
$db = new PDO('mysql:host=localhost;dbname=projet_lo07;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$manager = new ElementFormationManager($db);

?>
 <html>
    <head>
        
        <title>Enregistrement de l'élément de formation</title>
        <link rel="stylesheet" href="../../../TD_TP/Include/Tp01_02.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
    <div>
     <form name="element" action="element_formation_form_stock.php" method="POST">
        <fieldset>
            <legend align="center"> Ajouter l'élément de formation (UV et ses détails) </legend> 
            
            <?php
            
            echo "<input type='hidden' value='' name='id'/>";
            input('sem_seq', 'text', 'sem_seq', "Semestre n° ");
            echo "<div>";
            input('sem_label', 'text', 'sem_label', 'Label(ISI1..)');
            echo "</div>";
            input('sigle', 'text', 'sigle', 'Sigle');
            echo "<div>";
            input('catégorie', 'text', 'categorie', 'Catégorie(CS, TM)');
            echo "</div>";
            input('affectation', 'text', 'affectation', "Affectation (TC...)");
            echo "<div>";
            ?>
            <div>
            <label for="utt"> Suivis à l'UTT ? </label>
            oui <input type="radio" name="utt" value="Y"/>
            non <input type="radio" name="utt" value="N"/>
            </div>
            <div>
            <label for="profil"> L'UE est-elle dans votre profil ? </label>
            oui <input type="radio" name="profil" value="Y"/>
            non <input type="radio" name="profil" value="N"/>
            </div>
            <?php
            
            echo "<div>";
            echo "<input type='hidden' value='' name='credit'/>";

            echo "</div>";
            input('resultat', 'text', 'resultat', 'Résultat');
            
           
            
            echo "<input type='hidden' value='' name='cursus'/>";
            
            ?>
            <div>                               
            <input type="submit" value="Envoyer" name='submit'/> 
            </div>
            
            <div>
            <input type="reset" value="Annuler" name='annuler'/>   
            </div>
            
        </fieldset> 
    </form>        
    </div>    
        
        
        
        
        
        
        
        
        
        
        
        
        
        
    </body>
</html>