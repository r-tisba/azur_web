<?php
require_once "../modeles/modele.php";
session_start();
$objetMessage = new Message_Groupe();
$idEmploye = $_SESSION["idUtilisateur"];

if (($_GET["id"])) {
    $idEquipe = $_SESSION["idEquipe"];

    if (!empty($_POST["contenu"])) {
        extract($_POST);

        if ($objetMessage->ajoutMessages($idEquipe, $contenu, $idEmploye) == true)
        {
            header("location:../utilisateur/messagerieGroupe.php?id=$idDiscussion");
        } else {
            header("location:../utilisateur/messagerieGroupe.php?error=fonction");
        }
    } else {
        header("location:../utilisateur/messagerieGroupe.php?error=post");
    }
} else {
    header("location:../utilisateur/messagerieGroupe.php?error=missing");
}
