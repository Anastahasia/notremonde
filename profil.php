<?php
// Redirect unregistered users
// if (!isset($_SESSION['CurrentUser']))
//     {
//         header("Location: " . 'index.php');
//         die();
//     }

require_once('./components/connexion.php');
require_once("./components/fonctions.php");



$CurrentUserID = $_SESSION['UserID'];
// var_dump($CurrentUserID);

// $CurrentUserID = 19;

$favoris = $NewConnection->inner_join("favoris", "utilisateur", "id_utilisateur", "circuit", "id_circuit", $CurrentUserID);
// var_dump($favoris);

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
        <?php
            if (isset($_SESSION['SuccessfulUpdate']) && $_SESSION['SuccessfulUpdate']) {
                echo '<h4 class="titre2" >Modification réussie.</h4>';

                unset($_SESSION['SuccessfulUpdate']);

            }else if (isset($_SESSION['FailedUpdate']) && $_SESSION['FailedUpdate']) {
                echo '<h4 class="titre2" >La modification a échoué ! Veuillez réessayer.</h4>';
                unset($_SESSION['FailedUpdate']); 
            }
            ?>
    </header>

    <main>
        <section>
            <div class="accordion" id="accordionExample">
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
                                                <form method="get" action="./traitements/user.php">
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
                <div class="mt-3">
                    <form class="d-flex justify-content-between" action="./traitements/user.php" method="POST">
                        <input type="text" value="<?php echo $email ?>" name="email">
                        <!-- hidden button for token verifMdpication -->
                        <input type="hidden" name="token" value="<?php echo $_SESSION['csrf_token'] ?>">
                        <!-- Button trigger modal -->
                        <button type="button" name="modifyEmail" class="soustitre2" data-bs-toggle="modal" data-bs-target="#UpdateModal">
                            Modifier
                        </button>
                    </form>
                </div>
                <div class="mt-3">
                    <form class="d-flex justify-content-between" action="./traitements/user.php" method="POST">
                        <input type="text" value="<?php echo $phone ?>" name="phone">
                        <!-- hidden button for token verifMdpication -->
                        <input type="hidden" name="token" value="<?php echo $_SESSION['csrf_token'] ?>">
                        <!-- Button trigger modal -->
                        <button type="button" name="modifyPhone" class="soustitre2" data-bs-toggle="modal" data-bs-target="#UpdateModal">
                            Modifier
                        </button>
                    </form>
                </div>
                <div class="d-flex justify-content-between mt-3">
                    <p>Mot de passe</p>
                    <!-- Button trigger modal -->
                    <button type="button" class="soustitre2" data-bs-toggle="modal" data-bs-target="#PasswordModal">
                        Modifier
                    </button>
                </div>
            </div>

            <!-- Modal de Update-->
            <div class="modal fade" id="UpdateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Êtes-vous sûrs de vouloir effectuer cette modification ?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <button type="button" id="ModalSubmitButton" class="btn btn-danger">Oui</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal de Update du mot de passe -->
            <div class="modal fade" id="PasswordModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title fs-5" id="exampleModalLabel">Modifiez votre mot de passe</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="./traitements/user.php" method="POST">
                            <div class="modal-body">

                                <div class="mb-3">
                                    <label for="oldMdp" class="col-form-label">Ancien mot de passe</label>
                                    <input type="password" class="form-control" name="oldMdp">
                                </div>
                                <div class="mb-3">
                                    <label for="newMdp" class="col-form-label">Nouveau mot de passe</label>
                                    <input type="password" class="form-control" name="newMdp" id="newMdp">
                                </div>
                                <div class="mb-3">
                                    <label for="verifMdp" class="col-form-label">Confirmation du mot de passe</label>
                                    <input type="password" class="form-control" name="verifMdp" id="verifMdp">
                                </div>
                                <input type="hidden" name="token" value="<?php echo $_SESSION['csrf_token'] ?>">

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                <button type="submit" name="modifyMDP" class="btn btn-primary" id="PasswordSubmitButton">Enregistrer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <?php include_once('./components/footer.php'); ?>
    <script>
        let myModal = document.getElementById('UpdateModal');

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

//         let PasswordButton = document.getElementById('PasswordSubmitButton')
//         function validate() {
//  PasswordButton.addEventListener('click', function(event){
//      let newMDP = document.getElementById("newMdp").value;
//  let verif = document.getElementById("verifMdp").value; 
//  if (newMDP!=verif) {
//      alert("Les mots de passe ne correspondent pas.");
//      return false; }
//  else {
//      alert("Les mots de passe correspondent.");
//      return true; }}
//  )}



    </script>
</body>

</html>