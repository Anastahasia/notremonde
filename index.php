<?php
require_once('./components/connexion.php');
require_once("./components/fonctions.php");

$destinations = $NewConnection->select("continent");
$circuits = $NewConnection->select_random("circuit", "categorie");

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

    include_once('./components/HeaderFiltre.php')

    ?>
    <main>
        <!-- Features section-->
        <section class="" id="features">
            <div class="wrapper">
                <h2 class="titre pb-4">Nos destinations</h2>
            </div>
            <div id="carouselAutoplaying" class="carousel" data-bs-ride="carousel">
                <div class="carousel-inner card-carousel-inner">

                    <?php
                    foreach ($destinations as $Value) {

                        echo
                        '
                        <div class="carousel-item card-carousel-item active">
                            <div class="card card-carousel">
                                <div class="img-wrapper">
                                    <img src="' . GetImagePath($Value['illustration']) . '" class="card-img-top" alt="...">
                                </div>
                                <div class="card-body carousel-card-body px-2">
                                    <h3 class="card-title soustitre">' . $Value['nom'] . '</h3>
                                    <a href="./destination.php?destination=' . $Value['id_continent'] . '" class="btn btn-success">Explorer</a>
                                </div>
                            </div>
                        </div>';
                    } ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselAutoplaying" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselAutoplaying" data-bs-slide="next">
                    <span class="carousel-control-next-icon prev-icon"></span>
                </button>
            </div>
        </section>

        <section>
            <div id="sur-mesure">
                <div class="rectangle">
                    <img src="images/San Miguell di allende MEXICO.jpg" alt="The fairy glen">
                </div>
                <div class="text">
                    <h3 class="titre2">
                        Partir avec nous
                    </h3>
                    <p>Tous nos circuits sont modifiables pour répondre à vos besoins spécifiques. Vous pouvez ajuster l'itinéraire, la durée et les activités pour créer une expérience de voyage sur mesure.
                        <span> Laissez-vous guider par notre agence de voyage dédiée au slow travel pour une aventure qui vous permettra de savourer chaque moment de votre voyage. Explorez les destinations avec une perspective différente, en prenant le temps de vous connecter avec les habitants et de vous imprégner de la beauté du voyage lui-même.</span> 
                        <b> N’hésitez plus !
                            Tous les circuits sont adaptables ....</b>
                    </p>
                    <button type="button" class="btn btn-success">Explorer</button>
                </div>
            </div>
        </section>

        <section class="">
            <div id="carouselDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    foreach ($circuits as $Value) {
                        echo
                    '<div class="carousel-item active">
                        <div class="carousel-img-wrapper">
                            <img src="' . GetImagePath($Value['photo']) . '" class="d-block w-100" alt="' . $Value['alt'] . '">
                        </div>
                        <div class="carousel-caption d-none d-md-block">
                            <div class="autour">
                                <h3 class="soustitre">' . $Value['titre'] . '</h3>
                            </div>
                        </div>
                        <div class="autour position">
                            <a href="./circuit.php?circuit=' . $Value['id_circuit'] . '" class="btn btn-success accent">Explorer</a>
                        </div>
                    </div>';
                    }
                    ?>
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselDark" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselDark" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

            <div class="why-us">
                <div class="why-us-items">
                    <div class="why-us-item">
                        <div class="icon-wrapper">
                            <img src="images/original.png" alt="logo avec l'inscription originale">
                        </div>
                        <p class="accent">Expérience Authentique</p>
                    </div>
                    <div class="why-us-item">
                        <div class="icon-wrapper">
                            <img src="images/la-flexibilite" alt="Des fleches qui prennent plusieurs chemins différents">
                        </div>
                        <p class="accent">Flexibilité Totale</p>
                    </div>
                    <div class="why-us-item">
                        <div class="icon-wrapper">
                            <img src="images/trust.png" alt="Personnage qui croise les bras">
                        </div>
                        <p class="accent">Professionnalisme</p>
                    </div>
                </div>
                <button type="button" class="btn btn-success">Explorer</button>
                <p>
                    N’hésitez plus ! Si vous avez des questions...
                </p>
            </div>
        </section>
    </main>

    <?php include_once('./components/footer.php') ?>

</body>

</html>