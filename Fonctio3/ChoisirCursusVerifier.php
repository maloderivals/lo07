<?php
include '../Classes/Etudiant.php';
include '../Classes/EtudiantManager.php';
include '../Classes/Reglement.php';
include '../Classes/ReglementManager.php';


$bdd = new PDO('mysql:host=localhost;dbname=projet_lo07;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

//Récupération des étudiants de la bdd
$manager_etu = new EtudiantManager($bdd);
$etulist = $manager_etu->getList();
foreach ($etulist as $key => $etu) {
    $etudiants[$key] = $manager_etu->Array_out($etu);
}

$manager_reglement = new ReglementManager($bdd);
$reglementsList = $manager_reglement->getList();
$reglem = [];
foreach ($reglementsList as $key => $reg) {
    $reglem[] = $reg->getId_reglement();
}
$reglements = [];
foreach ($reglem as $key => $value) {
    $reglements[] = $value['nom_reglement'];
}


function getCursus($db, $etu) {
    $sql = 'SELECT distinct label FROM cursus where etudiant = ' . $etu["id"];

    $return = array();
    foreach ($db->query($sql) as $row) {
        $label = $row['label'];
        $test = array();
        array_push($test, $label);
        array_push($test, $etu['id']);
        $res = implode(" - ", $test);
    }
    return $res;
}

$cursus = [];
foreach ($etudiants as $etud) {
    $cursus[] = getCursus($bdd, $etud);
}


?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Vérifier un cursus</title>
        <link rel="stylesheet" href="Bootstrap/css/bootstrap.min.css" >
    </head>
    <body>
        <form method="post" action="verificationCursus.php">
            <fieldset>
                <div id='champ'>
                    <p>
                        <label for="listCursus">Choisir un cursus</label>
                        <input list="cursus" name="listCursus" id="listCursus">
                        <datalist id="cursus">
                            <?php
                            foreach ($cursus as $cur) {
                                ?>
                                <option value="<?php echo($cur); ?>">
                                <?php } ?>
                        </datalist>
                        <label for="listReglements">Choisir un règlement</label>                    
                        <input list="reglements" name="listReglements" id="listReglements">
                        <datalist id="reglement">
                            <?php
                            foreach ($reglements as $reg) {
                                ?>
                                <option value="<?php $reg; ?>">
                                <?php } ?>
                        </datalist>
                        </br>
                    </p>
                </div>

            </fieldset>
            <div>
                <input type="submit" value="Vérifier ce cursus" />
            </div>
        </form>
    </body>
</html>