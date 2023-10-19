<?php

require_once('./components/connexion.php');

$CurrentDestinationID = isset($_GET['destination']) ? $_GET['destination'] : 0;
$SelectedDestination = $NewConnection->select("continent", "*", "id_continent = $CurrentDestinationID");

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title> <?php
            $DestinationsName = "";
            foreach ($SelectedDestination as $Key => $Value) {
                $DestinationsName = $Value['titre'];
            }
            echo $DestinationsName;
            ?> | Notre Monde</title>
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="icon" href="./images/favicon.png" type="image/x-icon">

    <link href="styles.css" rel="stylesheet" />
</head>

<body>
    <?php
    include_once('./components/nav.php');

    include_once('./components/HeaderFiltre.php')

    ?>
    <main>
        <section>
            <h2 class="titre1">Description</h2>
            <div class="card-container">
                <div class="card" style="width:33%">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h3 class="card-title soustitre">Thailande</h3>
                        <div class="flex-text">
                            <p>jours </p>
                            <p>| prix</p>
                        </div>
                        <button type="button" class="btn btn-success">Explorer</button>
                    </div>
                </div>
                <div class="card" style="width:33%">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h3 class="card-title soustitre">Thailande</h3>
                        <div class="flex-text">
                            <p>jours </p>
                            <p>| prix</p>
                        </div>
                        <button type="button" class="btn btn-success">Explorer</button>
                    </div>
                </div>
                <div class="card" style="width:30%">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h3 class="card-title soustitre">Thailande</h3>
                        <div class="flex-text">
                            <p>jours </p>
                            <p>| prix</p>
                        </div>
                        <button type="button" class="btn btn-success">Explorer</button>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include_once('./components/footer.php') ?>

</body>

</html>