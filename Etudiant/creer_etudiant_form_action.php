<?php

include '../include/Formulaire_Dynamique_fonction.php';
include '../Classes/EtudiantManager.php';
include '../Classes/Etudiant.php';

?>
<html>
    <head>
        <title>Création étudiant</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../../../TD_TP/Include/Tp01_02.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <form name="etudiant" action="creer_etudiant_form_stock.php" method="POST">
        <fieldset>
            <legend align="center"> Rentrez vos informations </legend> 
            
            <?php
            echo"<div>";
            input('id1', 'text', 'id1', 'Rentrez votre numéro étudiant');
            echo"</div>";
            echo"<div>";
            input('nom', 'text', 'nom', "Nom  ");
            echo"</div>";
            echo "<div>";
            input('prenom', 'text', 'prenom', 'Prenom  ');
            echo "</div>";
            ?>
            <label for="utt"> Vous avez commencé en : </label>
            TC <input type="radio" name="admission" value="TC"/>
            Branche <input type="radio" name="admission" value="BR"/>
            <?php
            echo"<div>";
            input('filiere', 'text', 'filiere', "Filiere ");
            echo"</div>";
            
           
            
            ?>
            
            <div>                               
            <input type="submit" value="Envoyer" name='submit'/> 
           
            
            
            <input type="reset" value="Annuler" name='annuler'/>   
            </div>
            
        </fieldset> 
    </form>        
    </div>    
    </body>
</html>