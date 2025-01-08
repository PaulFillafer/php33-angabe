<?php

require_once '../../models/Zimmer.php';

if (empty($_GET['id'])){
    header("Location: zimmer.php");
    exit();
} else {
    $c = Zimmer::get($_GET['id']);

}

if ($c == null) {
    http_response_code(404);
    die();
}

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

    <form class="form-horizontal" action="zimmer_update.php?id=<?= $c->getzimmerId() ?>>" method="post">

        <div class="row">
            <div class="col-md-5">
                <div class="form-group required ">
                    <label class="control-label">Nr *</label>
                    <input type="text" class="form-control" name="nr" maxlength="32"
                           placeholder="7/11">

                </div>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-5">
                <div class="form-group required ">
                    <label class="control-label">Name *</label>
                    <input type="text" class="form-control" name="name" maxlength="128"
                           placeholder="The Room">

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-5">
                <div class="form-group required ">
                    <label class="control-label">Person *</label>
                    <input type="text" class="form-control" name="person" maxlength="64"
                           placeholder="5">

                </div>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-5">
                <div class="form-group required ">
                    <label class="control-label">Preis*</label>
                    <input type="number" step="0.01" class="form-control" name="preis" maxlength="64"
                           placeholder="0.00">

                </div>
            </div>
        </div>

        <div class="col-md-2"></div>
        <div class="col-md-5">
            <div class="form-group required ">
                <label class="control-label">Balkon *</label>
                <input type="text" class="form-control" name="balkon" maxlength="64"
                       value="oXPreXz">

            </div>
        </div>
</div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Aktualisieren</button>
            <a class="btn btn-default" href="zimmer.php">Abbruch</a>
        </div>
    </form>

</div> <!-- /container -->
</body>
</html>