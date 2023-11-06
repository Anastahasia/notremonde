<?php
session_start();
require_once('./components/connexion.php');
require_once("./components/communs.php");
// Redirect unregistered users
// if (!isset($_SESSION['UserRole']) || $_SESSION['UserRole'] != 'admin')
//     {
//         header("Location: " . 'index.php');
//         die();
//     }
$CurrentCircuitID = isset($_GET['circuit']) ? $_GET['circuit'] : 0;
$SelectedCircuit = $NewConnection->select("circuit", "id_circuit", $CurrentCircuitID);

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
        <header class="presentation pb-0" id="vif">

            <?php
            function GenerateCategorieSelector($Categories, $Name, $SelectedId)
            {
                $SelectedId--; //zero-based vs one-based

                $Options = "";
                foreach ($Categories as $Key => $Value) {
                    $SelectState = ($Key == ($SelectedId)) ? 'selected="true' : '';

                    $Options .= '<option ' . $SelectState . ' value="' . $Value['id_categorie'] . '">' . $Value['nom'] . '</option>';
                }

                echo '
                    <label for="Categorie">Choisissez une categorie:</label>
                    <select name="' . $Name . '" id="Categorie" class="form-select d-inline w-25 titre2">'
                    . $Options .
                    '</select>
                                ';
            }

            foreach ($SelectedCircuit as $Circuit) {


                echo '
            <div class="img-presentation"> <form enctype="multipart/form-data" action="./controllers/gestion.php" method="post">';
                $ImageSource = $Circuit['photo'] != '' ?
                    GetImagePath($Circuit['photo'])
                    : '<i class="fa-solid fa-circle-plus" style="color: #1b512d;"></i>';
                echo '
                <div class="mb-3">
                    <label for="photo">Sélectionnez une image :</label>
                    <input type="file" class="form-control image-selector" name="photo" accept="image/png, image/jpeg">
                
                    <img  class="image-preview" src="' . $ImageSource . '" alt="' . $Circuit['alt'] . '">
                </div>
            </div>
            <div class="txt-presentation">
                <h1 class="titre1" name="title" contenteditable="true">' . $Circuit['titre'] . '</h1>
                <p name="description" contenteditable="true">' . $Circuit['description'] . '</p>';
                GenerateCategorieSelector($AllCategories, 'categorie', $Circuit['categorie']);
                echo '
                <div class="mb-3">
                    <label class="soutitre" for="duree">Durée (en jours):</label>
                    <input type="text" class="form-control d-inline w-25 titre2" name="duree" value="' . $Circuit['duree'] . '"> 
                </div>
                <div class="mb-3">
                    <label class="soutitre" for="prix_estimatif">Prix (en euros):</label>
                    <input type="text" class="form-control d-inline w-25 titre2" name="prix_estimatif" value="' . $Circuit['prix_estimatif'] . '">
                </div>

                <input type="hidden" name="token"  value="' . $_SESSION['csrf_token'] . '">
                <input type="hidden" name="circuit_id" value="' . $CurrentCircuitID . '">
            </div></form>';
            }
            ?>
        </header>
        <section>
            <h2 class="titre1 pt-5">Circuit</h2>
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
            <div class="etape-display">
                <div class="txt-etape">
                    <p class="accent">jour <input type="num" class="form-control d-inline w-25 titre2" name="jourArrivee" value="' . $Step['jourArrivee'] . '"> à jour <input type="num" class="form-control d-inline w-25 titre2" name="jourDepart" value="' . $Step['jourDepart'] . '"></p>
                    <p contenteditable="true">' . $Step['descriptionEtape'] . '</p>
                    <p class="accent" contenteditable="true">' . $Step['nom'] . '</p>
                    <p contenteditable="true">' . $Step['type'] . '</p>
                    <p contenteditable="true">' . $Step['descriptionHebergement'] . '</p>
                </div>';

                echo '
                <div class="img-presentation">
                    <div id="carouselExample" class="carousel slide">
                        <div class="carousel-inner">
                        
                            <div class="carousel-item active">
                                <img src="' . GetImagePath($Step['photoVille']) . '" class="" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="' . GetImagePath($Step['photo1']) . '" class="" alt="photo de ' . $Step['nom'] . '">
                            </div>
                            <div class="carousel-item">
                                <img src="' . GetImagePath($Step['photo2']) . '" class="" alt="' . $Step['nom'] . '">
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
            </div>
        ';
            } ?>
        </section>
    </main>
    <?php include_once('./components/footer.php') ?>
    <script>
        /* Variables */

        // We're using the same button for all ajax submit
        let UpdateButton = document.createElement('button');
        UpdateButton.innerHTML = "Modifier";
        UpdateButton.className = 'update-edit btn btn-success';
        UpdateButton.type = 'button';

        /* Transmitting informations in between PHP and JS */

        function GetCurrentCircuitID() {
            return Number(<?php echo $CurrentCircuitID; ?>);
        }

        function GetCurrentCategorieID() {
            return <?php echo '"' . $CurrentCategorieID . '"'; ?>;
        }


        /* Image previewing: aesthetic */
        [...document.getElementsByClassName('image-selector')].forEach(Each => {
            Each.addEventListener('change', (Event) => {
                let Section = Event.target.parentNode;
                console.log(Section)
                let src = URL.createObjectURL(Event.target.files[0]);
                let ImagePreviewPlaceholder = Section.getElementsByClassName('image-preview');
                if (ImagePreviewPlaceholder) {
                    ImagePreviewPlaceholder[0].src = src;
                }
            });
        });

        /** Updating the Circuit fields:
         * The point is to hook all those elements to be able to send genericly their data to databases
         * */
        [...document.querySelectorAll('*[contenteditable="true"]')]
        .concat([...document.querySelectorAll('.image-selector')])
            .concat([...document.querySelectorAll('input')])
            .concat([...document.querySelectorAll('#Categorie')])
            .forEach(Each => {

                if (!Each) return;

                async function SendUpdateCircuitField(Event) {

                    let url = "./controllers/gestion.php";

                    let form_data = new FormData();
                    form_data.append('Intention', 'UpdateCircuit');
                    form_data.append('id_circuit', GetCurrentCircuitID());
                    form_data.append('id_categorie', GetCurrentCategorieID());
                    form_data.append('Column', Each.getAttribute('name'));

                    // We either send a file (images), the content of the form value (#Categorie), or the actual editable text content
                    const File = Each.files ? Each.files[0] : null;
                    form_data.append(Each.getAttribute('name'), File || Each.value || Each.innerHTML);

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
                        .then(function(Response) {

                            UpdateButton.remove();
                            UpdateButton.removeEventListener('click', SendUpdateCircuitField, true);

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

                    UpdateButton.addEventListener('click', SendUpdateCircuitField);

                    UpdateButton.style.display = 'block';
                });

                // Hiding the button on blur, but see notes below
                Each.addEventListener('blur', (Event) => {

                });
            });
    </script>
</body>

</html>