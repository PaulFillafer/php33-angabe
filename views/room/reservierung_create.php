<?php

require_once "../../models/Reservierung.php";

$c = new Reservierung();

if (!empty($_POST)) {
    $c->setZimmerId(isset($_POST['zimmer']) ? $_POST['zimmer'] : '');
    $c->setGastId(isset($_POST['gast']) ? $_POST['gast'] : '');
    $c->setStart(isset($_POST['start']) ? $_POST['start'] : '');
    $c->setEnde(isset($_POST['ende']) ? $_POST['ende'] : '');

    if ($c->save()) {
        header("Location: reservierung_view.php?id=" . $c->getId());
        exit();
    }
}

?>


<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <title>Reservierung</title>

    <link rel="shortcut icon" href="css/favicon.ico" type="image/x-icon">
    <link rel="icon" href="css/favicon.ico" type="image/x-icon">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <h2>Zugangsdaten erstellen</h2>
    </div>

    <form class="form-horizontal" action="reservierung_create.php" method="post">

        <div class="row">
            <div class="col-md-5">
                <div class="form-group required ">
                    <label class="control-label">Zimmer ID *</label>
                    <input type="text" class="form-control" name="zimmer" maxlength="32"
                           value="<?= $c->getZimmerId()?>">

                    <?php
                    if(!empty($c->getErrors()['zimmer'])): ?>
                        <div class="help-block"><?= $c->getZimmerId()['zimmer']?></div>

                    <?php
                    endif;
                    ?>

                </div>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-5">
                <div class="form-group required ">
                    <label class="control-label">Gast Id *</label>
                    <input type="text" class="form-control" name="gast" maxlength="128"
                           value="<?= $c->getGastId()?>">

                    <?php
                    if(!empty($c->getErrors()['gast'])): ?>
                        <div class="help-block"><?= $c->getEmail()['gast']?></div>

                    <?php
                    endif;
                    ?>





                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-5">
                <div class="form-group required ">
                    <label class="control-label">Start 2025-04-18 *</label>
                    <input type="date" class="form-control" name="start" maxlength="64"
                           value="<?= $c->getStart()?>">

                    <?php
                    if(!empty($c->getErrors()['start'])): ?>
                        <div class="help-block"><?= $c->getStart()['start']?></div>

                    <?php
                    endif;
                    ?>





                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-5">
                <div class="form-group required ">
                    <label class="control-label">Ende 2025-04-18 *</label>
                    <input type="date" class="form-control" name="ende" maxlength="64"
                           value="<?= $c->getEnde()?>">

                    <?php
                    if(!empty($c->getErrors()['ende'])): ?>
                        <div class="help-block"><?= $c->getEnde()['ende']?></div>

                    <?php
                    endif;
                    ?>





                </div>
            </div>
        </div>


        <div class="form-group">
            <button type="submit" class="btn btn-success">Erstellen</button>
            <a class="btn btn-default" href="reservierungen.php">Abbruch</a>
        </div>
    </form>

</div> <!-- /container -->
</body>
</html>