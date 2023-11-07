<?php
session_start();

require_once('./components/connexion.php');
require_once("./components/fonctions.php");

$circuits = $NewConnection->select("circuit", "visible");
// var_dump($circuits);
$pays = $NewConnection->select_distinct('pays', 'ville');
// var_dump($pays);
$categorie = $NewConnection->select("categorie", "NOT id_categorie", "1");
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Contact | Notre Monde</title>
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
    <main>
        <div>
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" data-bs-target="#Quotation" data-bs-toggle="tab" type="button" role="tab" aria-selected="true">Devis</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-target="#Email" data-bs-toggle="tab" type="button" role="tab" aria-selected="false">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-target="#Comptes" data-bs-toggle="tab" type="button" role="tab" aria-selected="false">Coordonnées</a>
                </li>
            </ul>
        </div>

        <!-- Formulaire de devis -->
        <div class="tab-content">
            <div class="tab-pane fade show active" id="Quotation">
                <?php if (isset($_POST['AskQuotation']) && $MessageSent) : ?>
                    <h4>Votre demande a bien été envoyé. Vous recevrez votre devis dans les plus brefs délais !</h4>
                <?php else : ?>
                    <h4 class="titre2">Votre futur voyage</h4>
                    <div class="form-container">
                        <form class="contactForms" method="post" action="./traitements/user.php">
                            <div class="mb-3">
                                <label for="arrivalDate" class="form-label soustitre">Quand souhaitez-vous voyager ? </label>
                                <input type="date" name="arrivalDate" id="" placeholder="Votre date d'arrivée">
                                <input type="date" name="departureDate" id="" placeholder="Votre date de retour">
                            </div>
                            <!-- <div class="mb-3">
                        <label for="duree" class="form-label soustitre">Combien de temps souhaitez vous rester ? </label>
                        <input type="date" name="duree" id="" placeholder="Durée estimée">
                    </div> faire apparaître lors d'un clique sur une check box ? question Connaissez-vous vos dates de voyage ?-->
                            <div class="mb-3">
                                <label for="adults" class="form-label soustitre">Avec qui voyagez vous ? </label>
                                <input type="number" name="adults" id="" placeholder="Nombre d'adultes" min="0" required>
                                <input type="number" name="children" id="" placeholder="Nombre d'enfants" min="0" required>
                            </div>

                            <h4 class="titre2">Le voyage de vos rêves</h4>
                            <div class="mb-3">
                                <label for="inspi" class="form-label soustitre">Souhaitez-vous personnaliser un circuit présent sur le site ?</label>
                                <select class="form-select" name="inspi" aria-label="Default select example" required>
                                    <option value="Aucun" selected>Choisissez le circuit</option>
                                    <?php foreach ($circuits as $Value) {
                                        echo '<option value="' . $Value['titre'] . '">' . $Value['titre'] . '</option>';
                                    } ?>
                                </select>
                            </div>
                            <p class="soustitre">Par quel type de voyage êtes-vous intéressé ?</p>
                            <div class="check-flex">
                                <?php foreach ($categorie as $Value) {
                                    echo '<div class="form-check">   
                                <input class="form-check-input" type="radio" value="' . $Value['nom'] . '" name="categorie" required>
                                <label class="form-check-label" for="pays">
                                    ' . $Value['nom'] . '
                                </label>
                            </div>';
                                } ?>
                            </div>
                            <p class=" soustitre">Quelle est la destination dont vous rêvez ?</p>
                            <div class="check-flex">
                                <?php foreach ($pays as $Value) {
                                    echo '<div class="form-check">   
                                <input class="form-check-input" type="radio" value="' . $Value['pays'] . '" name="pays" required>
                                <label class="form-check-label" for="pays">
                                    ' . $Value['pays'] . '
                                </label>
                            </div>';
                                } ?>
                            </div>

                            <!-- informations de contact de l'utilisateur -->
                            <?php if (isset($_SESSION['CurrentUser'])) :
                                $nom = $_SESSION['CurrentUserSurname'];
                                $prenom = $_SESSION['CurrentUserName'];
                                $email = $_SESSION['CurrentUser']; ?>
                                <div class="mb-3">
                                    <label for="nom" class="form-label soustitre">Nom</label>
                                    <p><?php echo $nom ?></p>
                                </div>
                                <div class="mb-3">
                                    <label for="prenom" class="form-label soustitre">Prénom</label>
                                    <p><?php echo $prenom ?></p>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label soustitre">Adresse email</label>
                                    <p><?php echo $email ?></p>
                                </div>
                            <?php else : ?>
                                <div class="mb-3">
                                    <label for="nom" class="form-label soustitre">Nom</label>
                                    <input type="text" class="form-control" name="nom" placeholder="Votre nom" required>
                                </div>
                                <div class="mb-3">
                                    <label for="prenom" class="form-label soustitre">Prénom</label>
                                    <input type="text" class="form-control" name="prenom" placeholder="Votre prénom" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label soustitre">Adresse email</label>
                                    <input type="email" class="form-control" name="email" placeholder="name@example.com" required>
                                </div>
                            <?php endif ?>
                            <div class="mb-3">
                                <label for="message" class="form-label soustitre">Message</label>
                                <textarea class="form-control" name="message" rows="4" required></textarea>
                            </div>
                            <div>
                                <input type="hidden" name="token" value="<?php echo $_SESSION['csrf_token'] ?>">
                                <button type="submit" name="AskQuotation" class="btn btn-success">Submit</button>
                            </div>
                        </form>
                    </div>
                <?php endif ?>
            </div>


            <!-- Formulaire de contact -->
            <div class="tab-pane fade show" id="Email">
                <?php if (isset($_POST['SendEmail']) && $MessageSent) : ?>
                    <h4>Merci pour votre message. Nous revenons vers vous dans les plus brefs délais</h4>
                <?php else : ?>
                    <h4 class="titre2">Envoyez nous un message</h4>
                    <div class="form-container">
                        <form class="contactForms" method="post" action="./traitements/user.php">
                            <?php if (isset($_SESSION['CurrentUser'])) :
                                $nom = $_SESSION['CurrentUserSurname'];
                                $prenom = $_SESSION['CurrentUserName'];
                                $email = $_SESSION['CurrentUser']; ?>
                                <div class="mb-3">
                                    <label for="nom" class="form-label soustitre">Nom</label>
                                    <p><?php echo $nom ?></p>
                                </div>
                                <div class="mb-3">
                                    <label for="prenom" class="form-label soustitre">Prénom</label>
                                    <p><?php echo $prenom ?></p>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label soustitre">Adresse email</label>
                                    <p><?php echo $email ?></p>
                                </div>
                            <?php else : ?>
                                <div class="mb-3">
                                    <label for="nom" class="form-label soustitre">Nom</label>
                                    <input type="text" class="form-control" name="nom" placeholder="Votre nom" required>
                                </div>
                                <div class="mb-3">
                                    <label for="prenom" class="form-label soustitre">Prénom</label>
                                    <input type="text" class="form-control" name="prenom" placeholder="Votre prénom" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label soustitre">Adresse email</label>
                                    <input type="email" class="form-control" name="email" placeholder="name@example.com" required>
                                </div>
                            <?php endif ?>
                            <div class="mb-3">
                                <label for="sujet" class="form-label soustitre">Sujet</label>
                                <input type="text" class="form-control" id="sujet" name="sujet" placeholder="Voyage en Italie" required>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label soustitre">Message</label>
                                <textarea class="form-control" name="message" rows="4" required></textarea>
                            </div>
                            <div>
                                <input type="hidden" name="token" value="<?php echo $_SESSION['csrf_token'] ?>">
                                <button type="submit" name="SendEmail" class="btn btn-success">Submit</button>
                            </div>
                        </form>
                    </div>
                <?php endif ?>
            </div>
        </div>

    </main>
    <?php include_once('./components/footer.php'); ?>
</body>

</html>