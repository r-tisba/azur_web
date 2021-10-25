<?php
require_once "../modeles/modele.php";
require_once "../utilisateur/entete.php";
$idUtilisateur = $_SESSION["idUtilisateur"];
$objetDiscussion = new Discussion();
$objetMessage = new Message();

if(!empty($_GET["idDiscussion"]))
{
    $idDiscussion = $_GET["idDiscussion"];
    if($objetDiscussion->supprimerDiscussion($idDiscussion) == true)
    {
        if($objetMessage->supprimerMessagesDiscussion($idDiscussion) == true)
        {
            header("location:../utilisateur/listeDiscussions.php?id=$idDiscussion&success=suppression");
        } else {
            header("location:../utilisateur/listeDiscussions.php?id=$idDiscussion&error=suppressionMessage");
        }

    } else {
        header("location:../utilisateur/listeDiscussions.php?id=$idDiscussion&error=suppression");
    }
} else {
    header("location:../utilisateur/listeDiscussions.php?id=$idDiscussion&error=idMessage");
}