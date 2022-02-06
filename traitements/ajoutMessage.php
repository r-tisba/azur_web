<?php
require_once "../modeles/modele.php";
require_once "../utilisateur/entete.php";
$objetMessage = new Message();
$idUtilisateur = $_SESSION["idUtilisateur"];
if (($_GET["id"])) {
    $idDiscussion = $_GET["id"];

    if (!empty($_POST["contenu"])) {
        extract($_POST);

        if ($objetMessage->ajoutMessages($idDiscussion, $contenu, $idUtilisateur) == true)
        {
            $service->redirectNow("../utilisateur/discussion.php?id=$idDiscussion");
        } else {
            $service->redirectNow("../utilisateur/discussion.php?error=fonction");
        }
    } else {
        $service->redirectNow("../utilisateur/discussion.php?error=post");
    }
} else {
    $service->redirectNow("../utilisateur/discussion.php?error=missing");
}
