<?php

require_once "../../models/Zimmer.php";

$c = new Zimmer();

if (!empty($_POST)) {
    $c->setNr(isset($_POST['nr']) ? $_POST['nr'] : '');
    $c->setName(isset($_POST['name']) ? $_POST['name'] : '');
    $c->setPerson(isset($_POST['person']) ? $_POST['person'] : '');
    $c->setPreis(isset($_POST['preis']) ? $_POST['preis'] : '');
    $c->setBalkon(isset($_POST['balkon']) ? $_POST['balkon'] : '');

    if ($c->save()) {
        header("Location: zimmer_view.php?id=" . $c->getzimmerId());
        exit();
    }
}

?>


<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <title>Zimmer</title>

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

    <form class="form-horizontal" action="zimmer_create.php" method="post">

        <div class="row">
            <div class="col-md-5">
                <div class="form-group required ">
                    <label class="control-label">Nr *</label>
                    <input type="text" class="form-control" name="nr" maxlength="32"
                           value="<?= $c->getNr()?>">

                    <?php
                    if(!empty($c->getErrors()['nr'])): ?>
                        <div class="help-block"><?= $c->getNr()['nr']?></div>

                    <?php
                    endif;
                    ?>

                </div>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-5">
                <div class="form-group required ">
                    <label class="control-label">Name *</label>
                    <input type="text" class="form-control" name="name" maxlength="128"
                           value="<?= $c->getName()?>">

                    <?php
                    if(!empty($c->getErrors()['name'])): ?>
                        <div class="help-block"><?= $c->getName()['name']?></div>

                    <?php
                    endif;
                    ?>

                    <div class="col-md-2"></div>
                    <div class="col-md-5">
                        <div class="form-group required ">
                            <label class="control-label">Person *</label>
                            <input type="text" class="form-control" name="person" maxlength="128"
                                   value="<?= $c->getPerson()?>">

                            <?php
                            if(!empty($c->getErrors()['name'])): ?>
                                <div class="help-block"><?= $c->getPerson()['person']?></div>

                            <?php
                            endif;
                            ?>

                            <div class="col-md-2"></div>
                            <div class="col-md-5">
                                <div class="form-group required ">
                                    <label class="control-label">Preis *</label>
                                    <input type="text" class="form-control" name="preis" maxlength="128"
                                           value="<?= $c->getPreis()?>">

                                    <?php
                                    if(!empty($c->getErrors()['preis'])): ?>
                                        <div class="help-block"><?= $c->getPreis()['preis']?></div>

                                    <?php
                                    endif;
                                    ?></div></div>

                                    <div class="col-md-2"></div>
                                    <div class="col-md-5">
                                        <div class="form-group required ">
                                            <label class="control-label">Balkon *</label>
                                            <input type="text" class="form-control" name="balkon" maxlength="128"
                                                   value="<?= $c->getName()?>">

                                            <?php
                                            if(!empty($c->getErrors()['name'])): ?>
                                                <div class="help-block"><?= $c->getBalkon()['balkon']?></div>

                                            <?php
                                            endif;
                                            ?>
                                        </div>
                </div>
            </div>
        </div>

                </div>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success">Erstellen</button>
            <a class="btn btn-default" href="zimmer.php">Abbruch</a>
        </div>
    </form>

</div> <!-- /container -->
</body>
</html>