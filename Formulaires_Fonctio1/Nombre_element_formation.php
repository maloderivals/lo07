<?php

include ('../include/Formulaire_Dynamique_fonction.php');
?>

<html>
    <head>
        <title>TODO supply a title</title>
        <link rel="stylesheet" href="../Include/Tp01_02.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <h1><div>
        <?php
        form_start('POST', 'element_formation_form_action.php');
        input('Nbre','text','Nbre',"Rentrer le nombre d'élément de formation que vous allez entrer pour operer sur votre cursus à l'UTT");
        form_end();
        ?>
        </div>
        </h1>
    </body>
</html>