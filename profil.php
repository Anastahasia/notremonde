<?php
session_start();
require_once('./components/connexion.php');

// Redirect unregistered users
// if (!isset($_SESSION['CurrentUser']))
//     {
//         header("Location: " . 'index.php');
//         die();
//     }

// $CurrentUserID = $_SESSION['UserID'];
// var_dump($CurrentUserID);

$CurrentUserID = 19;

$favoris = $NewConnection->inner_join("favoris", "utilisateur", "id_utilisateur", "circuit", "id_circuit", $CurrentUserID);
// var_dump($favoris);
$itineraire = $NewConnection->select_join('utilisateur', 'id_utilisateur', 'itineraire', $CurrentUserID);
// var_dump($itineraire);
$categorie = $NewConnection->select("categorie", "*", "NOT nom='brouillon'");
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Profil | Notre Monde</title>
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Animated text -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <link rel="icon" href="./images/favicon.png" type="image/x-icon">

    <link href="./styles.css" rel="stylesheet" />
</head>

<body>
    <?php include_once('./components/nav.php'); ?>

    <header class="serveurSection">
        <h1>Bienvenue sur votre profil</h1>
        <p class="soustitre">Consultez vos voyages et circuits favoris !</p>
    </header>

    <main>
        <section>
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header titre1">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            Accordion Item #1
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="card mb-3">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="..." class="img-fluid rounded-start" alt="...">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title">Card title</h5>
                                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                            <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Accordion Item #2
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="card-container">
                                <?php
                                foreach ($favoris as $Value) {
                                    echo '
                                    <div class="card circuit-card">
                                        <div class="img-wrapper">
                                            <img src="' . $Value['photo'] . '" class="card-img-top" alt="' . $Value['alt'] . '">
                                        </div>
                                        <div class="card-body">
                                            <div>
                                                <div class="card-text">
                                                    <h3 class="card-title soustitre">' . $Value['titre'] . '</h3>
                                                    <p class="paragraphe">' . $Value['duree'] . ' jours | ' . $Value['prix_estimatif'] . '€</p>
                                                </div>
                                                <form method="get" action="./controllers/user.php">
                                                <input type="hidden" name="voyage" value="' . $Value['id_circuit'] . '">
                                                <button type="submit" id="favoris" name="Intention" value="AddFavorite" style="border-style: none;"><i class="fa-solid fa-heart" style="color: #8a817c;"></i></button>
                                                </form>
                                            </div>
                                            <a href="./circuit.php?circuit=' . $Value['id_circuit'] . '" class="btn btn-success">Explorer</a>
                                        </div>
                                    </div>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <h2 class="titre1"> Mon compte </h2>
            <div>
                <?php
                $nom = $_SESSION['CurrentUserSurname'];
                $prenom = $_SESSION['CurrentUserName'];
                $email = $_SESSION['CurrentUser'];
                $phone = $_SESSION['CurrentUserPhone']; ?>

                <p><?php echo $nom ?></p>
                <p><?php echo $prenom ?></p>
                <div class="d-flex justify-content-between">
                    <p><?php echo $email ?></p>
                    <!-- Button trigger modal -->
                    <button type="button" class="soustitre2" data-bs-toggle="modal" data-bs-target="#Modal">
                        Modifier
                    </button>
                </div>
                <div class="d-flex justify-content-between">
                    <p><?php echo $phone ?></p>
                    <!-- Button trigger modal -->
                    <button type="button" class="soustitre2" data-bs-toggle="modal" data-bs-target="#Modal">
                        Modifier
                    </button>
                </div>
                <div class="d-flex justify-content-between">
                    <p>Mot de passe</p>
                    <!-- Button trigger modal -->
                    <button type="button" class="soustitre2" data-bs-toggle="modal" data-bs-target="#Modal">
                        Modifier
                    </button>
                </div>
            </div>


            <!-- Modal -->
            <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modifier</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="text" value="">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" id="ModalSubmitButton" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </main>
    <?php include_once('./components/footer.php'); ?>
    <script>
        let myModal = document.getElementById('Modal');

        // Puisque la page recharge à chaque fois, y'a pas besoin de removeEventListener
        myModal.addEventListener('shown.bs.modal', function(event) {
            let SubmitButton = document.getElementById('ModalSubmitButton');

            SubmitButton.onclick = function() {
                // change le name du button
                event.relatedTarget.type = "submit";
                event.relatedTarget.click();
            };

            return event.preventDefault();
        });
    </script>
</body>

</html>