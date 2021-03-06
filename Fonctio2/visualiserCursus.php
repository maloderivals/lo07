<head>
    <title>Votre cursus</title>
    <link rel="stylesheet" href="../Bootstrap/css/bootstrap.min.css" >
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
    $cur = array('label' => $curs[0], 'etudiant' => $curs[1]);
    $cursus = new Cursus($cur);
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
    $creditsST = 0;
    $se = FALSE;
    $bule = FALSE;
    $hp = [];
    

    foreach ($listElements as $key => $elementFormation) {
        $elementForm = new ElementFormation($elementFormation);
        if ($elementForm->getCategorie() == "CS") {
            $cs[] = $elementForm;
            if (!preg_match('#F#', $elementForm->getResultat())) {
                $creditsCS += $elementForm->getCredit();
            }
        } elseif ($elementForm->getCategorie() === "TM") {
            $tm[] = $elementForm;
            if (!preg_match('#F#', $elementForm->getResultat())) {
                $creditsTM += $elementForm->getCredit();
            }
        } elseif ($elementForm->getCategorie() === "EC") {
            $ec[] = $elementForm;
            if (!preg_match('#F#', $elementForm->getResultat())) {
                $creditsEC += $elementForm->getCredit();
            }
        } elseif ($elementForm->getCategorie() === "ME") {
            $me[] = $elementForm;
            if (!preg_match('#F#', $elementForm->getResultat())) {
                $creditsME += $elementForm->getCredit();
            }
        } elseif ($elementForm->getCategorie() === "CT") {
            $ct[] = $elementForm;
            if (!preg_match('#F#', $elementForm->getResultat())) {
                $creditsCT += $elementForm->getCredit();
            }
        } elseif ($elementForm->getCategorie() === "ST") {
            $st[] = $elementForm;
            if (!preg_match('#F#', $elementForm->getResultat())) {
                $creditsST += $elementForm->getCredit();
            }
        } elseif ($elementForm->getCategorie() === "HP") {
            $hp[] = $elementForm;
        } else {
            if (preg_match('#^ADM#', $elementForm->getResultat())) {
                if ($elementForm->getCategorie() === "SE") {
                    $se = TRUE;
                } else {
                    $bule = TRUE;
                }
            }
        }
    }
    ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-3">
                <h3>CS (<?php echo ($creditsCS) ?> crédits) :</h3>
                <?php foreach ($cs as $element) {
                    ?>
                    <rowspan>
                        <li> <?php echo ($element->getSigle() . ' : ' . $element->getResultat() . ' (' . $element->getCredit() . ' crédits)');
                    ?></li>
                    </rowspan>
                <?php } ?>
            </div>
            <div class="col-xs-3">
                <h3>TM (<?php echo ($creditsTM) ?> crédits) :</h3>
                <?php foreach ($tm as $element) {
                    ?>
                    <rowspan>
                        <li> <?php echo ($element->getSigle() . ' : ' . $element->getResultat() . ' (' . $element->getCredit() . ' crédits)');
                    ?></li>
                    </rowspan>
                <?php } ?>
            </div>
            <div class="col-xs-3">
                <h3>ME (<?php echo ($creditsME) ?> crédits) :</h3>
                <?php foreach ($me as $element) {
                    ?>
                    <rowspan>
                        <li> <?php echo ($element->getSigle() . ' : ' . $element->getResultat() . ' (' . $element->getCredit() . ' crédits)');
                    ?></li>
                    </rowspan>
                <?php } ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-3">
                <h3>CT (<?php echo ($creditsCT) ?> crédits) :</h3>
                <?php foreach ($ct as $element) {
                    ?>
                    <rowspan>
                        <li> <?php echo ($element->getSigle() . ' : ' . $element->getResultat() . ' (' . $element->getCredit() . ' crédits)');
                    ?></li>
                    </rowspan>
                <?php } ?>
            </div>

            <div class="col-xs-3">
                <h3>EC (<?php echo ($creditsEC) ?> crédits) :</h3>
                <?php foreach ($ec as $element) {
                    ?>
                    <rowspan>
                        <li> <?php echo ($element->getSigle() . ' : ' . $element->getResultat() . ' (' . $element->getCredit() . ' crédits)');
                    ?></li>
                    </rowspan>
                <?php } ?>
            </div>
            <div class = "col-xs-3">
                <h3>ST :</h3>
                <?php foreach ($st as $element) {
                    ?>
                    <rowspan>
                        <li> <?php echo ($element->getSigle() . ' : ' . $element->getResultat() . ' (' . $element->getCredit() . ' crédits)');
                    ?></li>
                    </rowspan>
                <?php } ?>
            </div>
        </div>
        </br>
        <div class="row">
            <div class="col-xs-3">
                <h3>HP : </h3>
                <?php foreach ($hp as $element) {
                    ?>
                    <rowspan>
                        <li> <?php echo ($element->getSigle());
                    ?></li>
                    </rowspan>
                <?php } ?>
            </div>

            <div class="col-xs-3 col-xs-offset-3">
                <h3>BULATS <?php
                    if ($bule) {
                        echo 'validé.';
                    } else {
                        echo 'non validé.';
                    }
                    ?>
                </h3>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-3 col-xs-offset-3">
                <h3>Semestre à l'étranger <?php
                    if ($se) {
                        echo 'effectué.';
                    } else {
                        echo 'non effectué.';
                    }
                    ?>
                </h3>
            </div>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
                <div class="container">

                    <div class="row">
                        <div class='col-xs-2 '>
                            <a class='btn btn-primary btn-lg active' role='button' aria-pressed='true' href='../Fonctio3/ChoisirCursusVerifier.php' role='button'>Analyser un cursus</a>
                            </div>
                        <div class="col-xs-9">
                            <div class='col-xs-2'>
                                <a class='btn btn-primary btn-lg active' role='button' aria-pressed='true' href='../index.php' role='button'>Accueil</a>
                            </div>
                            <div class='col-xs-3'>
                                <a class='btn btn-primary btn-lg active' role='button' aria-pressed='true' href='choisirCursus.php' role='button'>Visualiser autre Cursus</a>
                            </div>
                            <div class='col-xs-3 col-xs-offset-1'>
                                <a class='btn btn-primary btn-lg active' role='button' aria-pressed='true' href='../Fonctio5/importcsv_form.php' role='button'>Importer Cursus</a>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</body>