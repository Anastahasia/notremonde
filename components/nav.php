<?php
require_once("./components/connexion.php");

// if (session_id() == "") {
//     session_start();
// }

var_dump($_SESSION);
$IsUserLoggedIn = isset($_SESSION['CurrentUser']);
// $CanEditArticles = (isset($_SESSION['UserRole']) && CanEditArticles($_SESSION['UserRole']));

?>
<!-- Responsive navbar-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark nav-underline">
    <div class="container px-5">
        <a class="navbar-brand" href="#!">Start Bootstrap</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Accueil</a></li>
                <li class="nav-item"><a class="nav-link" href="destination.php">Destination</a></li>
                <li class="nav-item"><a class="nav-link" href="circuit.php">Circuits</a></li>
                <li class="nav-item"><a class="nav-link" href="gestion.php">Gestion</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
            </ul>
        </div>
        <div z-index="2" class="float-login">
        <i class="fa-solid fa-magnifying-glass" style="color: #000000;"></i>
            <a href="" class="btn btn-success">Devis</a>
            <?php if ($IsUserLoggedIn) : $UserIcon = './images/icons_user.png';
            ?>
                <a href="./profil.php"><img src=<?php echo '"' . $UserIcon . '"'; ?> alt="User Role Image" style="width: 32px; height: 32px;"></a>
                <form method="POST" action="./controllers/user.php"><button type="submit" name="Intention" value="Logout" class="ConnexionButtons red-button">Deconnexion</button></form>
            <?php else : ?>
                <button class="ConnexionButtons green-button" style="border-style: none;" onclick="window.location='./login.php'">Login</button>
            <?php endif ?>
        </div>
    </div>
</nav>