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
// var_dump($AllCircuits);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Gestion | Notre Monde </title>
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="icon" href="./images/favicon.png" type="image/x-icon">

    <link href="styles.css" rel="stylesheet" />

</head>

<body>
    <?php include_once('./components/nav.php'); ?>
    <main>
        <section class="entete">
            <h1 class="titre">Tous les circuits</h1>
        </section>

        <section id="CircuitsViewerBox" class="card-container">
            <form action="./interaction/gestion.php" method="post" class="card gestion">
                <input type="hidden" name="id_circuit" value="' . $Value['id_circuit'] . '">
                <div class="card-image-container">
                    <img id="AddNewIcon" src="./images/icons_plus.png" alt="New Circuit picture">
                </div>
                <div class="card-text">
                    <h5>Pour créer un nouveeu circuit:</h5>
                    <button name="Intention" value="AddCircuit" type="submit">Cliquer ici</button>
                </div>
                <!-- href="./Circuit.php?edit=true&id_Circuit=0" -->
            </form>

            <?php
            foreach ($AllCircuits as $Key => $Value) {
                $CircuitPageRedirectionWithParameters = './circuit.php?edit=true&id_Circuit=' . $Value['id_circuit'];

                echo '<form action="./interaction/gestion.php" method="post" class="card gestion">';
                echo '<input type="hidden" name="id_circuit" value="' . $Value['id_circuit'] . '">';
                echo '<button name="Intention" value="DeleteCircuit" data-bs-toggle="modal" data-bs-target="#DeleteModal" type="button" class="floating"></button>';
                echo '<div class="card-image-container"><img src="' . $Value['photo'] . '" alt="Circuit picture"></div>';
                echo '<div class="card-text"><h3>' . $Value['titre'] . '</h3>';
                // echo '<button name="Intention" value="UpdateCircuit" type="button">Modifier</button>';
                echo '<a href="' . $CircuitPageRedirectionWithParameters . '" >Modifier</a></div>';
                echo '</form>';
            }
            ?>
            <div class="modal" id="DeleteModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Modal body text goes here.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" id="DeleteModalSubmitButton" class="btn btn-primary">Save changes</button>
                            <?php var_dump($Value)?>
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

            // C'est seulement quand le boutton est clické, que le type change (et la page changera)
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