<?php
require_once "../modeles/modele.php";
require_once "../modeles/message.php";
require_once "../utilisateur/entete.php";
$idUtilisateur = $_SESSION["idUtilisateur"];
$objetMessage = new Message();
$idDiscussion = $_GET["idDiscussion"];

if(!empty($_GET["idMessage"]))
{
    $idMessage = $_GET["idMessage"];
    if($objetMessage->supprimerMessage($idMessage) == true){
        header("location:../utilisateur/discussion.php?id=$idDiscussion&success=suppression");
    } else {
        header("location:../utilisateur/discussion.php?id=$idDiscussion&error=suppression");
    }
} else {
    header("location:../utilisateur/discussion.php?id=$idDiscussion&error=idMessage");
}