<?php
require_once("../components/connexion.php");
require_once("../components/fonctions.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

if (token_verify()) {
    if (isset($_POST['Intention'])) {

        extract($_POST);
        switch ($_POST['Intention']) {
            case "M'inscrire":
                if (!empty($mot_de_passe) && $mot_de_passe == $verif_mot_de_passe) {
                    $surname = valid_data($nom);
                    $name = valid_data($prenom);
                    $num = valid_data($num);
                    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
                    $mdp = valid_data($mot_de_passe);
                    // $HashedPassword = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);
                    $HashedPassword = password_hash($mdp, PASSWORD_ARGON2ID, ['memory_cost' => 1 << 17, 'time_cost' => 4, 'threads' => 2]);

                    // var_dump($email);
                    $EmailVerify = $NewConnection->select('utilisateur', "email", $email);

                    if (empty($EmailVerify)) {
                        $Success = $NewConnection->insert_user($surname, $name, $num, $email, $HashedPassword, $token); #inserts a new user if the email adress doesn't exist in the DB
                        mail($_POST['email'], 'Confirmation de votre compte', "Afin de valider votre compte sur notre monde merci de cliquer sur ce lien\n\nhttp://assani-anasthasia-notremonde.sc3nuxz4136.universe.wf/components/confirm.php?id=$Success&token=$token");

                        header("Location: " . '../login.php');
                        die();

                    } else {
                        session_start();

                        $_SESSION['HasFailedSignedUp'] = true;

                        header("Location: " . '../register.php');
                        die();
                    }
                } else {
                    session_start();

                    $_SESSION['MatchPassword'] = true;

                    header("Location: " . '../register.php');
                    die();
                }

                // NOTE: we let fall through from signup to login, so it automatically logs in
                break;

            case 'Me connecter':

                $Condition = $email;
                $UniqueUser = $NewConnection->select('utilisateur', "email", $Condition);
                // var_dump($UniqueUser[0]);
                $ConfirmedUser = $UniqueUser[0]['confirmed_at'];
                if (!empty($ConfirmedUser)) {
                    if ($UniqueUser && password_verify($mot_de_passe, $UniqueUser[0]['mot_de_passe'])) {
                        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
                        $_SESSION['CurrentUser'] = $UniqueUser[0]['email'];
                        $_SESSION['CurrentUserSurname'] = $UniqueUser[0]['nom'];
                        $_SESSION['CurrentUserName'] = $UniqueUser[0]['prenom'];
                        $_SESSION['CurrentUserPhone'] = $UniqueUser[0]['num'];
                        $_SESSION['UserRole'] = $UniqueUser[0]['role'];
                        $_SESSION['UserID'] = $UniqueUser[0]['id_utilisateur'];
                        if ($_SESSION['UserRole'] == 'admin') {
                            header("Location: " . '../gestion.php');
                            die();
                        }
                        if ($_SESSION['UserRole'] == 'guest') {
                            header("Location: " . '../profil.php');
                            die();
                        }
                    } else {
                        $_SESSION['HasFailedLogin'] = "Votre email ou votre mot de passe est incorrect";

                        header("Location: " . '../login.php');
                        die();
                    }
                }else {
                    $_SESSION['HasFailedLogin'] = "Votre compte n'est pas confirmé.";

                        header("Location: " . '../login.php');
                        die();
                }
                break;

            case 'Logout':

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
        extract($_POST);
        if (isset($_SESSION['CurrentUser'])) {
            $email = $_SESSION['CurrentUser'];
            $prenom = $_SESSION['CurrentUserName'];
        } else {
            $email = $_POST['email'];
            $prenom = $_POST['prenom'];
        }
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $to = "licetiesta@gmail.com";
            $body .= "De: " . $nom . " " . $prenom . "\r\n";
            $body .= "Email: " . $email . "\r\n";
            $body .= "Message: " . $message . "\r\n";
            mail($to, $sujet, $body);
            $MessageSent = true;
            header("Location: " . '../contact.php');
        }
    }
    if (isset($_POST['AskQuotation'])) {
        $MessageSent = false;
        extract($_POST);
        var_dump($email);
        if (isset($_SESSION['CurrentUser'])) {
            $email = $_SESSION['CurrentUser'];
            $prenom = $_SESSION['CurrentUserName'];
        } else {
            $email = $_POST['email'];
            $prenom = $_POST['prenom'];
        }
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $to = "licetiesta@gmail.com";
            $body .= "De: " . $nom . " " . $prenom . "\r\n";
            $body .= "Email: " . $email . "\r\n";
            $body .= "Date d'arrivée: " . $arrivalDate . " \r\n ";
            $body .= "Date de retour: " . $departureDate . "\r\n";
            $body .= "Nombre de voyageurs: " . $adults . " adultes et " . $adults . " enfants \r\n";
            $body .= "À partir du circuit: " . $inspi . "\r\n";
            $body .= "Interessé(e) par: " . $categorie . "\r\n";
            $body .= "Où: " . $pays . "\r\n";
            $body .= "Message: " . $message . "\r\n";
            mail($to, "Demande de devis", $body);
            $MessageSent = true;
            header("Location: " . '../contact.php');
        } else {
            echo 'Votre email est invalide veuillez réessayer.';
        }
    }

    //modification du profil par l'utilisateur

    if (isset($_POST['modifyEmail'])) {

        extract($_POST);

        $Values = array('email' => filter_var($email, FILTER_VALIDATE_EMAIL));
        $Condition = array('id_utilisateur' => $_SESSION['UserID']);
        if ($Values['email'] != false) {
            $NewEmail = $NewConnection->update('utilisateur', $Condition, $Values);
            $NewEmail = $NewConnection->select('utilisateur', 'id_utilisateur', $_SESSION['UserID']);
            if (!empty($NewEmail)) {
                $NewEmail = $NewEmail[0]['email'];
                $_SESSION['CurrentUser'] = $NewEmail;
                $_SESSION['SuccessfulUpdate'] = true;
                // var_dump($_SESSION);
                header("Location: " . "../profil.php");
                die();
            }
        } else {
            $_SESSION['FailedUpdate'] = true;
            header("Location: " . "../profil.php");
            die();
        }
    }


    if (isset($_POST['modifyPhone'])) {

        extract($_POST);

        $Values = array('num' => valid_data($phone));
        $Condition = array('id_utilisateur' => $_SESSION['UserID']);

        $NewPhone = $NewConnection->update('utilisateur', $Condition, $Values);
        $NewPhone = $NewConnection->select('utilisateur', 'id_utilisateur', $_SESSION['UserID']);

        if (!empty($NewPhone)) {
            $_SESSION['CurrentUserPhone'] = $NewPhone[0]['num'];
            $_SESSION['SuccessfulUpdate'] = true;
            header("Location: " . "../profil.php");
            die();
        } else {
            $_SESSION['FailedUpdate'] = true;
            header("Location: " . "../profil.php");
            die();
        }
    }


    if (isset($_POST['modifyMDP'])) {
        extract($_POST);
        if ($newMdp == $verif_mot_de_passe) {

            $Condition = $_SESSION['UserID'];
            $UniqueUser = $NewConnection->select('utilisateur', "id_utilisateur", $Condition);

            // var_dump($UniqueUser, $_SESSION, $Condition);
            if ($UniqueUser && password_verify($oldMdp, $UniqueUser[0]['mot_de_passe'])) {
                $Condition = array('id_utilisateur' => $_SESSION['UserID']);
                $Values = array('mot_de_passe' => password_hash($newMdp, PASSWORD_ARGON2ID, ['memory_cost' => 1 << 17, 'time_cost' => 4, 'threads' => 2]));

                $NewMdp = $NewConnection->update('utilisateur', $Condition, $Values);
                $NewMdp = $NewConnection->select('utilisateur', 'id_utilisateur', $_SESSION['UserID']);
                if (!empty($NewMdp)) {
                    $_SESSION['CurrentUserPhone'] = $NewMdp[0]['mot_de_passe'];
                    $_SESSION['SuccessfulUpdate'] = true;
                    header("Location: " . "../profil.php");
                    die();
                }
            } else {
                $_SESSION['FailedUpdate'] = true;
                header("Location: " . "../profil.php");
                die();
            }
        } else {
            $_SESSION['FailedUpdate'] = true;
            header("Location: " . "../profil.php");
            die();
        }
    }


    if (isset($_POST['favorite'])) {
        $circuit = $_POST['circuit'];
        $user = $_POST['utilisateur'];

        $Condition1 = $circuit;
        $Condition2 = $user;
        if (!empty($user)) {
            $Values = array(
                'circuit' => $circuit,
                'utilisateur' => $user,
            );
            $Select = $NewConnection->select_multi_conditions('favoris', $Values);
            if (empty($Select)) {


                $Favorite = $NewConnection->insert('favoris', $Values);
                // var_dump($Favorite);
                $Select = $NewConnection->select_multi_conditions('favoris', $Values);

                return json_encode($Select);
            } else {
                $Values = array(
                    'circuit' => $circuit,
                    'utilisateur' => $user,
                );

                $Favorite = $NewConnection->delete('favoris', $Values);
            }
        } else {
            $_SESSION['Failed'] = true;
            echo 'utilisateur non défini';
        }
    }
}
