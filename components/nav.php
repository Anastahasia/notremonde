<?php
require_once("./components/connexion.php");

// if (session_id() == "") {
//     session_start();
// }

// var_dump($_SESSION);
$IsUserLoggedIn = isset($_SESSION['CurrentUser']);
$ViewDashbord = (isset($_SESSION['UserRole']) && $_SESSION['UserRole'] == 'admin');

$destinations = $NewConnection->select("continent");
$thematiques = $NewConnection->select("categorie", "NOT nom", "brouillon");
?>
<!-- Responsive navbar-->
<nav class="navbar navbar-expand-lg nav-underline" style="background-color:#fff;">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php"><img src="images/notreMondeLogo.png" alt="Logo Notre Monde"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div>
            <ul class="navbar-nav mb-2 mb-lg-0 column-gap-4">
                <li class="nav-item"><a class="nav-link" href="index.php">Accueil</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="circuit.php">Circuits</a>
                    <ul class="dropdown-menu">
                        <li class="dropend">
                            <a class="dropdown-item dropdown-toggle" href="#">Destinations</a>
                            <ul class="">
                                <?php foreach ($destinations as $Value) {
                                    echo '<li><a href="./destination.php?destination=' . $Value['id_continent'] . '" class="dropdown-item">' . $Value['nom'] . '</a></li>';
                                }
                                ?>
                            </ul>
                        </li>
                        <li class="dropend">
                            <a class="dropdown-item dropdown-toggle" href="#">Thématiques</a>
                            <ul>
                                <?php foreach ($thematiques as $Value) {
                                    echo '<li><a href="./destination.php?categorie=' . $Value['id_categorie'] . '" class="dropdown-item">' . $Value['nom'] . '</a></li>';
                                }
                                ?>
                            </ul>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a href="destination.php" class="dropdonw-item">Tous les circuits</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                <?php if ($IsUserLoggedIn) : ?>
                    <li class="nav-item">
                        <a href="./profil.php" class="nav-link">Profil</a>
                    </li>
                <?php endif; ?>
                <?php if ($IsUserLoggedIn && $ViewDashbord) : ?>
                    <li class="nav-item">
                        <a href="./gestion.php" class="nav-link">Tableau de bord</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
        <div z-index="2" class="float-login d-flex">
            <a href="" class="btn btn-success">Devis</a>
            <?php if ($IsUserLoggedIn) : $UserIcon = './images/icons_user.png';
            ?>
                <div class="d-grid connected">
                    <a class="nav-link" href="./profil.php"><img src=<?php echo '"' . $UserIcon . '"'; ?> alt="User Role Image" style="width: 32px; height: 32px;"></a>
                    <form method="POST" action="./traitements/user.php"><button type="submit" name="Intention" value="Logout" class="btn p-0">Deconnexion</button><input type="hidden" name="token" value="<?php echo $_SESSION['csrf_token'] ?>"></form>
                </div>
            <?php else : ?>
                <a class="nav-link d-grid" href="./login.php"><img src="./images/icons_user.png" alt="User Role Image" style="width: 32px; height: 32px;"><span class="mx-auto" >Connexion</span></a>
            <?php endif ?>
        </div>
    </div></div>
</nav>