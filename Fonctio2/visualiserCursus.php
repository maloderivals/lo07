<head>
    <title>Votre cursus</title>
    <link rel="stylesheet" href="Bootstrap/css/bootstrap.min.css" >
</head>
<body>
    <?php
    include '../Classes/EtudiantManager.php';
    include '../Classes/Etudiant.php';
    include '../Classes/Cursus.php';
    include '../Classes/CursusManager.php';
//include '../Classes/ElementFormation.php';
    include '../Classes/ElementFormationManager.php';

    $bdd = new PDO('mysql:host=localhost;dbname=projet_lo07;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    $recup = $_POST['listCursus'];
    $curs = explode(" - ", $recup);

    $cursus = new Cursus($curs[0], $curs[1]);
    $cursus_manager = new CursusManager($bdd);
    $etu_manager = new EtudiantManager($bdd);
    $etudiant = $etu_manager->get($cursus->getEtudiant());
    $manager_elem = new ElementFormationManager($bdd);
    ?> <h1><?php echo($etudiant->getPrenom() . " " . $etudiant->getNom()) ?>, vous avez choisi le cursus <?php echo($cursus->getLabel()) ?></h1>
    <?php
//Récupération des éléments du cursus
    $listElements = $cursus_manager->getList($cursus);
    $cs = [];
    $creditsCS = 0;
    $tm = [];
    $creditsTM = 0;
    $ec = [];
    $creditsEC = 0;
    $me = [];
    $creditsME = 0;
    $ct = [];
    $creditsCT = 0;
    $st = [];
    $se = FALSE;
    $bule = FALSE;


    foreach ($listElements as $key => $elementForm) {
        if ($elementForm->getCategorie() === "CS") {
            $cs[] = $elementForm;
            if ($elementForm->getResultat() !== "F") {
                $creditsCS += $elementForm->getCredit();
            }
        } elseif ($elementForm->getCategorie() === "TM") {
            $tm[] = $elementForm;
            if ($elementForm->getResultat() !== "F") {
                $creditsTM += $elementForm->getCredit();
            }
        } elseif ($elementForm->getCategorie() === "EC") {
            $ec[] = $elementForm;
            if ($elementForm->getResultat() !== "F") {
                $creditsEC += $elementForm->getCredit();
            }
        } elseif ($elementForm->getCategorie() === "ME") {
            $ME[] = $elementForm;
            if ($elementForm->getResultat() !== "F") {
                $creditsME += $elementForm->getCredit();
            }
        } elseif ($elementForm->getCategorie() === "CT") {
            $ct[] = $elementForm;
            if ($elementForm->getResultat() !== "F") {
                $creditsCT += $elementForm->getCredit();
            }
        } elseif ($elementForm->getCategorie() === "ST") {
            $st[] = $elementForm;
        } elseif ($elementForm->getResultat() === "ADM") {
            if ($elementForm->getCategorie() === "SE") {
                $se = true;
            } else {
                $bule = true;
            }
        }
    }
    ?>

    <div>
        <h3>CS (<?php echo ($creditsCS) ?> crédits) :</h3>
        <?php foreach ($cs as $element) {
            ?>
            <rowspan>
                <li> <?php echo ($element->getSigle() . ' : ' . $element->getResultat() . ' (' . $element->getCredit() . ' crédits)');
            ?></li>
            </rowspan>
        <?php } ?>
    </div>
    <div>
        <h3>TM (<?php echo ($creditsTM) ?> crédits) :</h3>
        <?php foreach ($tm as $element) {
            ?>
            <rowspan>
                <li> <?php echo ($element->getSigle() . ' : ' . $element->getResultat() . ' (' . $element->getCredit() . ' crédits)');
            ?></li>
            </rowspan>
        <?php } ?>
    </div>
    <div>
        <h3>ME (<?php echo ($creditsME) ?> crédits) :</h3>
        <?php foreach ($me as $element) {
            ?>
            <rowspan>
                <li> <?php echo ($element->getSigle() . ' : ' . $element->getResultat() . ' (' . $element->getCredit() . ' crédits)');
            ?></li>
            </rowspan>
        <?php } ?>
    </div>
    <div>
        <h3>CT (<?php echo ($creditsCT) ?> crédits) :</h3>
        <?php foreach ($ct as $element) {
            ?>
            <rowspan>
                <li> <?php echo ($element->getSigle() . ' : ' . $element->getResultat() . ' (' . $element->getCredit() . ' crédits)');
            ?></li>
            </rowspan>
        <?php } ?>
    </div>
    <div>
        <h3>ST :</h3>
        <?php foreach ($st as $element) {
            ?>
            <rowspan>
                <li> <?php echo ($element->getSigle() . ' : ' . $element->getResultat() . ' (' . $element->getCredit() . ' crédits)');
            ?></li>
            </rowspan>
        <?php } ?>
    </div>

</body>