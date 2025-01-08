<?php

require_once '../../models/Reservierung.php';

if (empty($_GET['id'])){
    header("Location: index.php");
    exit();
} else {
    $c = Reservierung::get($_GET['id']);

}

if ($c == null) {
    http_response_code(404);
    die();
}

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

    <form class="form-horizontal" action="reservierung_update.php?id=<?= $c->getId() ?>>" method="post">

        <div class="row">
            <div class="col-md-5">
                <div class="form-group required ">
                    <label class="control-label">ZimmerID *</label>
                    <input type="number" class="form-control" name="zimmer" maxlength="32"
                           placeholder="10">

                </div>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-5">
                <div class="form-group required ">
                    <label class="control-label">Gast *</label>
                    <input type="number" class="form-control" name="gast" maxlength="128"
                           placeholder="12">

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-5">
                <div class="form-group required ">
                    <label class="control-label">Ankommzeit *</label>
                    <input type="date" class="form-control" name="start" maxlength="64"
                           placeholder="2077-04-18">

                </div>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-5">
                <div class="form-group required ">
                    <label class="control-label">Abfahrt *</label>
                    <input type="date" class="form-control" name="ende" maxlength="64"
                           placeholder="2077-04-18">

                </div>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Aktualisieren</button>
            <a class="btn btn-default" href="reservierungen.php">Abbruch</a>
        </div>
    </form>

</div> <!-- /container -->
</body>
</html>