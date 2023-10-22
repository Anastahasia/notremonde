<?php

require_once('./components/connexion.php');

$CurrentDestinationID = isset($_GET['destination']) ? $_GET['destination'] : 0;
$SelectedDestination = $NewConnection->select("continent", "*", "id_continent = $CurrentDestinationID");

$CurrentCategorieID = isset($_GET['categorie']) ? $_GET['categorie'] : 0;
$SelectedCategorie = $NewConnection->select("categorie", "*", "id_categorie = $CurrentCategorieID");

if ($CurrentDestinationID) {
    $circuits = $NewConnection->select("circuit", "*", "continent = $CurrentDestinationID AND visible=1");
} elseif ($CurrentCategorieID) {
    $circuits = $NewConnection->select("circuit", "*", "categorie = $CurrentCategorieID AND visible=1");
} else {
    $circuits = $NewConnection->select("circuit", "*", "visible=1");
}


?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title> <?php
            if ($CurrentDestinationID) {
                $DestinationsName = "";
                foreach ($SelectedDestination as $Key => $Value) {
                    $DestinationsName = $Value['nom'];
                }
                echo $DestinationsName;
            } else {
                echo 'Tous les circuits';
            } //mettre un else if incluant un for each pour catégories 
            ?>
        | Notre Monde</title>
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
            <div class="flex-text">
                <h2 class="titre1">ça pourrait vous plaire...</h2>
                <a href="destination.php" class="soustitre2">Tous les circuits</a>
            </div>
            <div class="card-container">
                <?php
                    foreach ($circuits as $Value) {
                        echo '
                <div class="card circuit-card">
                    <div class="img-wrapper">
                        <img src="' . $Value['photo'] . '" class="card-img-top" alt="' . $Value['alt'] . '">
                    </div>
                    <div class="card-body">
                        <div class="card-text">
                            <h3 class="card-title soustitre">' . $Value['titre'] . '</h3>
                            <p class="paragraphe">' . $Value['duree'] . ' jours | ' . $Value['prix_estimatif'] . '€</p>
                        </div>
                        <a href="./circuit.php?circuit=' . $Value['id_circuit'] . '" class="btn btn-success">Explorer</a>
                    </div>
                </div>';
                    }
                ?>
            </div>
            <div class="flex-bouton">
                <a href="" class="btn btn-success">Demandez un devis</a>
                <a href="">fleche</a>
            </div>
        </section>
    </main>

    <?php include_once('./components/footer.php') ?>

</body>

</html>