<?php

require_once "../../models/Gast.php";

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
        <a class="btn btn-primary" href="gast_update.php?id=<?= $c->getgastId()?>">Aktualisieren</a>
        <a class="btn btn-danger" href="gast_delete.php?id=<?= $c->getgastId()?>">Löschen</a>
        <a class="btn btn-default" href="gast.php">Zurück</a>
    </p>

    <table class="table table-striped table-bordered detail-view">
        <tbody>
        <tr>
            <th>Name</th>
            <td><?= $c->getgastName()?></td>
        </tr>
        <tr>
            <th>Domäne</th>
            <td><?= $c->getEmail()?></td>
        </tr>
        <tr>
            <th>CMS-Benutzername</th>
            <td><?= $c->getAdresse()?></td>
        </tr>
        </tbody>
    </table>
</div> <!-- /container -->
</body>
</html>