<?php

include("../components/connexion.php");

require "../vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

if (isset($_POST['Intention'])) {

    function valid_data($data)
    {
        $data = htmlspecialchars($data);
        return $data;
    }

    extract($_POST);
    switch ($_POST['Intention']) {
        case 'Signup':
            $surname = valid_data($nom);
            $name = valid_data($prenom);
            $num = valid_data($num);
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);
            $mdp = valid_data($mot_de_passe);
            // $HashedPassword = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);
            $HashedPassword = password_hash($mdp, PASSWORD_ARGON2ID, ['memory_cost' => 1 << 17, 'time_cost' => 4, 'threads' => 2]);

            var_dump($email);
            $EmailVerify = $NewConnection->select('utilisateur', "email", "email = '$email'");

            if (empty($EmailVerify)) {
                $Success = $NewConnection->insert_user($surname, $name, $num, $email, $HashedPassword); #inserts a new user if the email adress doesn't exist in the DB
            } else {
                session_start();

                $_SESSION['HasFailedSignedUp'] = true;

                header("Location: " . '../register.php');
                die();
            }

            // NOTE: we let fall through from signup to login, so it automatically logs in
            //break;

        case 'Login':
            $Condition = '(`email` = "' . $email . '")';
            $UniqueUser = $NewConnection->select('utilisateur', "*", $Condition);
            // var_dump($UniqueUser[0]);

            session_start([
                'cookie_lifetime' => (30 * 60) //lifetime of session in seconds
            ]);

            $_SESSION['crsf_token'] = bin2hex(random_bytes(32));

            if ($UniqueUser && password_verify($mot_de_passe, $UniqueUser[0]['mot_de_passe'])) {

                $_SESSION['CurrentUser'] = $UniqueUser[0]['email'];
                $_SESSION['CurrentUserSurname'] = $UniqueUser[0]['nom'];
                $_SESSION['CurrentUserName'] = $UniqueUser[0]['prenom'];
                $_SESSION['UserRole'] = $UniqueUser[0]['role'];
                $_SESSION['UserID'] = $UniqueUser[0]['id_utilisateur'];

                // if (isset($_SESSION['HasFailedSignedUp']))
                //     unset($_SESSION['HasFailedSignedUp']);

                // if (isset($_SESSION['HasFailedLogin']))
                //     unset($_SESSION['HasFailedLogin']);

                header("Location: " . '../index.php');
                die();
            } else {
                $_SESSION['HasFailedLogin'] = true;

                header("Location: " . '../login.php');
                die();
            }

            // var_dump($_SESSION);

            break;

        case 'Logout':
            session_start();

            session_unset();
            session_destroy();

            //var_dump($_SESSION);

            header('Location: ../index.php');
            die();

            break;

        case 'SendEmail':
            session_start();
            $MessageSent = false;
            $email="";
            var_dump($_SESSION);
            if (isset($_SESSION['CurrentUser'])) {
                $email = $_SESSION['CurrentUser'];
                $prenom = $_SESSION['CurrentUserName'];
            }else{ 
                $email = $_POST['email'];
                $prenom = $_POST['prenom'];
            }
            var_dump($email);
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

                $mail = new PHPMailer(true);

                $mail->issmtp();
                $mail->SMTPAuth = true;

                $mail->Host = "smtp.gmail.com";
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                $mail->Username = "licetiesta@gmail.com";
                $mail->Password = "notremondetest";

                $mail->setFrom($email, $prenom .' '. $nom);
                
                $mail->addAddress("licetiesta@gmail.com");

                $mail->Subject = $sujet;
                $mail->Body = $message;

                $mail->send();

                $MessageSent = true;
                var_dump($MessageSent);
            }
        case 'AskQuotation':
            session_start();

            $email="";
            // var_dump($_SESSION);
            if (isset($_SESSION['CurrentUser'])) {
                $email = $_SESSION['CurrentUser'];
                $prenom = $_SESSION['CurrentUserName'];
            }else{ 
                $email = $_POST['email'];
                $prenom = $_POST['prenom'];
            }
            // var_dump($email);
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

                $mail = new PHPMailer(true);

                $mail->issmtp();
                $mail->SMTPAuth = true;

                $mail->Host = "smtp.gmail.com";
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                $mail->Username = "licetiesta@gmail.com";
                $mail->Password = "notremondetest";

                $mail->setFrom($email, $prenom.' '. $nom);
                
                $mail->addAddress("licetiesta@gmail.com");

                $mail->Subject = "Demande de devis";

                $body = "";

                $body .= "Date d'arrivée" . $arrivalDate . "  ";
                $body .= "Date de retour: " . $departureDate . "\r\n";
                $body .= "Nombre de voyageurs: " . $adults . " adultes et ". $adults . " enfants \r\n";
                $body .= "À partir du circuit: " . $inspi . "\r\n";
                $body .= "Interessé(e) par: " . $categorie . "\r\n";
                $body .= "Où: " . $pays . "\r\n";
                $body .= "Message: " . $message . "\r\n";

                $mail->Body = $body;

                $mail->send();

                $MessageSent = true;
                var_dump($body);
            }
    }
}
if (isset($_GET['Intention'])) {
    session_start();

    $circuit = $_GET['voyage'];
    $user = $_SESSION['UserID'];

    $Condition = '(`circuit`=' . $circuit . ' AND `utilisateur`=' . $user . ')';
    if (isset($user)) {
        $Select = $NewConnection->select('favoris', '*', $Condition);
        if (empty($Select)) {
            $Values = array(
                'circuit' => $circuit,
                'utilisateur' => $user,
            );

            $Favorite = $NewConnection->insert('favoris', $Values);
            var_dump($Favorite);
        } else {
            $Values = array(
                'circuit' => $circuit,
                'utilisateur' => $user,
            );

            $Favorite = $NewConnection->delete('favoris', $Values);
            var_dump($Favorite);
        }
    }
}
