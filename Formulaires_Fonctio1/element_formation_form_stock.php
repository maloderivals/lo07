<?php
include '../Classes/ElementFormationManager.php';
include '../Classes/ElementFormation.php';

$db = new PDO('mysql:host=localhost;dbname=projet_lo07;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$manager = new ElementFormationManager($db);
$key=0;


$donnes=$_POST;
$elem= new ElementFormation($donnes);

$manager->add($elem);

    

//cette page enregistre les informationjs dans la base de donné
echo '<pre>';
print_r($_POST);
echo '</pre>';

// Cette page peut me renvoiyer à l'acceuil
// Cette page peut me faire rerentrer une UE

