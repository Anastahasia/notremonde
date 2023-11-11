<?php

require_once('./components/connexion.php');
require_once("./components/fonctions.php");

$CurrentDestinationID = isset($_GET['destination']) ? $_GET['destination'] : 0;
$SelectedDestination = $NewConnection->select("continent", "id_continent", $CurrentDestinationID);

$CurrentCategorieID = isset($_GET['categorie']) ? $_GET['categorie'] : 0;
$SelectedCategorie = $NewConnection->select("categorie", "id_categorie", $CurrentCategorieID);

if ($CurrentDestinationID) {
    $circuits = $NewConnection->select_multi_conditions("circuit", array(
        'visible' => 1,
        'continent' => $CurrentDestinationID,
    ));
} elseif ($CurrentCategorieID) {
    $circuits = $NewConnection->select_multi_conditions("circuit", array(
        'visible' => 1,
        'continent' => $CurrentCategorieID,
    ));
} else {
    $circuits = $NewConnection->select("circuit", "visible");
}

$_SESSION['UserID'] = 1;
if (isset($_SESSION['UserID'])) {
    $session = $_SESSION['UserID'];
} else {
    $session = "";
}
var_dump($_SESSION, $_GET);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title> <?php
            $Title = "Circuits";
            if ($CurrentDestinationID) {

                foreach ($SelectedDestination as $Key => $Value) {
                    $Title = $Value['nom'];
                }
                echo $Title;
            } else if ($CurrentCategorieID) {
                foreach ($SelectedCategorie as $Key => $Value) {
                    $Title = $Value['nom'];
                }
                echo $Title;
            } else {
                echo $Title;
            } //mettre un else if incluant un for each pour catégories 
            ?>
        | Notre Monde</title>
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="icon" href="./images/favicon.png" type="image/x-icon">

    <link href="./styles.css" rel="stylesheet" />
</head>

<body>
    <?php
    include_once('./components/nav.php');

    include_once('./components/HeaderFiltre.php')

    ?>
    <main>
        <section>

            <?php
            if ($CurrentDestinationID) {
                echo '
                   <div id="haut" class="flex-text">
                        <h2 class="titre">' . $SelectedDestination[0]['nom'] . '</h2>
                        <a href="destination.php" class="soustitre2">Tous les circuits</a>
                   </div>';
                echo '<p>' . $SelectedDestination[0]['description'] . '</p>';
            } elseif ($CurrentCategorieID) {
                echo '
                    <div id="haut" class="flex-text">
                        <h2 class="titre">' . $SelectedCategorie[0]['nom'] . '</h2>
                        <a href="destination.php" class="soustitre2">Tous les circuits</a>
                    </div>';
                echo '<p>' . $SelectedCategorie[0]['description'] . '</p>';
            } else {
                echo '<div id="haut" class="flex-text">
                    <h2 class="titre">Tous nos circuits disponibles.</h2></div>';
            }

            if (isset($_SESSION['Failed']) && $_SESSION['Failed']) {
                echo '<h4 class="animate__animated animate__shakeX" >Connectez vous pour ajouter des favoris</h4>';

                unset($_SESSION['Failed']);
            }
            ?>

            <div class="card-container">
                <?php
                if (empty($circuits) && $CurrentDestinationID) {
                    echo '<p class="animate__animated animate__shakeX" >Pas de circuits disponible sur cette destination pour le moment...</p>
                   <a href="destination.php">Voir tous les circuits.</a>';
                } elseif (empty($circuits) && $CurrentCategorieID) {
                    echo '<p class="animate__animated animate__shakeX">Pas de circuits disponible dans cette thématique pour le moment...</p>
                    <a href="destination.php">Voir tous les circuits.</a>';
                }
                foreach ($circuits as $Value) {
                    echo '
                <div class="card circuit-card">
                    <div class="img-wrapper">
                        <img src="' . GetImagePath($Value['photo']) . '" class="card-img-top" alt="' . $Value['alt'] . '">
                    </div>
                    <div class="card-body">
                        <div class="card-text">
                            <div>
                                <h3 class="card-title soustitre">' . $Value['titre'] . '</h3>
                                <p class="paragraphe">' . $Value['duree'] . ' jours | ' . $Value['prix_estimatif'] . '€</p>
                            </div>
                            <form>
                                <input type="hidden" name="voyage" id="voyage" value="' . $Value['id_circuit'] . '">
                                <input type="hidden" name="token" id="csrf_token" value="' . $_SESSION['csrf_token'] . '">
                                <input type="hidden" name="user_id" id="user_id" value="' . $session . '">
                                <button id="favoris" name="AddFavorite" style="border-style: none;"><i class="fa-regular fa-heart" style="color: #000000;"></i></button>
                            </form>
                        </div>
                        <a href="./circuit.php?circuit=' . $Value['id_circuit'] . '" class="btn btn-success">Explorer</a>
                    </div>
                </div>';
                }
                ?>
            </div>
        </section>
        <div class="flex-bouton">
            <a href="" class="btn btn-success">Demandez un devis</a>
            <a href="haut"><i class="fa-solid fa-circle-arrow-up" style="color: #1b512d9b;"></i></a>
        </div>
    </main>

    <?php include_once('./components/footer.php') ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        let FavoriteButton = document.getElementsByTagName('.favoris')
        $(document).ready(function($) {
            $("#favoris").click(function(e) {
                e.preventDefault();
                var formData = {
                    favorite: $('#favoris').val(),
                    circuit: $('#voyage').val(),
                    utilisateur: $('#user_id').val(),
                    token: $('#csrf_token').val(),
                };
                const user_id = $('#user_id').val();
                if (Boolean(user_id)) {
                    console.log(user_id)

                    $.ajax({
                        url: './traitements/user.php',
                        type: "POST",
                        data: formData,
                        dataType: 'json',
                        cache: false,
                        success: function(data) {
                            console.log(formData);
                        },
                        error: function(data) {
                            console.log(data)
                            alert("erreur lors de l'envoi des données")
                        }
                    });
                };
            });
        })
    </script>
</body>

</html>