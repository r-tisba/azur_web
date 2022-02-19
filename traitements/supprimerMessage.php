<?php
require_once "../vues/utilisateur/entete.php";
$idUtilisateur = $_SESSION["idUtilisateur"];
$objetMessage = new Message();
$idDiscussion = $_GET["idDiscussion"];

if(!empty($_GET["idMessage"]))
{
    $idMessage = $_GET["idMessage"];
    if($objetMessage->supprimerMessage($idMessage) == true){
        $service->redirectNow("../vues/utilisateur/discussion.php?id=$idDiscussion&success=suppression");
    } else {
        $service->redirectNow("../vues/utilisateur/discussion.php?id=$idDiscussion&error=suppression");
    }
} else {
    $service->redirectNow("../vues/utilisateur/discussion.php?id=$idDiscussion&error=idMessage");
}