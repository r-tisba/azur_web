<?php
require_once "../vues/utilisateur/entete.php";
$objetMessage = new Message();
$idUtilisateur = $_SESSION["idUtilisateur"];
if (($_GET["id"])) {
    $idDiscussion = $_GET["id"];

    if (!empty($_POST["contenu"])) {
        extract($_POST);

        if ($objetMessage->ajoutMessage($idDiscussion, htmlspecialchars($contenu), $idUtilisateur) == true)
        {
            $service->redirectNow("../vues/utilisateur/discussion.php?id=$idDiscussion");
        } else {
            $service->redirectNow("../vues/utilisateur/discussion.php?error=fonction");
        }
    } else {
        $service->redirectNow("../vues/utilisateur/discussion.php?error=post");
    }
} else {
    $service->redirectNow("../vues/utilisateur/discussion.php?error=missing");
}
