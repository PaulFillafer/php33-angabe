<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gästeverwaltung</title>
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
        <h2>Reservierung</h2>
    </div>
    <div class="row">
        <p>
            <a href="reservierung_create.php" class="btn btn-success">Erstellen <span class="glyphicon glyphicon-plus"></span></a>
        </p>

        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>Zimmername</th>
                <th>Gastname</th>
                <th>Ankommezeit</th>
                <th>Goodbye</th>
            </tr>
            </thead>
            <tbody>
            <?php

            require_once '../../models/Reservierung.php';

            $reservierung = Reservierung::getAll();

            foreach ($reservierung as $c) {
                echo "<tr>";
                echo "<td>" . $c->getZimmerId() . "</td>";
                echo "<td>" . $c->getGastId() . "</td>";
                echo "<td>" . $c->getStart() . "</td>";
                echo "<td>" . $c->getEnde() . "</td>";
                echo "<td>";
                echo '<a class="btn btn-info" href="reservierung_view.php?id=' . $c->getId() . '"><span class="glyphicon glyphicon-eye-open"></span></a>';
                echo '&nbsp;';
                echo '<a class="btn btn-info" href="reservierung_update.php?id=' . $c->getId() . '"><span class="glyphicon glyphicon-pencil"></span></a>';
                echo '&nbsp;';
                echo '<a class="btn btn-info" href="reservierung_delete.php?id=' . $c->getId() . '"><span class="glyphicon glyphicon-remove"></span></a>';
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