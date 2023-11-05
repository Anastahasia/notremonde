<?php

include("../components/connexion.php");
if (isset($_POST['Intention'])) {
    extract($_POST);
    switch ($_POST['Intention']) {

        case 'AddCircuit':
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
                header("Location: " . "../circuit.php?edit=true&id_circuit=$CircuitID");
                die();
            }

            break;

        case 'DeleteCircuit':
            $UpdateFieldCondition = array('id_circuit' => $_POST['id_circuit']);

            $Success = $NewConnection->delete('circuit', $UpdateFieldCondition);

            if ($Success) {
                header("Location: " . '../gestion.php');
                die();
            }
            break;

        case 'AddItineraire':
            $Condition = '(`nom` = "brouillon")';
            // var_dump($CategoryID);

            $ItineraireID = $NewConnection->insert('itineraire', array(
                'titre' => 'Sans titre',
                'description' => 'Ajouter une description',
                'photo' => '',
                'alt' => 'Ajouter une description de la photo',
                'arrivee' => date('Y-m-d', time()),
                'depart' => date('Y-m-d', time()),
                'voyageurs_adultes' => '1',
                'voyageurs_enfants' => '1',
                'prix_total' => '500',
            ));

            if ($ItineraireID) {
                header("Location: " . "../circuit.php?edit=true&id_itineraire=$ItineraireID");
                die();
            }

            break;

        case 'DeleteItineraire':
            $UpdateFieldCondition = array('id_itineraire' => $_POST['id_itineraire']);

            $Success = $NewConnection->delete('itineraire', $UpdateFieldCondition);

            if ($Success) {
                header("Location: " . '../gestion.php');
                die();
            }
            break;


        case 'AddUser':
            $UserID = $NewConnection->insert('utilisateur', array(
                'nom' => $nom,
                'prenom' => $prenom,
                'num' => $num,
                'email' => $email,
                'mot_de_passe' => password_hash('test', PASSWORD_DEFAULT),
                'role' => $roles,
            ));

            if ($UserID) {
                header("Location: " . "../gestion.php");
                die();
            }

            break;

        case 'UpdateUser':

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
            }

            break;

        case 'DeleteUser':
            $UpdateFieldCondition = array('id_utilisateur' => $_POST['id_utilisateur']);

            $Success = $NewConnection->delete('utilisateur', $UpdateFieldCondition);

            if ($Success) {
                header("Location: " . '../gestion.php');
                die();
            }
            break;
            
        case 'UpdateCircuit':
            if (isset($_FILES) && $_FILES) {
                $_POST[$_POST['Column']] = $_FILES[$_POST['Column']]['name'];
            }
            $Values = array(
                $_POST['Column'] => $_POST[$_POST['Column']]
            );

            $Condition = array('id_circuit' => $_POST['id_circuit']);

            $Success = $NewConnection->update('circuit', $Condition, $Values);

            die();
            break;
    }
}
