<?php

include("../components/connexion.php");

if (isset($_POST['Intention'])){

    extract($_POST);
    switch ($_POST['Intention']) {
        case 'Signup':

            // $HashedPassword = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);
            $HashedPassword = password_hash($mot_de_passe, PASSWORD_ARGON2ID, ['memory_cost' => 1<<17, 'time_cost' => 4, 'threads' => 2]);

            $Values = array(
                'nom' => $nom,
                'prenom' => $prenom,
                'num' => $num,
                'email' => $email,
                'mot_de_passe' => $HashedPassword,
                'role' => 'guest'
            );
            // var_dump($Values);

            $Success = $NewConnection->insert('utilisateur', $Values);

            if (!$Success)
            {
                session_start();

                $_SESSION['HasFailedSignedUp'] = true;

                header("Location: " . '../register.php');
                die();
            }

            // NOTE: we let fall through from signup to login, so it automatically logs in
            // break;
            
        case 'Login':
            $Condition = '(`email` = "' . $email . '")';
            $UniqueUser = $NewConnection->select('utilisateur', "*", $Condition);
            // var_dump($UniqueUser[0]);

            session_start([
                'cookie_lifetime' => (30 * 60) //lifetime of session in seconds
            ]);

            $_SESSION['crsf_token'] = bin2hex(random_bytes(32));

            if ($UniqueUser && password_verify($_POST['mot_de_passe'], $UniqueUser[0]['mot_de_passe'])) {

                $_SESSION['CurrentUser'] = $UniqueUser[0]['email'];
                $_SESSION['CurrentUserName'] = $UniqueUser[0]['nom'];
                $_SESSION['UserRole'] = $UniqueUser[0]['role'];
                $_SESSION['UserID'] = $UniqueUser[0]['id_utilisateur'];

                // if (isset($_SESSION['HasFailedSignedUp']))
                //     unset($_SESSION['HasFailedSignedUp']);

                // if (isset($_SESSION['HasFailedLogin']))
                //     unset($_SESSION['HasFailedLogin']);

                header("Location: " . '../index.php');
                die();
            }
            else {
                $_SESSION['HasFailedLogin'] = true;

                header("Location: " . '../login.php');
                die();
            }

            // var_dump($_SESSION);

            break;

        case 'Logout':
            session_start();

            // session_unset();
            session_destroy();
        
            // var_dump($_SESSION);
        
            header('Location: ../index.php' );
            die();

            break;
    }
}
