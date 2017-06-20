<?php
session_start();

//declaration des fichiers
include '../include/Formulaire_Dynamique_fonction.php';
include '../Classes/ElementFormationManager.php';
include '../Classes/ElementFormation.php';
include '../Classes/EtudiantManager.php';
include '../Classes/Etudiant.php';
include '../Classes/Cursus.php';
include '../Classes/CursusManager.php';
$db = new PDO('mysql:host=localhost;dbname=projet_lo07;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$manager = new ElementFormationManager($db);




/*echo "<h1>POST</h1>";
echo '<pre>';
print_r($_POST);
echo "<h1>Session</h1>";
print_r($_SESSION);
echo '</pre>';

*/
?>

<html>
    <head>
        <title>Création de votre CURSUS</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../Bootstrap/css/bootstrap.css" >
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <?php
            form_start('POST','element_formation_form_action.php');
                echo"<fieldset>";
                echo "<legend><h1>Création d'un CURSUS</h1></legend>";
                echo "<br/><br/><br/><br/>";
                    echo"<div>";
                        input('label', 'text', 'label', 'Attribuez un nom unique au cursus que vous allez créer');
                    echo"</div>"; 
                echo"</fieldset>";
                ?>
        <input class="btn btn-primary"  name='input' type="submit" value="Création">
                <input class="btn btn-primary"  type="reset" value="Reset"> 
        <?php
            form_end();
        ?>
    </body>
</html>

