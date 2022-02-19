<?php
require_once "../vues/utilisateur/entete.php";
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
            $service->redirectNow("../vues/utilisateur/listeDiscussions.php?id=$idDiscussion&success=suppression");
        } else {
            $service->redirectNow("../vues/utilisateur/listeDiscussions.php?id=$idDiscussion&error=suppressionMessage");
        }
    } else {
        $service->redirectNow("../vues/utilisateur/listeDiscussions.php?id=$idDiscussion&error=suppression");
    }
} else {
    $service->redirectNow("../vues/utilisateur/listeDiscussions.php?id=$idDiscussion&error=idMessage");
}