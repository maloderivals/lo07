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
                <input class="btn btn-primary" type="submit" value="Submit">
                <input class="btn btn-primary" type="reset" value="Reset"> 
            </div>
            </fieldset> 
            <?php 
            echo form_end();
            ?>
        
        
       
    </body>
</html>