<?php

require_once "../../models/Reservierung.php";

if (empty($_GET['id'])){
    header("Location: reservierung.php");
    exit();
} else {
    $c = Reservierung::get($_GET['id']);

}

if ($c == null) {
    http_response_code(404);
    die();
}

print_r($c);

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
    <h2>Zugangsdaten anzeigen</h2>

    <p>
        <a class="btn btn-primary" href="reservierung_update.php?id=<?= $c->getId()?>">Aktualisieren</a>
        <a class="btn btn-danger" href="reservierung_delete.php?id=<?= $c->getId()?>">Löschen</a>
        <a class="btn btn-default" href="reservierungen.php">Zurück</a>
    </p>

    <table class="table table-striped table-bordered detail-view">
        <tbody>
        <tr>
            <th>Zimmer</th>
            <td><?= $c->getZimmerId()?></td>
        </tr>
        <tr>
            <th>Gast</th>
            <td><?= $c->getGastId()?></td>
        </tr>
        <tr>
            <th>Start</th>
            <td><?= $c->getStart()?></td>
        </tr>
        <tr>
            <th>Ende</th>
            <td><?= $c->getEnde()?></td>
        </tr>
        </tbody>
    </table>
</div> <!-- /container -->
</body>
</html>