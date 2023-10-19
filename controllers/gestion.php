<?php
        
    include("../components/connexion.php");
    if (isset($_POST['Intention'])){

        switch ($_POST['Intention']) {
                
            case 'AddCircuit':
            $Condition = '(`nom` = "brouillon")';
            $CategoryID = $NewConnection->select('categorie', "id_categorie", $Condition);
            $CategoryID = $CategoryID ? $CategoryID[0]['id_categorie'] : '1';
            // var_dump($CategoryID);

            $CircuitID = $NewConnection->insert( 'circuit', array(
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
    
            if ($CircuitID)
            {
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

            $ItineraireID = $NewConnection->insert( 'itineraire', array(
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
    
            if ($ItineraireID)
            {
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
        }
        }