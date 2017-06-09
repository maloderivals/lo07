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
    <div>
     <form name="element" action="element_formation_form_stock.php" method="POST">
        <fieldset>
            <legend align="center"> Ajouter l'élément de formation (UV et ses détails) </legend> 
            <?php 
            input('sem_seq', 'text', 'sem_seq', "Rentrer le semestre au quel vous avez effectuer l'UE (1 pour votre premier semestre, 2 pour le 2ème...)");
            echo "<div>";
            input('sem_label', 'text', 'sem_label', 'Quel était le label du semestre ? (ISI1 / ISI2) ? ');
            echo "</div>";
            input('sigle', 'text', 'sigle', 'Rentrer le sigle de l\UV (exemple : NF04)');
            echo "<div>";
            input('catégorie', 'text', 'catégorie', 'Rentrez la catégorie');
            echo "</div>";
            input('affectation', 'text', 'affectation', "Rentrez l'affectation de l'UE (TC TCBR FCBR)");
            echo "<div>";
            ?>
            <label for="utt"> L'UE a-t-elle était suivis à l'UTT ? </label>
            oui <input type="radio" name="utt" value="Y"/>
            non <input type="radio" name="utt" value="N"/>
            
            <label for="profil"> L'UE a-t-elle était suivis à l'UTT ? </label>
            oui <input type="radio" name="profil" value="Y"/>
            non <input type="radio" name="profil" value="N"/>
            
            <?php
            echo "</div>";
            input('profil', 'text', 'profil', "L'UV fait-elle partus de votre profil ?");
            echo "<div>";
            input('credit', 'text', 'credit', 'Combien de crédit avez-vous obtenus ?');
            echo "</div>";
            input('resultat', 'text', 'resultat', 'Votre résultat ?');
            
           
            
            
            
            ?>
            <div>
                <label for='nbre_sem'>Nombre de semestre : </label><input type='text' name='nbre_sem' id='name' autofocus placeholder="Nombre de semestre"> 
            </div>
            <input type="submit" value="Envoyer" name='submit'/> <input type="reset" value="Annuler" name='annuler'/>                       
        </fieldset> 
    </form>        
    </div>    
        
        
        
        
        
        
        
        
        
        
        
        
        
        
    </body>
</html>