<?php 
require_once ("../components/connexion.php");
$user_id = $_GET['id'];
$token = $_GET['token'];

$Confirm = $NewConnection ->select('utilisateur', 'id_utilisateur', $user_id);

if($Confirm && $Confirm[0]['confirmation_token'] == $token ){
    $Values = array('confirmed_at' => date("j/m/Y h:i:s"));
    $Condition = array('id_utilisateur' => $user_id);
    $NewConnection->update('utilisateur', $Condition, $Values);
    $_SESSION['flash']['success'] = 'Votre compte a bien été validé';
    $_SESSION['auth'] = $user;
    header('Location: ../login.php');
}else{
    $_SESSION['flash']['danger'] = "Ce token n'est plus valide";
    header('Location: ../register.php');
}