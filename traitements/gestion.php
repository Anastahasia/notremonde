<?php

require_once("../components/connexion.php");
require_once("../components/fonctions.php");
if (token_verify()) {
    extract($_POST);

    if (isset($_POST['AddCircuit'])) {

        $Condition = '(`nom` = "brouillon")';
        $CategoryID = $NewConnection->select('categorie', "id_categorie", $Condition);
        $CategoryID = $CategoryID ? $CategoryID[0]['id_categorie'] : '1';
        // var_dump($CategoryID);

        $CircuitID = $NewConnection->insert('circuit', array(
            'titre' => 'Sans titre',
            'description' => 'Ajouter une description',
            'duree' => '10',
            'photo' => '',
            'alt' => 'Ajouter une description de la photo',
            'prix_estimatif' => '500',
            'visible' => '0',
            'enfants' => '1',
            'categorie' => $CategoryID,
        ));

        if ($CircuitID) {
            header("Location: " . "../FormulaireCircuit.php?circuit=$CircuitID");
            die();
        }else{
        echo"Une erreur s'est produite veuillez réessayer";
    }
    }


    if (isset($_POST['DeleteCircuit'])) {
        $UpdateFieldCondition = array('id_circuit' => $_POST['id_circuit']);

        $Success = $NewConnection->delete('circuit', $UpdateFieldCondition);

        if ($Success) {
            header("Location: " . '../gestion.php');
            die();
        }else{
            echo"Une erreur s'est produite veuillez réessayer";
        }
    }
    if (isset($_POST['AddAccomodation'])) {
        $Condition = '(`nom` = "brouillon")';
        // var_dump($CategoryID);

        $AccomodationID = $NewConnection->insert('hebergement', array(
            'nom' => 'Sans titre',
            'photo1' => 'Ajouter une photo',
            'photo2' => 'Ajouter une photo',
            'descriptionHebergement	' => "Ajouter une description de l'hebergment",
            'adresse' => "Ajouter l'adresse de l'hebergemennt",
            'telephone' => "Ajouter le numéro de téléphone",
            'ville' => '0',
        ));

        if ($AccomodationID) {
            header("Location: " . "../hebergement.php?id_hebergement=$AccomodationID");
            die();
        }else{
            echo"Une erreur s'est produite veuillez réessayer";
        }
    }

    if (isset($_POST['DeleteAccomodation'])) {
        $UpdateFieldCondition = array('id_hebergement' => $_POST['id_hebergement']);

        $Success = $NewConnection->delete('hebergement', $UpdateFieldCondition);

        if ($Success) {
            header("Location: " . '../gestion.php');
            die();
        }else{
            echo"Une erreur s'est produite veuillez réessayer";
        }
    }

    if (isset($_POST['AddUser'])) {
        $UserID = $NewConnection->insert('utilisateur', array(
            'nom' => $nom,
            'prenom' => $prenom,
            'num' => $num,
            'email' => $email,
            'mot_de_passe' => password_hash('test', PASSWORD_DEFAULT),
            'role' => $roles,
            'confirmation_token'=> $token,
        ));

        if ($UserID) {
            mail($_POST['email'], 'Confirmation de votre compte', "Afin de valider votre compte sur notre monde merci de cliquer sur ce lien\n\nhttp://assani-anasthasia-notremonde.sc3nuxz4136.universe.wf/components/confirm.php?id=$UserID&token=$token");
            header("Location: " . "../gestion.php");
            die();
        }else{
            echo"Une erreur s'est produite veuillez réessayer";
        }
    }

    if (isset($_POST['UpdateUser'])) {

        $Condition = array('id_utilisateur' => $_POST['id_utilisateur']);

        $Values = array(
            'nom' => $surname,
            'prenom' => $name,
            'num' => $phone,
            'email' => $mail,
            'role' => $role,
        );

        $UserID = $NewConnection->update('utilisateur', $Condition, $Values);

        if ($UserID) {
            header("Location: " . "../gestion.php");
            die();
        }else{
            echo"Une erreur s'est produite veuillez réessayer";
        }
    }
    if (isset($_POST['DeleteUser'])) {
        $UpdateFieldCondition = array('id_utilisateur' => $_POST['id_utilisateur']);

        $Success = $NewConnection->delete('utilisateur', $UpdateFieldCondition);

        if ($Success) {
            header("Location: " . '../gestion.php');
            die();
        }else{
            echo"Une erreur s'est produite veuillez réessayer";
        }
    }


if (isset($_POST['UpdateCircuit'])) {

    if (isset($_FILES) && $_FILES) {
        $_POST[$_POST['Column']] = $_FILES[$_POST['Column']]['name'];
    }
    $Values = array(
        $_POST['Column'] => $_POST[$_POST['Column']]
    );

    $Condition = array('id_circuit' => $_POST['id_circuit']);

    $Success = $NewConnection->update('circuit', $Condition, $Values);

    die();
}
}
if (isset($_POST['UpdateSteps'])) {
var_dump($_POST['UpdateSteps']);
var_dump($_POST['id_ec']);
    $Values = array(
        $_POST['Column'] => $_POST[$_POST['Column']]
    );

    $Condition = array('id_ec' => $_POST['id_ec']);

    $Success = $NewConnection->update('etape_circuit', $Condition, $Values);

    die();
}
