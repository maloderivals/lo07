<?php
session_start(); // sur toutes nos pages 
 

include '../include/Formulaire_Dynamique_fonction.php';
include '../Classes/ElementFormationManager.php';
include '../Classes/ElementFormation.php';
include '../Classes/Cursus.php';
include '../Classes/CursusManager.php';
$db = new PDO('mysql:host=localhost;dbname=projet_lo07;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));


echo "<h1>POST</h1>";
echo '<pre>';
print_r($_POST);
echo "<h1>Session</h1>";
print_r($_SESSION);
echo '</pre>';

if (!isset($_POST['choix'])){
    $_SESSION['label']=$_POST['label'];
//Création DE l'array cursus à rentrer dans la bdd et persistance
    $cursus_manager= new CursusManager($db);
    $donnes =array('label'=>$_SESSION['label'],'etudiant'=>$_SESSION['id']);
    
//Ajout du cursus dans la bdd avant l'element de formation (car FK)
    $cursus=new Cursus($donnes);
    $cursus_manager->add($cursus);
    echo "<h1 align='center'>-Cursus importé-</h1>";
}
// Sous MAMP (Mac) $elem= new ElementFormation();

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
            <label for="affectation"> Affectation : </label>
            TC <input type="radio" name="affectation" value="TC"/>
            TCBR <input type="radio" name="affectation" value="TCBR"/>
            BR <input type="radio" name="affectation" value="BR"/>
            </div>
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