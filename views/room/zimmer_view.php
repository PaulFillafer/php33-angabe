<?php

require_once "../../models/Zimmer.php";

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

print_r($c);

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
    <h2>Zugangsdaten anzeigen</h2>

    <p>
        <a class="btn btn-primary" href="zimmer_update.php?id=<?= $c->getzimmerId()?>">Aktualisieren</a>
        <a class="btn btn-danger" href="zimmer_delete.php?id=<?= $c->getzimmerId()?>">Löschen</a>
        <a class="btn btn-default" href="zimmer.php">Zurück</a>
    </p>

    <table class="table table-striped table-bordered detail-view">
        <tbody>
        <tr>
            <th>Nr</th>
            <td><?= $c->getNr()?></td>
        </tr>
        <tr>
            <th>Name</th>
            <td><?= $c->getName()?></td>
        </tr>
        <tr>
            <th>Person</th>
            <td><?= $c->getPerson()?></td>
        </tr>
        <tr>
            <th>Preis</th>
            <td><?= $c->getPreis()?></td>
        </tr>
        <tr>
            <th>Balkon</th>
            <td><?= $c->getBalkon()?></td>
        </tr>
        </tbody>
    </table>
</div> <!-- /container -->
</body>
</html>