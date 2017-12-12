<?php
session_start(); // sur toutes nos pages 


include '../include/Formulaire_Dynamique_fonction.php';
include '../Classes/ElementFormationManager.php';
include '../Classes/ElementFormation.php';
include '../Classes/Cursus.php';
include '../Classes/CursusManager.php';
$db = new PDO('mysql:host=localhost;dbname=projet_lo07;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$cursus_manager = new CursusManager($db);

/*echo "<h1>POST</h1>";
echo '<pre>';
print_r($_POST);
echo "<h1>Session</h1>";
print_r($_SESSION);
echo '</pre>';
*/
$used = 0;
if (!isset($_POST['choix'])) {
    if (isset($_POST['label'])) {

        $tab = $cursus_manager->getListCursus();
        foreach ($tab as $value) {
            echo "$used";
//On vérifie si un nom de labl a déjà été rentrée
            if ($value->getLabel() == $_POST['label']) {
                $used = 1;
                printf('<h1>La nom de votre label est déjà utilisé</h1>');
                echo "<div class='container'>";
                button_Submit('label_cursus_form.php', 'Retour a la définition du Nom du cursus', '3');
                echo "</div>";
            }
        }
    }

    $_SESSION['label'] = $_POST['label'];
//Création DE l'array cursus à rentrer dans la bdd et persistance

    $donnes = array('label' => $_SESSION['label'], 'etudiant' => $_SESSION['id']);

//Ajout du cursus dans la bdd avant l'element de formation (car FK)
    if ($used == 0) {
        $cursus = new Cursus($donnes);
        $cursus_manager->add($cursus);
        echo "<h1 align='center'>-Cursus importé-</h1>";
    }
}
?>
<html>
    <head>

        <title>Enregistrement de l'élément de formation</title>
        
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../Bootstrap/css/bootstrap.css" >
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>


        <?php
        if ($used == 0) {
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
        }
        ?>

        <script type="text/javascript">


            function validateForm() {

                var sem_seqValue = document.forms["FormIdentite"]["sem_seq"].value;



                if ((!isNaN(sem_seqValue)) || (sem_seqValue < 20) || (sem_seqValue === "")) {

                    alert("Le numéro du semestre doit être un entier et compris entre 1 et 20");

                    return false;

                }

                var sem_labelValue = document.forms["FormIdentite"]["sem_label"].value;

                var sem_labelValueUpper = sem_labelValue.toUpperCase();

                if ((!isNaN(sem_labelValue)) || (sem_labelValue !== sem_labelValueUpper) || (sem_labelValue === "")) {

                    alert("Le label du semestre doit être une chaine de caractères en majuscule et ne peut pas être vide");

                    return false;

                }
                //sigle 
                var sigleValue = document.forms["FormIdentite"]["sigle"].value;

                var sigleValueUpper = sigleValue.toUpperCase();
                
                var sigleLength=sigleValue.length;

                if ((!isNaN(sigleValue)) || (sigleValue !== sigleValueUpper) || (sigleValue === "") || sigleLength > 5 ) {

                    alert("Le sigle de l'UV doit être en majuscule, il ne peut dépasser 5 caractères");

                    return false;
                }
                //categorie

                var categorieValue = document.forms["FormIdentite"]["categorie"].value;

                var categorieValueUpper = categorieValue.toUpperCase();
                var categorieLength=categorieValue.length;

                if ((!isNaN(categorieValue)) || (categorieValue !== categorieValueUpper) || (categorieValue === "") || categorieLength > 4 {

                    alert("La catégorie de l'élement de formation et une chaine de 4 caractère au maximum en majuscule");

                    return false;
                }
                //affectation

                var affectationValue = document.forms["FormIdentite"]["affectation"].value;

                var affectationValueUpper = affectationValue.toUpperCase();
                
                var affectationLength=affectationValue.length;

                if ((!isNaN(affectationValue)) || (affectationValue !== affectationValueUpper) || (affectationValue === "") || affectationLength > 4 ) {

                    alert("L'affectation de l'élement de formation et une chaine de 4 caractère au maximum en majuscule (FCBR...)");

                    return false;
                }
                //utt
                var uttValue = document.forms["FormIdentite"]["utt"].value;

               

                if ((!isNaN(uttValue)) || (uttValue === "")) {

                    alert("Vous devez cocher si vous avez effectué l'Elélément de formation à l'UTT ou pas !");

                    return false;
                }

                //profil

                var profilValue = document.forms["FormIdentite"]["profil"].value;


                if ((!isNaN(profilValue))  || (profilValue === "")) {

                    alert("Vous devez cochez si l'élément d formation fais partie de votre profil ou pas");

                    return false;
                }

                /*
                 var prenomValue = document.forms["FormIdentite"]["prenom"].value;
                 
                 var prenomValueLower = prenomValue.toLowerCase();
                 
                 if ( (!isNaN(prenomValue)) || (prenomValue !== prenomValueLower) || (prenomValue === "")) {
                 
                 alert("Prénom doit être un chaine de caractères en minuscule et ne peut pas être vide");
                 
                 return false;
                 
                 }                
                 
                 
                 
                 var ageValue = document.forms["FormIdentite"]["age"].value;                
                 
                 if ( (isNaN(ageValue)) || (ageValue < 18) || (ageValue === "")) {
                 
                 alert("Age doit être un numérique supérieur à 18 et ne peut pas être vide");
                 
                 return false;
                 
                 }     
                 
                 
                 */
                alert('Tout est OK');

                return true;



            }

        </script>














    </body>
</html>