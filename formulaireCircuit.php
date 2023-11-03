<?php
session_start();
require_once('./components/connexion.php');
require_once("./components/communs.php");

$CurrentCircuitID = isset($_GET['circuit']) ? $_GET['circuit'] : 0;
$SelectedCircuit = $NewConnection->select_visible("circuit", "id_circuit", $CurrentCircuitID);

$IdCategorie = $SelectedCircuit[0]['categorie'];
$SelectedCategorie = $NewConnection->select("categorie", "id_categorie", $IdCategorie);

$AllCategories = $NewConnection->select("categorie");
// var_dump($SelectedCircuit, $AllCategories);
if (empty($SelectedCircuit)) {
    header("Location: " . "./destination.php");
}
$SelectedSteps = $NewConnection->select_etape("etape_circuit", "hebergement", "id_hebergement", "ville", "id_ville", $CurrentCircuitID);


?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title> Accueil | Notre Monde</title>
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
    ?>
    <main>
        <header class="presentation">

            <?php

            foreach ($SelectedCircuit as $Circuit) {


                echo '
            <div class="img-presentation">
                <div class="mb-3">
                    <label for="circuitImage">Sélectionnez une image :</label>
                    <input type="file" class="form-control" name="circuitImage" accept="image/png, image/jpeg">
                </div>
                <img src="' . $Circuit['photo'] . '" alt="' . $Circuit['alt'] . '">
            </div>
            <div class="txt-presentation">
                <h1 class="titre1" contenteditable="true">' . $Circuit['titre'] . '</h1>
                <p contenteditable="true">' . $Circuit['description'] . '</p>
                <div class="mb-3">
                    <label class="soutitre" for="duree">Durée:</label>
                    <input type="text" class="form-control d-inline w-50 titre2" name="duree" value="' . $Circuit['duree'] . '">  jours</input>
                </div>
                <div class="mb-3">
                    <label class="soutitre" for="duree">Durée:</label>
                    <input type="text" class="form-control d-inline w-50 titre2" name="duree" value="' . $Circuit['prix_estimatif'] . '"> €
                </div>
            </div>';
            }
            ?>
        </header>
        <h2 class="titre1">Circuit</h2>
        <?php foreach ($SelectedSteps as $Step) {
            echo '
        <div class="flex-etape">
            <hr>
            <div class="mb-3">
                <label class="titre2 etape" for="ordre">étape <label>
                <input type="num" class="form-control d-inline w-25 titre2" name="ordre" value="' . $Step['ordre'] . '">
            </div>
            <hr>
        </div>
        <section class="etape-display presentation">
            <div class="txt-etape">
                <p class="accent">jour <input type="num" class="form-control d-inline w-25 titre2" name="jourArrivee" value="' . $Step['jourArrivee'] . '"> à jour <input type="num" class="form-control d-inline w-25 titre2" name="jourDepart" value="' . $Step['jourDepart'] . '"></p>
                <p contenteditable="true">' . $Step['descriptionEtape'] . '</p>
                <p class="accent">' . $Step['nom'] . '</p>
                <p>' . $Step['type'] . '</p>
                <p>' . $Step['descriptionHebergement'] . '</p>
            </div>
            <div class="img-presentation">
                <div id="carouselExample" class="carousel slide">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="' . $Step['photoVille'] . '" class="" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="' . $Step['photo1'] . '" class="" alt="photo de ' . $Step['nom'] . '">
                        </div>
                        <div class="carousel-item">
                            <img src="' . $Step['photo2'] . '" class="" alt="' . $Step['nom'] . '">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </section>';
        } ?>
    </main>
    <?php include_once('./components/footer.php') ?>

</body>

</html>