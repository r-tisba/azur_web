<?php
require_once "../vues/utilisateur/entete.php";
$idUtilisateur = $_SESSION["idUtilisateur"];
$idDiscussion = $_GET["idDiscussion"];
$objetMessage = new Message();
$objetDiscussion = new Discussion();

if (!empty($_GET["idMessage"])) {
    $idMessage = $_GET["idMessage"];
    // Suppression du message
    if ($objetMessage->supprimerMessage($idMessage) == true) {
        if (isset($_GET["suppr"]) && $_GET["suppr"] == true) {
            // Supression de la discussion
            if ($objetDiscussion->supprimerDiscussion($idDiscussion) == true) {
                $service->redirectNow("../vues/utilisateur/listeDiscussions.php?id=$idDiscussion&success=suppression");
            } else {
                $service->redirectNow("../vues/utilisateur/listeDiscussions.php?id=$idDiscussion&error=suppression");
            }
        } else {
            $service->redirectNow("../vues/utilisateur/discussion.php?id=$idDiscussion&success=suppression");
        }
    } else {
        $service->redirectNow("../vues/utilisateur/discussion.php?id=$idDiscussion&error=suppression");
    }
} else {
    $service->redirectNow("../vues/utilisateur/discussion.php?id=$idDiscussion&error=idMessage");
}
