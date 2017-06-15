<?php


?>
<html>
    <head>
        <title>Page d'authentification</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <h1>Veuillez vous authentifier</h1>
        <div><form action="../index.php" method="POST">
                <fieldset >
                    <legend align='center'>Rentrez votre numéro étudiant</legend>
                    <input type="text" name="id" value="" />
                    <input type="submit" value="authentification" name="choix" />
                </fieldset>
            </form></div>
    </body>
</html>