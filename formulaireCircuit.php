<?php
session_start();
require_once('./components/connexion.php');
require_once("./components/communs.php");

$CurrentCircuitID = isset($_GET['circuit']) ? $_GET['circuit'] : 0;
$SelectedCircuit = $NewConnection->select_visible("circuit", "id_circuit", $CurrentCircuitID);

$CurrentCategorieID = $SelectedCircuit[0]['categorie'];
$SelectedCategorie = $NewConnection->select("categorie", "id_categorie", $CurrentCategorieID);

$AllCategories = $NewConnection->select("categorie");
// var_dump($SelectedCircuit, $AllCategories);
if (empty($SelectedCircuit)) {
    header("Location: " . "./destination.php");
}
$SelectedSteps = $NewConnection->select_etape("etape_circuit", "hebergement", "id_hebergement", "ville", "id_ville", $CurrentCircuitID);


?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title> Accueil | Notre Monde</title>
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="icon" href="./images/favicon.png" type="image/x-icon">

    <link href="styles.css" rel="stylesheet" />
</head>

<body>
    <?php
    include_once('./components/nav.php');
    ?>
    <main>
        <header class="presentation">

            <?php

            foreach ($SelectedCircuit as $Circuit) {


                echo '
            <div class="img-presentation"> <form enctype="multipart/form-data" action="./controllers/gestion.php" method="post">';
                $ImageSource = $Circuit['photo'] != '' ?
                    GetImagePath($Circuit['photo'])
                    : '<i class="fa-solid fa-circle-plus" style="color: #1b512d;"></i>';
                echo '<div class="mb-3">
                    <label for="circuitImage">Sélectionnez une image :</label>
                    <input type="file" class="form-control image-selector" name="circuitImage" accept="image/png, image/jpeg">
                
                <img  class="image-preview" src="' . $ImageSource . '" alt="' . $Circuit['alt'] . '">
                </div>
            </div>
            <div class="txt-presentation">
                <h1 class="titre1" name="title" contenteditable="true">' . $Circuit['titre'] . '</h1>
                <p name="description" contenteditable="true">' . $Circuit['description'] . '</p>
                <div class="mb-3">
                    <label class="soutitre" for="duree">Durée:</label>
                    <input type="text" class="form-control d-inline w-50 titre2" name="duree" value="' . $Circuit['duree'] . '">  jours</input>
                </div>
                <div class="mb-3">
                    <label class="soutitre" for="duree">Durée:</label>
                    <input type="text" class="form-control d-inline w-50 titre2" name="duree" value="' . $Circuit['prix_estimatif'] . '"> €
                </div>

                <input type="hidden" name="token"  value="' . $_SESSION['csrf_token'] . '">
                <input type="hidden" name="circuit_id" value="' . $CurrentCircuitID . '">
            </div></form>';
            }
            ?>
        </header>
        <h2 class="titre1">Circuit</h2>
        <?php foreach ($SelectedSteps as $Step) {
            echo '
        <div class="flex-etape">
            <hr>
            <div class="mb-3">
                <label class="titre2 etape" for="ordre">étape <label>
                <input type="num" class="form-control d-inline w-25 titre2" name="ordre" value="' . $Step['ordre'] . '">
            </div>
            <hr>
        </div>
        <section class="etape-display presentation">
            <div class="txt-etape">
                <p class="accent">jour <input type="num" class="form-control d-inline w-25 titre2" name="jourArrivee" value="' . $Step['jourArrivee'] . '"> à jour <input type="num" class="form-control d-inline w-25 titre2" name="jourDepart" value="' . $Step['jourDepart'] . '"></p>
                <p contenteditable="true">' . $Step['descriptionEtape'] . '</p>
                <p class="accent">' . $Step['nom'] . '</p>
                <p>' . $Step['type'] . '</p>
                <p>' . $Step['descriptionHebergement'] . '</p>
            </div>
            <div class="img-presentation">
                <div id="carouselExample" class="carousel slide">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="' . $Step['photoVille'] . '" class="" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="' . $Step['photo1'] . '" class="" alt="photo de ' . $Step['nom'] . '">
                        </div>
                        <div class="carousel-item">
                            <img src="' . $Step['photo2'] . '" class="" alt="' . $Step['nom'] . '">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </section>';
        } ?>
    </main>
    <?php include_once('./components/footer.php') ?>
    <script>
        /* Variables */

        // We're using the same button for all ajax submit
        let UpdateButton = document.createElement('button');
            UpdateButton.innerHTML = "Update";
            UpdateButton.className = 'update-edit';
            UpdateButton.type = 'button';
        ;

        /* Transmitting informations in between PHP and JS */

        function GetCurrentCircuitID()
        {
            return Number( <?php echo $CurrentCircuitID; ?> );
        }

        function  GetCurrentCategorieID()
        {
            return <?php echo '"' . $CurrentCategorieID . '"'; ?> ;
        }


        /* Image previewing: aesthetic */
        [...document.getElementsByClassName('image-selector')].forEach(Each => {
            Each.addEventListener('change', (Event) => {
                let Section = Event.target.parentNode;

                let src = URL.createObjectURL(Event.target.files[0]);
                let ImagePreviewPlaceholder = Section.getElementsByClassName('image-preview');
                if (ImagePreviewPlaceholder)
                {
                    ImagePreviewPlaceholder[0].src = src;
                }
            });
        });

        /** Updating the article fields:
         * The point is to hook all those elements to be able to send genericly their data to databases
         * */
        [...document.querySelectorAll('*[contenteditable="true"]')]
        .concat([...document.querySelectorAll('.image-selector')])
        .concat([...document.querySelectorAll("input")])
        .forEach(Each => {

            if (!Each) return;

            async function SendUpdateArticleField (Event) {

                let url = "./controllers/gestion.php";

                let form_data = new FormData();
                form_data.append('Intention', 'UpdateCircuit');
                form_data.append('id_circuit', GetCurrentCircuitID());
                form_data.append('id_categorie', GetCurrentCategorieID());
                form_data.append('Column', Each.getAttribute('name'));

                // We either send a file (images), the content of the form value (#Categorie), or the actual editable text content
                const File = Each.files ? Each.files[0] : null;
                form_data.append(Each.getAttribute('name'), File || Each.value || Each.innerHTML );

                const Request = await fetch(url, {
                    method: "POST",
                    mode: "cors",
                    cache: "no-cache",
                    credentials: "same-origin",
                    // It doesnt work with Content-Type, the WebBrowser will assess the content-type
                    // headers: { 'Content-Type': 'multipart/form-data' },
                    redirect: "follow",
                    referrerPolicy: "no-referrer",
                    body: form_data
                })
                .then(function (Response) { 
                    
                    UpdateButton.remove();
                    UpdateButton.removeEventListener('click', SendUpdateArticleField, true);

                    return Response.text();
                })
                // .then(function (ResponseText) {
                //     console.log(ResponseText);
                // })
                ;

                return true;
            }

            //Hooking up the button to appear below the edited field
            Each.addEventListener('focus', (Event) => {

                Event.target.insertAdjacentElement('afterend', UpdateButton);

                UpdateButton.addEventListener('click', SendUpdateArticleField);

                UpdateButton.style.display = 'block';
            });

            // Hiding the button on blur, but see notes below
            Each.addEventListener('blur', (Event) => {
                //NOTE: originally thought about removing the button when clicking elsewhere
                //BUT because the button click causes a blur event on the editable element,
                //we cannot remove the button here: otherwise we cripple the async fetch
                //We could simply hide it, but the button would still be there existing,
                // and could be clicked by a (malicious?) script
                // setTimeout(()=>{
                //     UpdateButton.style.display = 'none';
                // }, 3600);
            });
        });
    </script>
</body>

</html>