<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Viaje: Gestion</title>
    <link rel="icon" href="./images/favicon.ico" type="image/x-icon" >

    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <?php include("./components/navbar.php"); ?>
    </header>

    <!-- <main class="chunks"> -->
    <main >
        <section class="entete">
            <h1 class="titre">Tout les articles</h1>
        </section>

        <section id="ArticlesViewerBox" class="card-container">
            <form action="controller.php" method="post" class="card gestion">
                <input type="hidden" name="id_article" value="' . $Value['id_article'] . '">
                <div class="card-image-container">
                    <img id="AddNewIcon" src="./images/icons_plus.png" alt="New article picture">
                </div>
                <div class="card-text">
                    <h5>Pour créer un nouvel article:</h5>
                    <button name="Intention" value="AddArticle" type="submit">Clicker ici</button>
                </div>
                <!-- href="./article.php?edit=true&id_article=0" -->
            </form>

            <?php
                foreach ($AllArticles as $Key => $Value)
                {
                    $ArticlePageRedirectionWithParameters = './article.php?edit=true&id_article=' . $Value['id_article'];

                    echo '<form action="controller.php" method="post" class="card gestion">';
                    echo '<input type="hidden" name="id_article" value="' . $Value['id_article'] . '">';
                    echo '<button name="Intention" value="DeleteArticle" type="submit" class="floating"></button>';
                    echo '<div class="card-image-container"><img src="' . GetImagePath( $Value['photo_principale'], $Value['sous_categorie'] )  . '" alt="Article picture"></div>';
                    echo '<div class="card-text"><h5>' . $Value['titre'] . '</h5>';
                    // echo '<button name="Intention" value="UpdateArticle" type="button">Modifier</button>';
                    echo '<a href="' . $ArticlePageRedirectionWithParameters . '" >Modifier</a></div>';
                    echo '</form>';
                }
            ?>
        </section>
    </main>

    <footer>
        <?php include("./components/footer.php"); ?>
    </footer>
</body>
</html>
