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

/*if (!isset($_POST['choix'])){
    $_SESSION['label']=$_POST['label'];
//Création DE l'array cursus à rentrer dans la bdd et persistance
    $cursus_manager= new CursusManager($db);
    $donnes =array('label'=>$_SESSION['label'],'etudiant'=>$_SESSION['id']);
    
//Ajout du cursus dans la bdd avant l'element de formation (car FK)
    $cursus=new Cursus($donnes);
    $cursus_manager->add($cursus);
    echo "<h1 align='center'>-Cursus importé-</h1>";
}*/
// Sous MAMP (Mac) $elem= new ElementFormation();

?>
 <html>
    <head>
        
        <title>Enregistrement de l'élément de formation</title>
        <link rel="stylesheet" href="../../../TD_TP/Include/Tp01_02.css">
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../Bootstrap/css/bootstrap.css" >
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
 
            
            <?php
            form_start('POST', 'element_formation_form_stock.php')
            ?>
            <fieldset>
            <legend align="center"> Ajouter l'élément de formation (UV et ses détails) </legend>
            <?php
            echo "<input type='hidden' value='' name='id'/>";
            input('sem_seq', 'text', 'sem_seq', "Semestre n° ");
           
            input('sem_label', 'text', 'sem_label', 'Label(ISI1..)');
            
            input('sigle', 'text', 'sigle', 'Sigle');
           ;
            input('catégorie', 'text', 'categorie', 'Catégorie(CS, TM)');
            
            ?>
            <div class="row">
            
                <div class="col-xs-4">
                    <div class="radio "> 
                        <strong>Affectation :</strong>
                        <label for="affectation1" class="radio">  
                            <input  type="radio" name="affectation" value="TC" id="affectation1"/>TC
                         </label>
                        <label for="affectation2" class="radio">
                            <input type="radio" name="affectation" value="TCBR" id="affectation2"/> TCBR
                         </label>
                        <label for="affectation3" class="radio">
                            <input type="radio" name="affectation" value="BR" id="affectatio3"/> BR
                         </label>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="radio">
                        <strong>Suivis à l'UTT :</strong>
                            <label for="utt1" class="radio">  
                                <input  type="radio" name="utt" value="Y" id="utt1"/>oui
                            </label>
                            <label for="utt2" class="radio">
                                <input   type="radio" name="utt" value="N" id="utt2"/>non
                            </label>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="radio">
                    
                        <strong>L'UE est-elle dans votre profil :</strong>
                        <label for="profil1" class="radio">  
                            <input  type="radio" name="profil" value="Y" id="profil1"/> oui
                        </label>
                        <label for="profil2" class="radio">
                            <input   type="radio" name="profil" value="N"id="profil2"/> non
                        </label>
                    </div>
                </div>
            </div>
            <br/>
            <?php
            
            echo "<div>";
            echo "<input type='hidden' value='' name='credit'/>";

            echo "</div>";
            input('resultat', 'text', 'resultat', 'Résultat');
            
           
            
            echo "<input type='hidden' value='' name='cursus'/>";
            
            ?>
            <div>                               
            <input class="btn btn-primary" type="submit" value="Submit">
            <input class="btn btn-primary" type="reset" value="Reset"> 
            </div>
            
            
        </fieldset> 
        <?php 

        form_end();
        ?>
            
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
    </body>
</html>