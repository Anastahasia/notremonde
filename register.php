<?php
require_once("./components/connexion.php");
require_once("./components/fonctions.php");
// var_dump($_SESSION);

if (isset($_SESSION['CurrentUser'])) {
    header("Location: " . 'index.php');
    die();
}

?>

<!DOCclass="form-control" TYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title> Inscription | Notre Monde </title>
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

        <link rel="icon" href="./images/notreMonde.png" class="form-control" type="image/x-icon">

        <link href="styles.css" rel="stylesheet" />

    </head>

    <body>
        <?php include_once('./components/nav.php'); ?>
        <main>
            <section class="signInForm">
                <div class="loginForm">
                    <h1 class="text-white">Inscription</h1>
                    <?php
                    if (isset($_SESSION['HasFailedSignedUp']) && $_SESSION['HasFailedSignedUp']) {
                        echo '<h4 class="animate__animated animate__shakeX" >Un compte existe déjà avec cette adresse email. </h4>
                    <a href="login.php"> Essayez de vous connecter ! <a>';

                        unset($_SESSION['HasFailedSignedUp']);
                    }
                    if (isset($_SESSION['MatchPassword']) && $_SESSION['MatchPassword']) {
                        echo '<h4 class="animate__animated animate__shakeX" >Les mots de passe ne correspondent pas veuillez réessayer.<a>';

                        unset($_SESSION['MatchPassword']);
                    }
                    ?>
                    <form id="registrationForm" class="text-white" action="./traitements/user.php" method="POST">
                        <div class="mb-3">
                            <label class="accent" for="nom">Nom </label>
                            <input class="form-control" type="text" name="nom" required>
                        </div>

                        <div class="mb-3">
                            <label class="accent" for="prenom">Prénom </label>
                            <input class="form-control" type="text" name="prenom" required>
                        </div>

                        <div class="mb-3">
                            <label class="accent" for="num">Numéro de téléphone </label>
                            <input class="form-control" type="text" name="num">
                        </div>

                        <div class="mb-3">
                            <label class="accent" for="email">Adresse e-mail </label>
                            <input class="form-control" type="email" name="email" required>
                        </div>

                        <div class="mb-3">
                            <label class="accent" for="mot_de_passe">Mot de passe </label>
                            <input class="form-control" type="password" name="mot_de_passe" id="mot_de_passe" required>
                        </div>

                        <div class="mb-3">
                            <label class="accent" for="verif_mot_de_passe">Confirmer le mot de passe </label>
                            <input class="form-control" type="password" name="verif_mot_de_passe" id="verif_mot_de_passe" required>
                        </div>

                        <input class="form-control" type="hidden" name="token" value="<?php echo $_SESSION['csrf_token'] ?>">


                        <input name="Intention" value="M'inscrire" class="btn btn-success" type="submit">
                        <!-- <button name="Intention" value="Signup" class="form-control" type="submit">S'inscrire</button> -->

                    </form>
                    <p class="text-white accent">Vous avez un compte? Connectez-vous <a href="./login.php">ici</a></p>
                </div>
            </section>
        </main>
        <?php include_once('./components/footer.php'); ?>
    </body>

    </html>