<?php

require_once '../../models/Gast.php';

if (empty($_GET['id'])){
    header("Location: gast.php");
    exit();
} else {
    $c = Gast::get($_GET['id']);

}

if ($c == null) {
    http_response_code(404);
    die();
}

if (!empty($_POST)) {
    $c->setgastName(isset($_POST['name']) ? $_POST['name'] : '');
    $c->setEmail(isset($_POST['email']) ? $_POST['email'] : '');
    $c->setAdresse(isset($_POST['adresse']) ? $_POST['adresse'] : '');

    if ($c->save()) {
        $c->update();
        header("Location: gast.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <title>Gast</title>

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

    <form class="form-horizontal" action="gast_create.php" method="post">

        <div class="row">
            <div class="col-md-5">
                <div class="form-group required ">
                    <label class="control-label">Name *</label>
                    <input type="text" class="form-control" name="name" maxlength="32"
                           value="<?= $c->getgastName()?>">

                    <?php
                    if(!empty($c->getErrors()['name'])): ?>
                        <div class="help-block"><?= $c->getgastName()['name']?></div>

                    <?php
                    endif;
                    ?>

                </div>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-5">
                <div class="form-group required ">
                    <label class="control-label">Email *</label>
                    <input type="text" class="form-control" name="email" maxlength="128"
                           value="<?= $c->getEmail()?>">

                    <?php
                    if(!empty($c->getErrors()['email'])): ?>
                        <div class="help-block"><?= $c->getEmail()['email']?></div>

                    <?php
                    endif;
                    ?>





                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-5">
                <div class="form-group required ">
                    <label class="control-label">Adresse *</label>
                    <input type="text" class="form-control" name="adresse" maxlength="64"
                           value="<?= $c->getAdresse()?>">

                    <?php
                    if(!empty($c->getErrors()['adresse'])): ?>
                        <div class="help-block"><?= $c->getAdresse()['name']?></div>

                    <?php
                    endif;
                    ?>





                </div>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success">Erstellen</button>
            <a class="btn btn-default" href="gast.php">Abbruch</a>
        </div>
    </form>

</div> <!-- /container -->
</body>
</html>