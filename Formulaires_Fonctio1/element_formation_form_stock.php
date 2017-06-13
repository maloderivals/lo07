<?php
session_start();

include '../include/Formulaire_Dynamique_fonction.php';
include '../Classes/ElementFormationManager.php';
include '../Classes/ElementFormation.php';
include '../Classes/EtudiantManager.php';
include '../Classes/Etudiant.php';
include '../Classes/Cursus.php';
include '../Classes/CursusManager.php';
$db = new PDO('mysql:host=localhost;dbname=projet_lo07;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$manager = new ElementFormationManager($db);

function cursusNom_n(array $tab){
    
    $size = count($tab);
    echo "<h1><div>$size<d/iv></h1>";
    $n=1;
    /*
    for ($i=1;$i<=$size;$i++){
        if ($tab[$i]=!$tab[$i+1]){
            $n++;
        }
    }*/
    return $n;
}

/*$etu =new etudiant;
$managerEtu= new EtudiantManager($db);

$etu = $managerEtu;
*/

$nom=$_SESSION['nom'];
$id=$_SESSION['id'];



//Calcul de 'crédit' en fonction du résultat
    if ($_POST['resultat']=='A' || $_POST['resultat']=='B' || $_POST['resultat']=='C'|| $_POST['resultat']=='D'){
        $_POST['credit'] = 6;    
    }
    else{
        $_POST['credit'] = 0; 
    }
    

    
//Le but est d'afficher dans la table element de formation cursusNom_n ou n est le nbre de cursus qu'un étudiant à créer 
    $stock=$manager->getAllCursus();
    
    $n= cursusNom_n($stock);
    echo $n;
//print_r($stock);
    
//Création DE l'array cursus à rentrer dans la bdd et persistance
    $cursus_manager= new CursusManager($db);
    $donnes =array('label'=>'cursus'.$nom.$n,'etudiant'=>$id);
    
//Ajout du cursus dans la bdd avant l'element de formation (car FK)
    $cursus=new Cursus($donnes);
    $cursus_manager->add($cursus);
    
 
    
    
    echo "<h1>All_cursus</h1>";
    echo '<pre>';
    print_r();
    echo '</pre>';

//adaptation de l'id et de cursus de element de formation dans la bdd    
$_POST['cursus']='cursus'.$nom.$n;
$_POST['id']=$_POST['sigle'].$id.$n;
$donnes=$_POST;
echo "<h1>POST</h1>";
echo '<pre>';
print_r($_POST);

echo "<h1>Session</h1>";
print_r($_SESSION);
echo '</pre>';

//ajout de l'élément de formation dans la base de données
$elem= new ElementFormation($donnes);
$manager->add($elem);


echo "<div>";
form_start('POST', 'element_formation_form_action.php');
?>
<input type="submit" value="Rentrer un autre Element de Formation" name="EF" />
<?php
form_end(); 
echo "</div>";
echo "<div>";
form_start('POST', '../index.php');
?>
<input type="submit" value="Acceuil principal" name="choix" />
<?php
form_end(); 
echo "</div>";
// Cette page peut me renvoiyer à l'acceuil
// Cette page peut me faire rerentrer une UE
?>



