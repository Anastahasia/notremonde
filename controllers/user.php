<?php
session_start();
require_once("../components/connexion.php");
require_once("../components/communs.php");

require_once("../vendor/autoload.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

if (isset($_POST['Intention'])) {

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
            $EmailVerify = $NewConnection->select('utilisateur', "email", $email);

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
            $Condition = $email;
            $UniqueUser = $NewConnection->select('utilisateur', "email", $Condition);
            // var_dump($UniqueUser[0]);

            session_start([
                'cookie_lifetime' => (30 * 60) //lifetime of session in seconds
            ]);

            if ($UniqueUser && password_verify($mot_de_passe, $UniqueUser[0]['mot_de_passe'])) {
                $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
                $_SESSION['CurrentUser'] = $UniqueUser[0]['email'];
                $_SESSION['CurrentUserSurname'] = $UniqueUser[0]['nom'];
                $_SESSION['CurrentUserName'] = $UniqueUser[0]['prenom'];
                $_SESSION['CurrentUserPhone'] = $UniqueUser[0]['num'];
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
    }
}

if (isset($_POST['SendEmail'])) {
    $MessageSent = false;
    if (token_verify()) {
        extract($_POST);

        contact_form($message);
    }
}

if (isset($_POST['AskQuotation'])) {
    $MessageSent = false;
    if (token_verify()) {
        extract($_POST);

        $body .= "Date d'arrivée" . $arrivalDate . "  ";
        $body .= "Date de retour: " . $departureDate . "\r\n";
        $body .= "Nombre de voyageurs: " . $adults . " adultes et " . $adults . " enfants \r\n";
        $body .= "À partir du circuit: " . $inspi . "\r\n";
        $body .= "Interessé(e) par: " . $categorie . "\r\n";
        $body .= "Où: " . $pays . "\r\n";
        $body .= "Message: " . $message . "\r\n";

        contact_form($body);
    }
}

//modification du profil par l'utilisateur

if (isset($_POST['modifyEmail'])) {
    if (token_verify()) {
        extract($_POST);

        $Values = array('email' => filter_var($email, FILTER_VALIDATE_EMAIL));
        $Condition = array('id_utilisateur' => $_SESSION['UserID']);

        $NewPhone = $NewConnection->update('utilisateur', $Condition, $Values);

        if ($NewPhone) {
            session_start();
            header("Location: " . "../profil.php");
            die();
        }else {
            $_SESSION['FailedUpdate']=true;
            header("Location: " . "../profil.php");
            die();
        }
    }
}

if (isset($_POST['modifyPhone'])) {
    if (token_verify()) {
        extract($_POST);

        $Values = array('num' => valid_data($phone));
        $Condition = array('id_utilisateur' => $_SESSION['UserID']);

        $NewPhone = $NewConnection->update('utilisateur', $Condition, $Values);

        if ($NewPhone) {
            session_start();
            header("Location: " . "../profil.php");
            die();
        }else {
            $_SESSION['FailedUpdate']=true;
            header("Location: " . "../profil.php");
            die();
        }
    }
}

if (isset($_POST['modifyMDP'])) {
    extract($_POST);
    if ($newMdp == $verifMdp) {
        if (token_verify()) {
            $Condition = $_SESSION['UserID'];
            $UniqueUser = $NewConnection->select('utilisateur', "id_utilisateur", $Condition);

            var_dump($UniqueUser, $_SESSION, $Condition);
            if ($UniqueUser && password_verify($oldMdp, $UniqueUser[0]['mot_de_passe'])) {
                $Condition = array('id_utilisateur' => $_SESSION['UserID']);
                $Values = array('mot_de_passe' => password_hash($newMdp, PASSWORD_ARGON2ID, ['memory_cost' => 1 << 17, 'time_cost' => 4, 'threads' => 2]));

                $NewPhone = $NewConnection->update('utilisateur', $Condition, $Values);

                if ($NewPhone) {
                    session_start();
                    $_SESSION['SuccessfulUpdate']=true;
                    header("Location: " . "../profil.php");
                    die();
                }
            } else {
                $_SESSION['FailedUpdate']=true;
                header("Location: " . "../profil.php");
                die();
            }
        } else {
            session_start();
            $_SESSION['FailedUpdate']=true;
            header("Location: " . "../profil.php");
            die();
        }
    }
}

if (isset($_GET['Intention'])) {
    session_start();

    $circuit = $_GET['voyage'];
    $user = $_SESSION['UserID'];

    $Condition1 = $circuit;
    $Condition2 = $user;
    if (isset($user)) {
        $Select = $NewConnection->two_conditions_select('favoris', 'circuit', 'utilisateur', $Condition1, $Condition2);
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
