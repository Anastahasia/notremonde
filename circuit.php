<?php
    require_once("./components/connexion.php");

    $CurrentCircuitID = isset($_GET['circuit']) ? $_GET['circuit'] : 0;
    $SelectedCircuit = $NewConnection->select("circuit", "*", "id_circuit = $CurrentCircuitID");

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>
        <?php
            $CircuitsName = "";
            foreach ($SelectedCircuit as $Key => $Value) {
                $CircuitsName = $Value['titre'];
            }
            echo $CircuitsName;
        ?> | Notre Monde</title>
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="icon" href="./images/favicon.png" type="image/x-icon" >
    
    <link href="styles.css" rel="stylesheet" />
</head>

<body>
    <?php
    include_once('nav.php');
    ?>

    <main>
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item accent"><a href="#">Home</a></li>
                <li class="breadcrumb-item accent active" aria-current="page">Library</li>
            </ol>
        </nav>

        <header class="presentation"> 
            <div class="img-presentation">
                <img src="" alt="">
            </div>
            <div class="txt-presentation">
                <h1 class="titre1">Émilie-Romagne : Une Aventure Italienne</h1>
                <p>Explorez les ruelles pavées de Bologne, découvrez les secrets de fabrication du vinaigre balsamique à Modène, et goûtez les délices du Parmesan dans les fromageries locales. Vous serez enchanté par la beauté des villes médiévales, les trésors artistiques et les traditions gastronomiques uniques de cette région. Une expérience gustative et culturelle qui éveillera tous vos sens.</p>
                <p class="soutitre">Catégorie :</p>
                <div class="flex-text">
                    <p class="soutitre">Destination :</p>
                    <p class="soutitre">Durée :</p>
                </div>
                <p class="titre2">À partir de 
                    
                </p>
                <button type="button" class="btn btn-success">Demandez un devis</button>
            </div>
        </header>
    </main>

    <?php include_once('footer.php') ?>

</body>