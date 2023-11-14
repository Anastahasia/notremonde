<?php
require_once('./components/connexion.php');
require_once("./components/fonctions.php");
// Redirect unregistered users
// if (!isset($_SESSION['UserRole']) )
//     {
//         header("Location: " . 'login.php');
//         die();
//     }
// if (isset($_SESSION['UserRole'] || $_SESSION['UserRole']!='admin') )
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
$AllAccomodation = $NewConnection->select('hebergement')
// echo ($_SESSION['csrf_token']);
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
        foreach ($SelectedCircuit as $Key => $Circuit) {
            $CircuitsName = $Circuit['titre'];
        }
        echo $CircuitsName;
        ?> | Notre Monde</title>
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
        <header class="pb-0" id="vif">

            <?php
            function GenerateSelector($Categories, $Name, $TableID, $nom, $SelectedId)
            {
                $SelectedId--; //zero-based vs one-based

                $Options = "";
                foreach ($Categories as $Key => $Value) {
                    $SelectState = ($Key == ($SelectedId)) ? 'selected="true' : '';

                    $Options .= '<option ' . $SelectState . ' value="' . $Value[$TableID] . '">' . $Value['nom'] . '</option>';
                }

                echo '
                <div class="mb-3">
                    <label class="soustitre" for="Categorie">Choisissez ' . $nom . ' :</label>
                    <select name="' . $Name . '" class="form-select d-inline w-50 paragraphe">'
                    . $Options .
                    '</select>
                </div>  ';
            }

            foreach ($SelectedCircuit as $Circuit) {


                echo '
            <form enctype="multipart/form-data" action="./traitements/gestion.php" method="post" class="presentation pb-0">
                <div class="img-presentation">';
                echo '
                    <div class="mb-3">
                        <label for="photo">Sélectionnez une image :</label>
                        <input type="file" class="form-control image-selector" name="photo" accept="image/png, image/jpeg">
                    
                        <img  class="image-preview" src="' . GetImagePath($Circuit['photo']) . '" alt="' . $Circuit['alt'] . '">
                    </div>
                    <div class="mb-3">
                        <label class="soustitre" for="alt">Description de la photo:</label>
                        <input type="text" class="form-control d-inline paragraphe" name="alt" value="' . $Circuit['alt'] . '"> 
                    </div>
                </div>
                <div class="txt-presentation">
                    <h1 class="titre" name="titre" contenteditable="true">' . $Circuit['titre'] . '</h1>
                    <p name="description" contenteditable="true">' . $Circuit['description'] . '</p>';
                GenerateSelector($AllCategories, 'categorie', 'id_categorie', 'une catégorie', $Circuit['categorie']);
                echo '
                    <div class="mb-3">
                        <label class="soustitre" for="duree">Durée (en jours):</label>
                        <input type="text" class="form-control d-inline w-25 paragraphe" name="duree" value="' . $Circuit['duree'] . '"> 
                    </div>
                    <div class="mb-3">
                        <label class="soustitre" for="prix_estimatif">Prix (en euros):</label>
                        <input type="text" class="form-control d-inline w-25 paragraphe" name="prix_estimatif" value="' . $Circuit['prix_estimatif'] . '">
                    </div>

                    <input type="hidden" name="token" value="' . $_SESSION['csrf_token'] . '">
                </div>
            </form>';
            }
            ?>
        </header>
        <section class="etape">
            <h2 class="titre1 pt-2">Circuit</h2>
            <?php foreach ($SelectedSteps as $Step) {
                echo '
        <form action="./traitements/gestion.php" method="post">
            <div class="flex-etape">
                <hr>
                <div class="mb-3">
                    <label class="titre2 etape" for="ordre">étape </label>
                    <input type="num" class="form-control d-inline w-25 titre2" name="ordre" value="' . $Step['ordre'] . '">
                </div>
                <hr>
            </div>
            
            <div class="txt-etape">
                <p class="accent">jour <input type="num" class="form-control d-inline w-25 titre2" name="jourArrivee" value="' . $Step['jourArrivee'] . '"> à jour <input type="num" class="form-control d-inline w-25 titre2" name="jourDepart" value="' . $Step['jourDepart'] . '"></p>
                <p contenteditable="true" name="descriptionEtape">' . $Step['descriptionEtape'] . '</p>';
                GenerateSelector($AllAccomodation, 'hebergement', 'id_hebergement', 'un hébergement', $Step['hebergement']);
                echo ' <input type="hidden" name="token" value="' . $_SESSION['csrf_token'] . '">
                <input type="hidden" name="id_ec" value="' . $Step['id_ec'] . '">
            </div>
        </form>';
            } ?>
            <form id="newStep"></form>
        </section>
        <button id="rowAdder" type="button" class="btn btn-success">
            <span class="bi bi-plus-square-dotted">
            </span> Ajouter
        </button>
    </main>
    <?php include_once('./components/footer.php') ?>
    <script>
        /* Variables */

        // We're using the same button for all ajax submit
        let UpdateCircuitButton = document.createElement('button');
        UpdateCircuitButton.innerHTML = "Modifier";
        UpdateCircuitButton.className = 'update-edit btn btn-success';
        UpdateCircuitButton.type = 'button';

        /* Transmitting informations in between PHP and JS */

        function GetCurrentCircuitID() {
            return Number(<?php echo $CurrentCircuitID; ?>);
        }

        function GetCurrentStepID() {
            return Number(<?php echo $Step['id_ec']; ?>);
        }

        function GetCurrentCategorieID() {
            return <?php echo '"' . $CurrentCategorieID . '"'; ?>;
        }

        function GetCurrentSessionToken() {
            return <?php echo '"' . $_SESSION['csrf_token'] . '"'; ?>;
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
        [...document.querySelectorAll('.presentation *[contenteditable="true"]')]
        .concat([...document.querySelectorAll('.image-selector')])
            .concat([...document.querySelectorAll('.presentation input')])
            .concat([...document.querySelectorAll('.presentation select')])
            .forEach(Each => {

                if (!Each) return;

                async function SendUpdateCircuitField(Event) {

                    let url = "./traitements/gestion.php";

                    let form_data = new FormData();
                    form_data.append('UpdateCircuit', 1);
                    form_data.append('token', GetCurrentSessionToken());
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

                            UpdateCircuitButton.remove();
                            UpdateCircuitButton.removeEventListener('click', SendUpdateCircuitField, true);

                            return Response.text();
                        })
                    // .then(function(ResponseText) {
                    //     console.log(ResponseText);
                    // });

                    return true;
                }

                //Hooking up the button to appear below the edited field
                Each.addEventListener('focus', (Event) => {
                    Event.target.insertAdjacentElement('afterend', UpdateCircuitButton);

                    UpdateCircuitButton.addEventListener('click', SendUpdateCircuitField);

                    UpdateCircuitButton.style.display = 'block';
                });

                // Hiding the button on blur, but see notes below
                Each.addEventListener('blur', (Event) => {

                });
            });
    </script>
    <script type="text/javascript">
        $("#rowAdder").click(function() {
            newRowAdd =        
            ' <div class="mb-3">'+
            ' <label class="titre2 etape" for="ordre">étape </label>'+
            '<input type="num" class="form-control d-inline w-25 titre2" name="ordre" value="0">'+
            '</div>'+


            '<div class="txt-etape">'+
            '<p class="accent">jour <input type="num" class="form-control d-inline w-25 titre2" name="jourArrivee" value="1"> à jour <input type="num" class="form-control d-inline w-25 titre2" name="jourDepart" value="1"></p>'+
            '<p contenteditable="true" name="descriptionEtape">Ajoutez une description</p>'+
            '</div>'
            '<button class="btn btn-success" type="submit" name="NewStep">Créer</button>'
            ;

            $('#newStep').append(newRowAdd);
        });
    </script>
</body>

</html>