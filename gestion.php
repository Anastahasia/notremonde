<?php
session_start();
// var_dump($_SESSION);

// Redirect unregistered users
// if (!isset($_SESSION['UserRole']) || $_SESSION['UserRole'] != 'admin')
//     {
//         header("Location: " . 'index.php');
//         die();
//     }

require_once("./components/connexion.php");
// require_once('./components/commons.php');

$AllCircuits = $NewConnection->select("circuit", "*");
$AllItineraires = $NewConnection->select("itineraire", "*");
$AllUsers = $NewConnection->select("utilisateur", "*");
// var_dump($AllUsers);
?>
<!DOCTYPE html>
<html lang="en">

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

    <link rel="icon" href="./images/favicon.png" type="image/x-icon" >

    <link href="styles.css" rel="stylesheet" />
</head>

<body>
    <?php include_once('./components/nav.php'); ?>
    <main>
        <section id="Circuits">
            <div class="entete">
                <h1 class="titre">Tous les circuits</h1>
            </div>

            <div id="CircuitsViewerBox" class="card-container">
                <form action="./controllers/gestion.php" method="post" class="card gestion">
                    <div class="card-image-container">
                        <img id="AddNewIcon" src="./images/icons_plus.png" alt="New Circuit picture">
                    </div>
                    <div class="card-text">
                        <h5>Pour créer un nouveau circuit:</h5>
                        <button name="Intention" value="AddCircuit" type="submit">Cliquer ici</button>
                    </div>
                    <!-- href="./Circuit.php?edit=true&id_Circuit=0" -->
                </form>

                <?php
                foreach ($AllCircuits as $Key => $Value) {
                    $CircuitPageRedirectionWithParameters = './circuit.php?edit=true&id_Circuit=' . $Value['id_circuit'];

                    echo '<form action="./controllers/gestion.php" method="post" class="card gestion">';
                    echo '<input type="hidden" name="id_circuit" value="' . $Value['id_circuit'] . '">';
                    echo '<button name="Intention" value="DeleteCircuit" data-bs-toggle="modal" data-bs-target="#DeleteModal" type="button" class="floating"></button>';
                    echo '<div class="card-image-container"><img src="' . $Value['photo'] . '" alt="'.$Value['alt'].'"></div>';
                    echo '<div class="card-text"><h3>' . $Value['titre'] . '</h3>';
                    // echo '<button name="Intention" value="UpdateCircuit" type="button">Modifier</button>';
                    echo '<a href="' . $CircuitPageRedirectionWithParameters . '" class="btn" >Modifier</a></div>';
                    echo '</form>';
                }
                ?>
            </div>
        </section>

        <section id="Intineraires">
            <div class="entete">
                <h1 class="titre">Tous les itinéraires</h1>
            </div>

            <div id="ItinerairesViewerBox" class="card-container">
                <form action="./controllers/gestion.php" method="post" class="card gestion">
                    <div class="card-image-container">
                        <img id="AddNewIcon" src="./images/icons_plus.png" alt="New Circuit picture">
                    </div>
                    <div class="card-text">
                        <h5>Pour créer un nouvel itinéraire:</h5>
                        <button name="Intention" value="AddItineraire" type="submit">Cliquer ici</button>
                    </div>
                    <!-- href="./Circuit.php?edit=true&id_Circuit=0" -->
                </form>

                <?php
                foreach ($AllItineraires as $Key => $Value) {
                    $ItinerairePageRedirectionWithParameters = './circuit.php?edit=true&id_itineraire=' . $Value['id_itineraire'];

                    echo '<form action="./controllers/gestion.php" method="post" class="card gestion">';
                    echo '<input type="hidden" name="id_itineraire" value="' . $Value['id_itineraire'] . '">';
                    echo '<button name="Intention" value="DeleteItineraire" data-bs-toggle="modal" data-bs-target="#DeleteModal" type="button" class="floating"></button>';
                    echo '<div class="card-image-container"><img src="' . $Value['photo'] . '" alt="'.$Value['alt'].'"></div>';
                    echo '<div class="card-text"><h3>' . $Value['titre'] . '</h3>';
                    // echo '<button name="Intention" value="UpdateCircuit" type="button">Modifier</button>';
                    echo '<a href="' . $ItinerairePageRedirectionWithParameters . '" class="btn">Modifier</a></div>';
                    echo '</form>';
                }
                ?>
            </div>
        </section>

        <section id="Users">
            <div class="entete">
                <h1 class="titre">Tous les comptes</h1>
            </div>
            <div id="UserInsert">
                <input type="hidden" name="id_utilisateur" value="' . $Value['id_utilisateur'] . '">
                <div class="card-text">
                    <h5>Pour créer un nouveau compte:</h5>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#InsertModal">Cliquer ici</button>
                </div>
                <!-- Modal d'insertion -->
                <form action="./controllers/gestion.php" method="POST">
                    <div class="modal fade" id="InsertModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Créer un compte</h1>
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

                                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                                    <button name="Intention" value="AddUser" type="submit" class="btn btn-success">Envoyer</button>
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

                            echo '<tr><form action="./controllers/gestion.php" method="post" >';
                            echo '<input type="hidden" name="id_utilisateur" value="' . $Value['id_utilisateur'] . '">';
                            echo '<td><input type="text" name="surname" value="'.$Value['nom'].'"></td>';
                            echo '<td><input type="text" name="name" value="' . $Value['prenom'] . '"></td>';
                            echo '<td><input type="text" name="phone" value="' . $Value['num'] . '"></td>';
                            echo '<td><input type="text" name="mail" value="' . $Value['email'] . '"></td>';
                            echo '<td><input type="text" name="role" value="' . $Value['role'] . '"></td>';
                            echo '<td><button name="Intention" value="UpdateUser" type="submit" class="btn btn-success">Modifier</button>';
                            echo '<button name="Intention" value="DeleteUser" data-bs-toggle="modal" data-bs-target="#DeleteModal" type="button" class="btn btn-success">Supprimer</button></td>';
                            echo '</form></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
        <!-- modal de supression -->
        <div class="modal" id="DeleteModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Supprimer</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Êtes vous sûr de vouloir supprimer ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="DeleteModalSubmitButton" class="btn btn-primary">Save changes</button>
                        <?php var_dump($Value) ?>
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