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
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
     <form name="element" action="element_formation_form_action.php" method="POST">
        <fieldset>
            <legend align="center"> Rentrez l'élément de formation (UV et ses détails) </legend> 
            
            <div>
                <label for='nbre_sem'>Nombre de semestre : </label><input type='text' name='nbre_sem' id='name' autofocus placeholder="Nombre de semestre"> 
            </div>
            <input type="submit" value="Envoyer" name='submit'/> <input type="reset" value="Annuler" name='annuler'/>                       
        </fieldset> 
    </form>
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
    </body>
</html>