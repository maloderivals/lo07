<?php
session_start();

include '../include/Formulaire_Dynamique_fonction.php';
include '../Classes/ElementFormationManager.php';
include '../Classes/ElementFormation.php';
include '../Classes/EtudiantManager.php';
include '../Classes/Etudiant.php';

$db = new PDO('mysql:host=localhost;dbname=projet_lo07;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$manager = new ElementFormationManager($db);



/*$etu =new etudiant;
$managerEtu= new EtudiantManager($db);

$etu = $managerEtu;
*/
$nom=$_SESSION['nom'];
$id=$_SESSION['id1'];

if ($_POST['resultat']=='A' || $_POST['resultat']=='B' || $_POST['resultat']=='C'|| $_POST['resultat']=='D'){
    $_POST['credit'] = 6;    
}
else{
    $_POST['credit'] = 0; 
}


$_POST['cursus']='cursus'.$nom;
$_POST['id']=$_POST['sigle'].$id;

$donnes=$_POST;

$elem= new ElementFormation($donnes);


//$manager->add($elem);

    

//cette page enregistre les informationjs dans la base de donné
echo '<pre>';

print_r($_POST);
print_r($_SESSION);

echo '</pre>';
echo "<div>";
form_start('POST', 'element_formation_form_action.php');
?>
<input type="submit" value="Rentrer un autre EF" name="Rentrer un autre EF" />
<?php
form_end(); 
echo "</div>";
echo "<div>";
form_start('POST', '../index.php');
?>
<input type="submit" value="Acceuil principal" name="Rentrer un autre EF" />
<?php
form_end(); 
echo "</div>";
// Cette page peut me renvoiyer à l'acceuil
// Cette page peut me faire rerentrer une UE
?>



