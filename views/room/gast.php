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
                <a class="nav-link" href="../reservierungen.php">Reservierungen</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../zimmer.php">Zimmer</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="gast.php">Gäste</a>
            </li>
        </ul>
    </div>
</nav>
<div class="container">
    <div class="row">
        <h2>Gast</h2>
    </div>
    <div class="row">
        <p>
            <a href="gast_create.php" class="btn btn-success">Erstellen <span class="glyphicon glyphicon-plus"></span></a>
        </p>

        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>Name</th>
                <th>Domäne</th>
                <th>Adresse</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php

            require_once '../../models/Gast.php';

            $gast = Gast::getAll();

            foreach ($gast as $c) {
                echo "<tr>";
                echo "<td>" . $c->getgastName() . "</td>";
                echo "<td>" . $c->getEmail() . "</td>";
                echo "<td>" . $c->getAdresse() . "</td>";
                echo "<td>";
                echo '<a class="btn btn-info" href="view.php?id=' . $c->getId() . '"><span class="glyphicon glyphicon-eye-open"></span></a>';
                echo '&nbsp;';
                echo '<a class="btn btn-info" href="update.php?id=' . $c->getId() . '"><span class="glyphicon glyphicon-pencil"></span></a>';
                echo '&nbsp;';
                echo '<a class="btn btn-info" href="delete.php?id=' . $c->getId() . '"><span class="glyphicon glyphicon-remove"></span></a>';
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