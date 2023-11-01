<?php
require_once ("connexion.php");

if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// require_once ("../vendor/autoload.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
//fonction échappée des entrées utilisateur 
function valid_data($data)
{
    $data = htmlspecialchars($data);
    return $data;
}

// vérifie le token
function token_verify()
{
    if (isset($_SESSION['csrf_token']) && isset($_POST['token'])) {
        if ($_SESSION['csrf_token'] == $_POST['token']) {
            return true;
        }else {
            echo 'La session présente est périmée';
        }
    }
}

//réalise les envois des formulaires de contact
function contact_form($body)
{
    session_start();
    extract($_POST);
    $email = "";

    if (isset($_SESSION['CurrentUser'])) {
        $email = $_SESSION['CurrentUser'];
        $prenom = $_SESSION['CurrentUserName'];
    } else {
        $email = $_POST['email'];
        $prenom = $_POST['prenom'];
    }
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $mail = new PHPMailer(true);

        $mail->issmtp();
        $mail->SMTPAuth = true;

        $mail->Host = "smtp.gmail.com";
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->Username = "licetiesta@gmail.com";
        $mail->Password = "notremondetest";

        $mail->setFrom($email, $prenom . ' ' . $nom);

        $mail->addAddress("licetiesta@gmail.com");

        $mail->Subject = "Demande de devis";

        $body = "";

        $mail->Body = $body;

        $mail->send();

        $MessageSent = true;
        var_dump($body);
    }
}
