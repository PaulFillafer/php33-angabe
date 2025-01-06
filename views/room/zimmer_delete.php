<?php

require_once '../../models/Zimmer.php';

$id = !empty($_GET["id"]) ? $_GET["id"] : 0;

if (!empty($_POST["id"])) {

    $c = Zimmer::delete($_POST['id']);

    header("Location: zimmer.php");
    exit();
} else {
    $c = Zimmer::get($id);
}



?>



<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <title>Zimmerreservierung</title>

    <link rel="shortcut icon" href="css/favicon.ico" type="image/x-icon">
    <link rel="icon" href="css/favicon.ico" type="image/x-icon">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
<div class="container">
    <h2>Zugangsdaten löschen</h2>

    <form class="form-horizontal" action="zimmer_delete.php?id=<?= $c->getzimmerId()?>>" method="post">
        <input type="hidden" name="id" value="<?= $c->getzimmerId() ?>>"/>
        <p class="alert alert-error">Wollen Sie die Zugangsdaten von <?= $c->getName()?> / <?= $c->getNr()?> wirklich löschen?</p>
        <div class="form-actions">
            <button type="submit" class="btn btn-danger">Löschen</button>
            <a class="btn btn-default" href="zimmer.php">Abbruch</a>
        </div>
    </form>

</div> <!-- /container -->
</body>
</html>