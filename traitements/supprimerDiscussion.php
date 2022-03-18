<?php
require_once "../vues/utilisateur/entete.php";
$idUtilisateur = $_SESSION["idUtilisateur"];

if(!empty($_GET["idDiscussion"]))
{
    $idDiscussion = $_GET["idDiscussion"];
    $objetDiscussion = new Discussion($idDiscussion);
    $objetMessage = new Message();
    
    if($objetDiscussion->getIdEnvoyeur() == $idUtilisateur || $objetDiscussion->getIdDestinataire() == $idUtilisateur)
    {
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
        $service->redirectNow("../vues/utilisateur/listeDiscussions.php");
    }
} else {
    $service->redirectNow("../vues/utilisateur/listeDiscussions.php?error=idMessage");
}