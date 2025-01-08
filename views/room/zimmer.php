<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zimmerverwaltung</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<!-- Navigation / Menü -->
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <a class="navbar-brand" href="../../index.php">Zimmerreservierung</a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="reservierungen.php">Reservierungen</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="zimmer.php">Zimmer</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="gast.php">Gäste</a>
            </li>
        </ul>
    </div>
</nav>
<div class="container">
    <div class="row">
        <h2>Zimmer</h2>
    </div>
    <div class="row">
        <p>
            <a href="zimmer_create.php" class="btn btn-success">Erstellen <span class="glyphicon glyphicon-plus"></span></a>
        </p>

        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>Nr</th>
                <th>Name</th>
                <th>Person</th>
                <th>Preis</th>
                <th>Balkon</th>
            </tr>
            </thead>
            <tbody>
            <?php

            require_once '../../models/Zimmer.php';

            $zimmer = Zimmer::getAll();

            foreach ($zimmer as $c) {
                echo "<tr>";
                echo "<td>" . $c->getNr() . "</td>";
                echo "<td>" . $c->getName() . "</td>";
                echo "<td>" . $c->getPerson() . "</td>";
                echo "<td>" . $c->getPreis() . " €" . "</td>";
                echo "<td>" . $c->getBalkon() . "</td>";
                echo "<td>";
                echo '<a class="btn btn-info" href="zimmer_view.php?id=' . $c->getzimmerId() . '"><span class="glyphicon glyphicon-eye-open"></span></a>';
                echo '&nbsp;';
                echo '<a class="btn btn-info" href="zimmer_update.php?id=' . $c->getzimmerId() . '"><span class="glyphicon glyphicon-pencil"></span></a>';
                echo '&nbsp;';
                echo '<a class="btn btn-info" href="zimmer_delete.php?id=' . $c->getzimmerId() . '"><span class="glyphicon glyphicon-remove"></span></a>';
                echo '&nbsp;';
                echo "<tr/>";
            }

            ?>
            </tbody>
        </table>
    </div>
</div> <!-- /container -->
</body>
</html>