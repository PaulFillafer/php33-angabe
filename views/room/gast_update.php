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
        header("Location: gast_view.php?id=" . $c->getgastId());
        exit();
    }
}

?>


<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <title>Passwortmanager</title>

    <link rel="shortcut icon" href="css/favicon.ico" type="image/x-icon">
    <link rel="icon" href="css/favicon.ico" type="image/x-icon">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
<div class="container">
    <div class="row">
        <h2>Zugangsdaten bearbeiten</h2>
    </div>

    <form class="form-horizontal" action="gast_update.php?id=<?= $c->getgastId() ?>>" method="post">

        <div class="row">
            <div class="col-md-5">
                <div class="form-group required ">
                    <label class="control-label">Name *</label>
                    <input type="text" class="form-control" name="name" maxlength="32"
                           placeholder="Paul Fillafer">

                </div>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-5">
                <div class="form-group required ">
                    <label class="control-label">Email *</label>
                    <input type="text" class="form-control" name="email" maxlength="128"
                           placeholder="email@gmail.com">

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-5">
                <div class="form-group required ">
                    <label class="control-label">Adresse *</label>
                    <input type="text" class="form-control" name="adresse" maxlength="64"
                           placeholder="6464 Tarrenz">

                </div>
            </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Aktualisieren</button>
            <a class="btn btn-default" href="gast.php">Abbruch</a>
        </div>
    </form>

</div> <!-- /container -->
</body>
</html>