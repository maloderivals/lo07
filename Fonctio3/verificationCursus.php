<<<<<<< HEAD
<head>
    <title>Vérification du Cursus</title>
    <link rel="stylesheet" href="../Bootstrap/css/bootstrap.min.css" >
</head>

<?php
include '../Classes/Etudiant.php';
include '../Classes/EtudiantManager.php';
include '../Classes/ElementFormation.php';
include '../Classes/ElementFormationManager.php';
include '../Classes/Cursus.php';
include '../Classes/CursusManager.php';
include '../Classes/ReglementManager.php';

$bdd = new PDO('mysql:host=localhost;dbname=projet_lo07;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

//Récupération des infos du règlement choisi
$recupReg = $_POST['listReglements'];
$reglement = new Reglement($recupReg);
$reglement_manager = new ReglementManager($bdd);

//Récupération des infos du cursus choisi
$recup = $_POST['listCursus'];
$curs = explode(" - ", $recup);

$cursus = new Cursus($curs[0], $curs[1]);
$cursus_manager = new CursusManager($bdd);
$etu_manager = new EtudiantManager($bdd);
$etudiant = $etu_manager->get($cursus->getEtudiant());
$manager_elem = new ElementFormationManager($bdd);


//Récupération des éléments du cursus
$listElements = $cursus_manager->getList($cursus);
$listRegles = $reglement_manager->getRegles($reglement);


$res = $cursus->cursus_conforme($listRegles, $listElements);

/* if (count($res) === 0) {
  print_r("Ce cursus est conforme, ton diplôme t'attend à la scolarité. Bravo " . $etudiant->getPrenom() . " !");
  var_dump($res);
  } else {
  print_r("Retourne bosser " . $etudiant->getPrenom() . " !");
  var_dump($res);
  } */
?>


<div class="container">
    <div>
        <h3 style="color: red" align="center"><?php
            if (count($res) === 0) {
                echo "Ce Cursus est conforme, ton diplôme t'attend à la scolarité. Bravo " . $etudiant->getPrenom() . "  !";
            } else {
                echo "Ce cursus n'est pas conforme " . $etudiant->getPrenom() . " : ";
                ?> </h3>
            <?php foreach ($res as $fail) {
                ?>
                <rowspan>
                    <li> <?php echo $fail; ?></br></br></li>
                </rowspan>
            <?php
            }
        }
        ?>
    </div>
</div>
=======
<html>
    <head>
        <link rel="stylesheet" href="Bootstrap/css/bootstrap.min.css" >
        <title>Vérification du Cursus</title>
        <link rel="stylesheet" href="../Bootstrap/css/bootstrap.min.css" >
    </head>
    <body>
        <?php
        include '../Classes/Etudiant.php';
        include '../Classes/EtudiantManager.php';
        include '../Classes/ElementFormation.php';
        include '../Classes/ElementFormationManager.php';
        include '../Classes/Cursus.php';
        include '../Classes/CursusManager.php';
        include '../Classes/ReglementManager.php';

        $bdd = new PDO('mysql:host=localhost;dbname=projet_lo07;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

//Récupération des infos du règlement choisi
        $recupReg = $_POST['listReglements'];
        $reglement = new Reglement($recupReg);
        $reglement_manager = new ReglementManager($bdd);

//Récupération des infos du cursus choisi
        $recup = $_POST['listCursus'];
        $curs = explode(" - ", $recup);
        echo "<pre>";
        var_dump($recup);
        $cur = array('label' => $curs[0], 'etudiant' => $curs[1]);
        var_dump($curs);
        var_dump($cur);
        echo "</pre>";
        $cursus = new Cursus($cur);
        $cursus_manager = new CursusManager($bdd);
//var_dump($cursus);
        $etu_manager = new EtudiantManager($bdd);
        $etudiant = $etu_manager->get($cursus->getEtudiant());
        $manager_elem = new ElementFormationManager($bdd);


//Récupération des éléments du cursus
        $listElements = $cursus_manager->getList($cursus);
        $listRegles = $reglement_manager->getRegles($reglement);
         echo "<div>";
          echo "<pre>";
          echo"<h1>-listRegle</h1>";
          var_dump($listRegles);
          echo"<h1>-listElement</h1>";
          var_dump($listElements);
          echo "</pre>";
          echo "</div>";

          echo "<div>";
          echo "<pre>";


          echo "</pre>";
          echo "</div>";
         
        $res = $cursus->cursus_conforme($listRegles, $listElements);

        /* if (count($res) === 0) {
          print_r("Ce cursus est conforme, ton diplôme t'attend à la scolarité. Bravo " . $etudiant->getPrenom() . " !");
          var_dump($res);
          } else {
          print_r("Retourne bosser " . $etudiant->getPrenom() . " !");
          var_dump($res);
          } */
        ?>


        <div class="container">
            <div>
                <h3 style="color: red" align="center"><?php
                    if (count($res) === 0) {
                        echo "Ce Cursus est conforme, ton diplôme t'attend à la scolarité. Bravo " . $etudiant->getPrenom() . "  !";
                    } else {
                        echo "Ce cursus n'est pas conforme " . $etudiant->getPrenom() . " : ";
                        ?> </h3>

                    <?php
                    if (is_array($res)) {
                        foreach ($res as $fail) {
                            ?>
                            <rowspan>
                                <li> <?php echo $fail; ?></br></br></li>
                            </rowspan>
                            <?php
                        }
                    } else {
                        echo "<strong>" . $res . "</strong>";
                    }
                }
                ?><br/>
                <br/>
                <br/>
                <div class="container">

                    <div class="row">
                        <div class='col-xs-2 '>
                            <a class='btn btn-primary btn-lg active' role='button' aria-pressed='true' href='ChoisirCursusVerifier.php' role='button'>Choisir un autre cursus</a>
                            </div>
                        <div class="col-xs-9">
                            <div class='col-xs-2 col-xs-offset-1'>
                                <a class='btn btn-primary btn-lg active' role='button' aria-pressed='true' href='../index.php' role='button'>Accueil</a>
                            </div>
                            <div class='col-xs-3'>
                                <a class='btn btn-primary btn-lg active' role='button' aria-pressed='true' href='../Fonctio2/choisirCursus.php' role='button'>Visualiser Cursus</a>
                            </div>
                            <div class='col-xs-3 '>
                                <a class='btn btn-primary btn-lg active' role='button' aria-pressed='true' href='../Fonctio5/importcsv_form.php' role='button'>Importer Cursus</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
>>>>>>> gruch
