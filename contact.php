<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Contact | Notre Monde</title>
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Animated text -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" >

    <link rel="icon" href="./images/favicon.png" type="image/x-icon">

    <link href="./styles.css" rel="stylesheet" />
</head>

<body>
    <?php include_once('./components/nav.php'); ?>

    <?php if (isset($_POST['email']) && $MessageSent) : ?>
        <h4>Merci pour votre message. Nous revenons vers vous dans les plus brefs délais</h4>
    <?php else : ?>

    <div class="form-container">
        <form class="contactForms" method="post" action="./controllers/user.php">
        <?php if (isset($_SESSION['CurrentUser'])) : 
            $nom = $_SESSION['CurrentUserSurname']; 
            $prenom = $_SESSION['CurrentUserName']; 
            $email = $_SESSION['CurrentUser']; ?>
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <p><?php echo $nom ?></p>
            </div>
            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <p><?php echo $prenom ?></p>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Adresse email</label>
                <p><?php echo $email ?></p>
            </div>        
        <?php else : ?>
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" placeholder="Votre nom" required>
            </div>
            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Votre prénom" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Adresse email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
            </div>
        <?php endif ?>
            <div class="mb-3">
                <label for="sujet" class="form-label">Sujet</label>
                <input type="text" class="form-control" id="sujet" name="sujet" placeholder="Voyage en Italie" required>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
            </div>
            <div>
                <button type="submit" name="Intention" value="SendEmail" class="btn btn-success">Submit</button>
            </div>
        </form>
    </div>
    <?php endif ?>
    <?php include_once('./components/footer.php'); ?>
</body>

</html>