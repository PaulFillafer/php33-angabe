<?php

require_once '../../models/Reservierung.php';

$id = !empty($_GET["id"]) ? $_GET["id"] : 0;

if (!empty($_POST["id"])) {

    $c = Reservierung::delete($_POST['id']);

    header("Location: reservierungen.php");
    exit();
} else {
    $c = Reservierung::get($id);
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
    <h2>Reservierung löschen</h2>

    <form class="form-horizontal" action="reservierung_delete.php?id=<?= $c->getId()?>" method="post">
        <input type="hidden" name="id" value="<?= $c->getId() ?>>"/>
        <p class="alert alert-error">Wollen Sie die Zugangsdaten von <?= $c->getGastId()?> / <?= $c->getZimmerId()?> von bis <?= $c->getStart()?> / <?= $c->getEnde()?>  wirklich löschen?</p>
        <div class="form-actions">
            <button type="submit" class="btn btn-danger">Löschen</button>
            <a class="btn btn-default" href="reservierungen.php">Abbruch</a>
        </div>
    </form>

</div> <!-- /container -->
</body>
</html>