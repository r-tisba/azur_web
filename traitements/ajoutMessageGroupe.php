<?php
require_once "../vues/utilisateur/entete.php";
$objetMessage = new MessageGroupe();
$idUtilisateur = $_SESSION["idUtilisateur"];


if (($_GET["id"])) {
    $idEquipe = $_GET["id"];

    if (!empty($_POST["contenu"])) {
        extract($_POST);

        if ($objetMessage->ajoutMessage($idEquipe, $contenu, $idUtilisateur) == true)
        {
            $service->redirectNow("../vues/utilisateur/messagerieGroupe.php?id=$idEquipe");
        } else {
            $service->redirectNow("../vues/utilisateur/messagerieGroupe.php?error=fonction&&?id=$idEquipe");
        }
    } else {
        $service->redirectNow("../vues/utilisateur/messagerieGroupe.php?error=post&&?id=$idEquipe");
    }
} else {
    $service->redirectNow("../vues/utilisateur/messagerieGroupe.php?error=missing&&?id=$idEquipe");
}
