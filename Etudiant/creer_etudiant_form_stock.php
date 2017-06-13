<?php
session_start();

include '../include/Formulaire_Dynamique_fonction.php';
include '../Classes/EtudiantManager.php';
include '../Classes/Etudiant.php';

$_SESSION = $_POST;

$db = new PDO('mysql:host=localhost;dbname=projet_lo07;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$manager = new EtudiantManager($db);
echo"<pre>";
print_r($_POST);
echo"</pre>";


?>
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div><a href='../index.php'>Regarde</a></div>
    </body>
</html>