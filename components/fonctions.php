<?php
session_start();
require_once("connexion.php");

if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// require_once ("../vendor/autoload.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
//fonction échappée des entrées utilisateur 
function valid_data($data)
{
    $data = trim($data);
    $data = htmlspecialchars($data);
    return $data;
}

// vérifie le token
function token_verify()
{
    if (isset($_SESSION['csrf_token']) && isset($_POST['token'])) {
        if ($_SESSION['csrf_token'] == $_POST['token']) {
            return true;
        } else {
            echo 'La session présente est périmée '. $_POST['token'] .'</br>'. $_SESSION['csrf_token'];
        }
    }else echo $_POST['token'];
}

function GetImagePath($Filename)
{
    return './images/' . $Filename;
}

