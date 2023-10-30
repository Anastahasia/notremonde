<?php 

require_once('connexion.php');
// if (isset($_GET['inputVente'])) {
//     $ville = $_GET['inputVente'];
//     $contrat = $_GET['contrat'];
//     $villeRecherchee = $connexion->select("bien", "*", "ville = '$ville' AND contrat = '$contrat'");
// }

$destinations = $NewConnection->select("continent");
$categories = $NewConnection->select("categorie");

?>
<!-- header -->
<header class="bg-dark py-5">
    <div class="container px-5">
        <div class="row gx-5 justify-content-center">
            <div class="">
                <div class="text-center my-5">
                    <h1 class="display-5 fw-bolder text-white mb-2 header">LE VOYAGE QUI VOUS RESSEMBLE</h1>
                    <form method="get" action="../destination.php">
                        <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
                            <div class="label-container">
                                <select name="destination" class="form-select btn-light px-4" aria-label="Default select example">
                                    <option selected>Où ?</option>
                                        <?php 
                                        foreach ($destinations as $Value){
                                            echo '<option value="'.$Value['id_continent'].'">'.$Value['nom'].'</option>';
                                        }
                                        ?>
                                </select>
                                <label for="destination">Destination</label>
                            </div>

                            <div class="label-container w-2">
                                <select name="categorie" class="form-select btn-light px-4" aria-label="Default select example">
                                    <option selected>Catégorie</option>
                                    <?php 
                                        foreach ($categorie as $Value){
                                            echo '<option value="'.$Value['id_categorie'].'">'.$Value['nom'].'</option>';
                                        }
                                        ?>
                                </select>
                                <label for="categorie">Type de voyage</label>
                            </div>

                            <div class="label-container">
                                <select class="form-select btn-light px-4" aria-label="Default select example">
                                    <option selected>Prix</option>
                                    <option min="0" max="100" value="">0 - 100 €</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                                <label for="participant"></label>
                            </div>

                            <div class="label-container">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Avec enfants (-12ans)
                                    </label>
                            </div>

                            <div class="label-container">
                                <button type="submit" class="btn btn-light">Rechercher</button>
                            </div>
                        </div>
                    </form>
                </div>
                <p class="lead text-white-50 mb-4">Quickly design and customize responsive mobile-first sites with Bootstrap, the world’s most popular front-end open source toolkit!</p>
            </div>
        </div>
    </div>
</header>

