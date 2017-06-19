<?php
session_start();
include '../include/Formulaire_Dynamique_fonction.php';
include '../Classes/EtudiantManager.php';
include '../Classes/Etudiant.php';



?>
<html>
    <head>
        <title>Création étudiant</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../../../TD_TP/Include/Tp01_02.css">
        <link rel="stylesheet" href="../Bootstrap/css/bootstrap.css" >
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        
        
            
            <?php            
            form_start('POST', '../index.php');
            ?>
            <fieldset>
            <legend align="center"> Rentrez vos informations </legend> 
            <?php
            
            echo"<div>";
            input('id', 'text', 'id', 'Rentrez votre numéro étudiant');
            echo"</div>";
            echo"<div>";
            input('nom', 'text', 'nom', "Nom  ");
            echo"</div>";
            echo "<div>";
            input('prenom', 'text', 'prenom', 'Prenom  ');
            echo "</div>";
            ?>
            <div class="row">
            
                <div class="col-xs-4">
                    <div class="radio "> 
                        <strong>Vous avez commencé en :</strong>
                        <label for="utt1"> 
                            <input type="radio" name="admission" value="TC" id='utt1'/> TC
                        </label>
                        <label for="utt2">
                            <input type="radio" name="admission" value="BR" id='utt2'/> Branche
                        </label>
                    </div>
                </div>
            </div>
            <br/>
            <?php
            echo"<div>";
            input('filiere', 'text', 'filiere', "Filiere (MPL/MRI/MSI)");
            echo"</div>";
            
           
            
            ?>
            
            <div>                               
                <input input="btn btn-primary" name='choix' type="submit" value="inscription">
                <input input="btn btn-primary" type="reset" value="Reset"> 
            </div>
            </fieldset> 
            <?php 
            echo form_end();
            ?>
        
        <script type="text/javascript">


            function validateForm() {
                //id
                var idValue = document.forms["FormIdentite"]["id"].value;



                if ((!isNaN(idValue)) || (idValue > 100000) || (idValue < 0)||(idValue === "")) {

                    alert("Le numéro étudiant est positif, le champ doit obligatoirement être renseigné");

                    return false;

                }
                //nom
                var nomValue = document.forms["FormIdentite"]["nom"].value;

                var nomValueUpper = nomValue.toUpperCase();

                if ((!isNaN(nomValue)) || (nomValue !== nomlValueUpper) || (nomValue === "")) {

                    alert("");

                    return false;

                }
                //prenom 
                var prenomValue = document.forms["FormIdentite"]["prenom"].value;

                var prenomValueUpper = prenomValue.toUpperCase();
                
                var prenomLength=prenomValue.length;

                if ((!isNaN(prenomValue)) || (prenomValue !== prenomValueUpper) || (prenomValue === "") || prenomLength > 5 ) {

                    alert("Le sigle de l'UV doit être en majuscule, il ne peut dépasser 5 caractères");

                    return false;
                }
                //admission

                var admissionValue = document.forms["FormIdentite"]["admission"].value;

                var admissionValueUpper = admissionValue.toUpperCase();
                var admissionLength=admissionValue.length;

                if ((!isNaN(admissionValue)) || (admissionValue !== admissionValueUpper) || (admissionValue === "") || admissionLength > 4 {

                    alert("La catégorie de l'élement de formation et une chaine de 4 caractère au maximum en majuscule");

                    return false;
                }
                //filiere

                var filiereValue = document.forms["FormIdentite"]["filiere"].value;

                var filiereValueUpper = filiereValue.toUpperCase();
                
                var filiereLength=filiereValue.length;

                if ((!isNaN(filiereValue)) || (filiereValue !== filiereValueUpper) || (filiereValue === "") || filiereLength > 4 ) {

                    alert("L'affectation de l'élement de formation et une chaine de 4 caractère au maximum en majuscule (FCBR...)");

                    return false;
                }
                
                alert('Tout est OK');

                return true;



            }

        </script>

       
    </body>
</html>