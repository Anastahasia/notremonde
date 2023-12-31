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
<header class="bg-dark filtre">
    <div class="container px-5">
        <div class="row gx-5 justify-content-center">
            <div class="">
                <div class="text-center my-5">
                    <h1 class="display-5 fw-bolder text-white mb-2 header">LE VOYAGE QUI VOUS RESSEMBLE</h1>
                    <form method="get" action="../destination.php">
                        <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
                            <div class="label-container supp">
                                <select name="destination" class="form-select btn-light px-4 disabled" aria-label="Default select example">
                                    <option selected>Où ?</option>
                                        <?php 
                                        foreach ($destinations as $Value){
                                            echo '<option value="'.$Value['id_continent'].'">'.$Value['nom'].'</option>';
                                        }
                                        ?>
                                </select>
                                <label class="accent" for="destination">Destination</label>
                            </div>

                            <div class="label-container d-grid w-2">
                                <select name="categorie" class="form-select btn-light px-4 disabled" aria-label="Default select example">
                                    <option selected>Catégorie</option>
                                    <?php 
                                        foreach ($categorie as $Value){
                                            echo '<option value="'.$Value['id_categorie'].'">'.$Value['nom'].'</option>';
                                        }
                                        ?>
                                </select>
                                <label class="accent" for="categorie">Type de voyage</label>
                            </div>

                            <div class="label-container supp">
                                <select class="form-select btn-light px-4 disabled" name="prix" aria-label="Default select example">
                                    <option selected>Prix</option>
                                    <option min="0" max="100" value="">0 - 100 €</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                                <label class="accent" for="prix">Prix</label>
                            </div>

                            <div class="label-container supp">
                                    <input class="form-check-input disabled" type="checkbox" value="" name="enfant" id="flexCheckDefault">
                                    <label class="accent" class="form-check-label" for="enfant">
                                        Avec enfants (-12ans)
                                    </label>
                            </div>

                            <div class="label-container">
                                <button type="submit" class="btn btn-light disabled">Rechercher</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>

