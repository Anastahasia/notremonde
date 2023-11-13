<?php
require_once('./components/connexion.php');
require_once("./components/fonctions.php");

$CurrentCircuitID = isset($_GET['circuit']) ? $_GET['circuit'] : 0;
$SelectedCircuit = $NewConnection->select_multi_conditions("circuit", array(
    "id_circuit" => $CurrentCircuitID,
    "visible" => 1
));
$IdCategorie = $SelectedCircuit[0]['categorie'];
$SelectedCategorie = $NewConnection->select("categorie", "id_categorie", $IdCategorie);
// var_dump($SelectedCircuit);
if (empty($SelectedCircuit)) {
    header("Location: " . "./destination.php");
}
$SelectedSteps = $NewConnection->select_etape("etape_circuit", "hebergement", "id_hebergement", "ville", "id_ville", $CurrentCircuitID);

$circuits = $NewConnection->select_random("circuit", "NOT id_circuit", $CurrentCircuitID);
//  var_dump($IdCategorie, $SelectedCategorie);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>
        <?php
        $CircuitsName = "";
        foreach ($SelectedCircuit as $Key => $Circuit) {
            $CircuitsName = $Circuit['titre'];
        }
        echo $CircuitsName;
        ?> | Notre Monde</title>
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="icon" href="./images/favicon.png" type="image/x-icon">

    <link href="styles.css" rel="stylesheet" />
</head>

<body>
    <?php
    include_once('./components/nav.php');
    ?>

    <main id="Circuit">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item accent"><a href="index.php">Accueil</a></li>
                <li class="breadcrumb-item accent"><a href="destination.php?categorie=<?php echo $IdCategorie ?>"><?php echo $SelectedCategorie[0]['nom'] ?></a></li>
                <li class="breadcrumb-item accent active" aria-current="page"><?php echo $CircuitsName ?></li>
            </ol>
        </nav>

        <header class="presentation" id="top">
            <?php foreach ($SelectedCircuit as $Circuit) {

                echo '
            <div class="img-presentation">
                <img src="' . GetImagePath($Circuit['photo']) . '" alt="' . $Circuit['alt'] . '">
            </div>
            <div class="txt-presentation">
                <h1 class="titre">' . $Circuit['titre'] . '</h1>
                <p>' . $Circuit['description'] . '</p>
                <p class="soutitre">Catégorie: ' . $Circuit['categorie'] . '</p>
                <p class="soutitre">Durée: ' . $Circuit['duree'] . ' jours</p>
                <p class="titre2">À partir de: ' . $Circuit['prix_estimatif'] . '€</p>
                <div style="text-align:center;">
                    <a href="" class="btn btn-success">Demandez un devis</a>
                </div>
            </div>';
            } ?>
        </header>
        <section>
            <h2 class="titre1">Circuit</h2>
            <?php foreach ($SelectedSteps as $Step) {
                echo '
            <div class="flex-etape">
                <hr>
                <h3 class="titre2 etape">étape ' . $Step['ordre'] . '</h3>
                <hr>
            </div>
            <div class="etape-display">
                <div class="txt-etape">
                    <p class="accent">jour ' . $Step['jourArrivee'] . ' à jour ' . $Step['jourDepart'] . '</p>
                    <p>' . $Step['descriptionEtape'] . '</p>
                    <p class="accent">' . $Step['nom'] . '</p>
                    <p>' . $Step['type'] . '</p>
                    <p>' . $Step['descriptionHebergement'] . '</p>
                </div>
                <div class="img-presentation">
                    <div id="carouselExample" class="carousel slide w-100">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="' . GetImagePath($Step['photoVille']) . '" class="" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="' . GetImagePath($Step['photo1']) . '" class="" alt="photo de ' . $Step['nom'] . '">
                            </div>
                            <div class="carousel-item">
                                <img src="' . GetImagePath($Step['photo2']) . '" class="" alt="' . $Step['nom'] . '">
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
            </div>';
            } ?>
        </section>
        <div class="flex-bouton">
            <a href="" class="btn btn-success">Demandez un devis</a>
            <a href="#top"><i class="fa-solid fa-circle-arrow-up" style="color: #1b512d9b;"></i></a>
        </div>
        <section>
            <div class="flex-text">
                <h2 class="titre1">ça pourrait vous plaire...</h2>
                <a href="destination.php" class="soustitre2">Tous les circuits</a>
            </div>
            <div class="card-container">
                <?php foreach ($circuits as $Value) {
                    echo '
                <div class="card circuit-card">
                    <div class="img-wrapper">
                        <img src="' . GetImagePath($Value['photo']) . '" class="card-img-top" alt="' . $Value['alt'] . '">
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
        </section>
    </main>

    <?php include_once('./components/footer.php') ?>

</body>