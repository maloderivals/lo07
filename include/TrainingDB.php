<?php
//Appelle de la base de donnée
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=OC_training;charset=utf8', 'root', 'root');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
        
}

$statement='SELECT * from `jeux_video` WHERE 1';

//Associe la BDD avec requète à une variable. Cpd, il ya trop de donnée
$reponse=$bdd->query($statement);

$compteur=1;

//$response->fetch()= une ligne de la bdd
while ($donnee = $reponse->fetch()){
        // <=> Tant que il y'a des lignes dans la bdd
    echo "<p>";
    echo"\n\n <strong>Jeu $compteur </strong>: ";
    $compteur++;
    echo $donnee['nom']."<br>";
    echo "A ".$donnee['possesseur']." sur ".$donnee['console']."<br/>";
    echo "Le jeu est au prix de ".$donnee['prix']." euros<br/>";
    echo "</p>";    
    
    
}
$reponse->closeCursor();