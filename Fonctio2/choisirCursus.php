<?php
include '../Classes/Etudiant.php';
include '../Classes/EtudiantManager.php';


$bdd = new PDO('mysql:host=localhost;dbname=projet_lo07;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

//Récupération des étudiants de la bdd
$manager = new EtudiantManager($bdd);
$etulist = $manager->getList();
foreach ($etulist as $key => $etu) {
    $etudiants[] = $manager->Array_out($etu);
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

foreach ($etudiants as $etud) {
    $cursus[] = getCursus($bdd, $etud);
}

?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Visualiser un cursus 2</title>
        <link href="../include/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <form method="post" action="visualiserCursus.php">
            <fieldset>
                <div id='champs'>
                    <label for="listCursus">Choisir un cursus</label>
                    <input list="cursus" name="listCursus" id="listCursus">
                    <datalist id="cursus">
                        <?php
                        foreach ($cursus as $cur) {
                            ?>
                            <option value="<?php echo($cur); ?>">
                            <?php } ?>
                    </datalist>
                    </br>
                </div>

            </fieldset>
            <div>
                <input type="submit" value="Visualiser ce cursus" />
            </div>
        </form>
    </body>
</html>