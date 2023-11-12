<?php
require_once('./components/connexion.php');
require_once("./components/fonctions.php");
// var_dump($_SESSION);

// Redirect unregistered users
// if (!isset($_SESSION['UserRole']) || $_SESSION['UserRole'] != 'admin')
//     {
//         header("Location: " . 'index.php');
//         die();
//     }



$AllCircuits = $NewConnection->select("circuit");
$AllAccomodations = $NewConnection->select("hebergement");
$AllUsers = $NewConnection->select("utilisateur");
// var_dump($AllUsers);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title> Gestion | Notre Monde</title>
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="icon" href="./images/favicon.png" type="image/x-icon">

    <link href="styles.css" rel="stylesheet" />
</head>

<body>
    <?php include_once('./components/nav.php'); ?>
    <header>
        <h1>Tableau de bord</h1>
        <p class="soustitre">Gérez les circuits en quelques clics!</p>
    </header>
    <main>
        <!-- Le menu du Dashbord -->
        <div>
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item soustitre">
                    <a class="nav-link active" aria-current="page" data-bs-target="#Circuits" data-bs-toggle="tab" type="button" role="tab" aria-selected="true">Circuits</a>
                </li>
                <li class="nav-item soustitre">
                    <a class="nav-link" aria-current="page" data-bs-target="#Hebergements" data-bs-toggle="tab" type="button" role="tab" aria-selected="false">Hébergements</a>
                </li>
                <li class="nav-item soustitre">
                    <a class="nav-link" data-bs-target="#Comptes" data-bs-toggle="tab" type="button" role="tab" aria-selected="false">Comptes</a>
                </li>
            </ul>
        </div>


        <div class="tab-content serveur-section">
            <div class="tab-pane fade show active tab-pane-content border-top-0 rounded-bottom tab-pane-content" id="Circuits">
                <div class="entete">
                    <h2 class="titre">Tous les circuits</h2>
                </div>

                <div id="CircuitsViewerBox" class="card-container">
                    <form action="./traitements/gestion.php" method="POST" class="card gestion">
                        <div class="img-wrapper">
                            <img id="AddNewIcon" src="./images/icons_plus.png" alt="New Circuit picture">
                        </div>
                        <div class="card-text">
                            <input type="hidden" name="token" value="<?php echo $_SESSION['csrf_token'] ?>">
                            <h3 class="soustitre">Pour créer un nouveau circuit:</h3>
                            <button class="btn btn-success vert-pomme" name="AddCircuit" type="submit">Cliquer ici</button>
                        </div>
                        <!-- href="./Circuit.php?edit=true&id_Circuit=0" -->
                    </form>

                    <?php
                    foreach ($AllCircuits as $Key => $Value) {
                        $CircuitPageRedirectionWithParameters = './FormulaireCircuit.php?circuit=' . $Value['id_circuit'];

                        echo '<form action="./traitements/gestion.php" method="post" class="card gestion">';
                        echo '<input type="hidden" name="id_circuit" value="' . $Value['id_circuit'] . '">';
                        echo '<input type="hidden" name="token" value="' . $_SESSION['csrf_token'] . '">';
                        echo '<button name="DeleteCircuit" data-bs-toggle="modal" data-bs-target="#DeleteModal" type="button" class="floating"><i class="fa-solid fa-circle-xmark" style="color: #ff0000;"></i></button>';
                        echo '<div class="img-wrapper"><img src="' . GetImagePath($Value['photo']) . '" alt="' . $Value['alt'] . '"></div>';
                        echo '<div class="card-text"><h3 class="soustitre">' . $Value['titre'] . '</h3>';
                        // echo '<button name="Intention" value="UpdateCircuit" type="button">Modifier</button>';
                        echo '<a href="' . $CircuitPageRedirectionWithParameters . '" class="btn btn-success" >Modifier</a></div>';
                        echo '</form>';
                    }
                    ?>
                </div>
            </div>

            <div class="tab-pane fade show tab-pane-content border-top-0 rounded-bottom tab-pane-content" id="Hebergements">
                <div class="entete">
                    <h2 class="titre">Tous les hébergements</h2>
                </div>

                <div id="AccomodationsViewerBox" class="card-container">
                    <form action="./traitements/gestion.php" method="post" class="card gestion">
                        <div class="img-wrapper">
                            <img id="AddNewIcon" src="./images/icons_plus.png" alt="New Circuit picture">
                        </div>
                        <div class="card-text">
                            <input type="hidden" name="token" value="<?php echo $_SESSION['csrf_token'] ?>">
                            <h3 class="soustitre">Pour créer un nouvel hebergement:</h3 class="soustitre">
                            <button class="btn btn-success vert-pomme" name="AddAccomodation" type="submit">Cliquer ici</button>
                        </div>
                        <!-- href="./Circuit.php?edit=true&id_Circuit=0" -->
                    </form>

                    <?php
                    foreach ($AllAccomodations as $Key => $Value) {
                        $AccomodationPageRedirectionWithParameters = './circuit.php?edit=true&id_hebergement=' . $Value['id_hebergement'];

                        echo '<form action="./traitements/gestion.php" method="post" class="card gestion">';
                        echo '<input type="hidden" name="id_hebergement" value="' . $Value['id_hebergement'] . '">';
                        echo '<input type="hidden" name="token" value="' . $_SESSION['csrf_token'] . '">';
                        echo '<button name="DeleteAccomodation" data-bs-toggle="modal" data-bs-target="#DeleteModal" type="button" class="floating"><i class="fa-solid fa-circle-xmark" style="color: #ff0000;"></i></button>';
                        echo '<div class="img-wrapper"><img src="' . GetImagePath($Value['photo1']) . '" alt="photo de ' . $Value['nom'] . '"></div>';
                        echo '<div class="card-text"><h3 class="soustitre">' . $Value['nom'] . '</h3>';
                        // echo '<button name="Intention" value="UpdateCircuit" type="button">Modifier</button>';
                        echo '<a href="' . $AccomodationPageRedirectionWithParameters . '" class="btn btn-success">Modifier</a></div>';
                        echo '</form>';
                    }
                    ?>
                </div>
            </div>

            <div class="tab-pane fade show" id="Comptes">
                <div class="entete">
                    <h2 class="titre">Tous les comptes</h2>
                </div>
                <div id="UserInsert">
                    <input type="hidden" name="id_utilisateur" value="' . $Value['id_utilisateur'] . '">
                    <div class="card-text">
                        <h3 class="soustitre">Pour créer un nouveau compte:</h3 class="soustitre">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#InsertModal">Cliquer ici</button>
                    </div>
                    <!-- Modal d'insertion -->
                    <form action="./traitements/gestion.php" method="POST">
                        <div class="modal fade" id="InsertModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h2 class="modal-title fs-5" id="exampleModalLabel">Créer un compte</h2>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- formulaire d'insertion -->
                                        <div class="card-group">
                                            <div class="card" style="width: 30rem;">
                                                <div class="card-body">
                                                    <div class="mb-3">
                                                        <label for="nom" class="form-label">Nom</label>
                                                        <input type="text" class="form-control" id="nom" name="nom" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="prenom" class="form-label">Prénom</label>
                                                        <input type="text" class="form-control" id="prenom" name="prenom" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="num" class="form-label">Numéro de téléphone</label>
                                                        <input type="number" class="form-control" id="num" name="num">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="email">Adresse e-mail </label>
                                                        <input type="email" class="form-control" name="email" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="role">Role </label>
                                                        <select name="roles" class="form-select">
                                                            <option selected>Choisir</option>
                                                            <option value="user">Utilisateur</option>
                                                            <option value="client">Client</option>
                                                            <option value="admin">Administration</option>
                                                        </select>
                                                    </div>

                                                    <input type="hidden" name="token" value="<?php echo $_SESSION['csrf_token'] ?>">

                                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                        <button name="AddUser" type="submit" class="btn btn-success">Envoyer</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div id="UsersViewerBox">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Nom</th>
                                <th scope="col">Prénom</th>
                                <th scope="col">Numéro de téléphone</th>
                                <th scope="col">Email</th>
                                <th scope="col">Rôle</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php
                            foreach ($AllUsers as $Key => $Value) {

                                echo '<tr><form action="./traitements/gestion.php" method="post" >';
                                echo '<input type="hidden" name="id_utilisateur" value="' . $Value['id_utilisateur'] . '">';
                                echo '<input type="hidden" name="token" value="' . $_SESSION['csrf_token'] . '">';
                                echo '<td><input type="text" name="surname" value="' . $Value['nom'] . '"></td>';
                                echo '<td><input type="text" name="name" value="' . $Value['prenom'] . '"></td>';
                                echo '<td><input type="text" name="phone" value="' . $Value['num'] . '"></td>';
                                echo '<td><input type="text" name="mail" value="' . $Value['email'] . '"></td>';
                                echo '<td><input type="text" name="role" value="' . $Value['role'] . '"></td>';
                                echo '<td><button name="UpdateUser" type="submit" class="btn btn-success">Modifier</button>';
                                echo '<button name="DeleteUser" data-bs-toggle="modal" data-bs-target="#DeleteModal" type="button" class="btn btn-success">Supprimer</button></td>';
                                echo '</form></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- modal de supression -->
        <div class="modal" id="DeleteModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="soustitre" class="modal-title">Supprimer</h3 class="soustitre">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Êtes vous sûr de vouloir procéder à la suppression ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="DeleteModalSubmitButton" class="btn btn-primary">Save changes</button>

                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include_once('./components/footer.php') ?>
    <script>
        let myModal = document.getElementById('DeleteModal');

        // Puisque la page recharge à chaque fois, y'a pas besoin de removeEventListener
        myModal.addEventListener('shown.bs.modal', function(event) {
            let SubmitButton = document.getElementById('DeleteModalSubmitButton');

            // C'est seulement quand le boutton est cliqué, que le type change (et la page changera)
            // donc pas besoin de nettoyage
            SubmitButton.onclick = function() {
                // change le type du button original, puis simule un click:
                event.relatedTarget.type = "submit";
                event.relatedTarget.click();
            };

            return event.preventDefault();
        });
    </script>
</body>

</html>