<head>
    <title>Vérification du Cursus</title>
</head>

<?php

$i = 0;
foreach ($_GET as $cle => $valeur) {
            echo ("<li>$i) $cle = $valeur </li>");
            $i+=1; 
        }