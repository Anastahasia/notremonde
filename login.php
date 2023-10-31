<?php
session_start();
require_once("./components/connexion.php");
require_once("./components/communs.php");
// var_dump($_SESSION);

if (isset($_SESSION['CurrentUser'])) {
    header("Location: " . 'index.php');
    die();
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Connexion | Notre Monde </title>
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <link rel="icon" href="./images/favicon.png" type="image/x-icon">

    <link href="styles.css" rel="stylesheet" />

</head>

<body>
    <?php include_once('./components/nav.php'); ?>
    <main>
        <section class="loginForm">
            <h1>Connexion</h1>
            <?php
            if (isset($_SESSION['HasFailedLogin']) && $_SESSION['HasFailedLogin']) {
                echo '<h4 class="animate__animated animate__shakeX" >Email ou mot de passe incorrect.</h4>';

                unset($_SESSION['HasFailedLogin']);
            }
            ?>

            <form action="./controllers/user.php" method="POST">
                <div class="input-group">
                    <label for="email">Adresse e-mail :</label>
                    <input type="email" name="email" required>
                </div>

                <div class="input-group">
                    <label for="mot_de_passe">Mot de passe :</label>
                    <input type="password" name="mot_de_passe" required>
                </div>

                <input type="hidden" name="token" value="<?php echo $_SESSION['csrf_token'] ?>">

                <div class="input-group">
                    <input name="Intention" value="Login" type="submit">
                    <!-- <button name="Intention" value="Login" type="submit">Se connecter</button> -->
                </div>
            </form>
        </section>
    </main>
    <?php include_once('./components/footer.php'); ?>
</body>

</html>