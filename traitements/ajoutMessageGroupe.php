<?php
require_once "../modeles/modele.php";
require_once "../utilisateur/entete.php";
$objetMessage = new Message_Groupe();
$idUtilisateur = $_SESSION["idUtilisateur"];


if (($_GET["id"])) {
    $idEquipe = $_GET["id"];

    if (!empty($_POST["contenu"])) {
        extract($_POST);

        if ($objetMessage->ajoutMessages($idEquipe, $contenu, $idUtilisateur) == true)
        {
            $service->redirectNow("../utilisateur/messagerieGroupe.php?id=$idEquipe");
        } else {
            $service->redirectNow("../utilisateur/messagerieGroupe.php?error=fonction&&?id=$idEquipe");
        }
    } else {
        $service->redirectNow("../utilisateur/messagerieGroupe.php?error=post&&?id=$idEquipe");
    }
} else {
    $service->redirectNow("../utilisateur/messagerieGroupe.php?error=missing&&?id=$idEquipe");
}
