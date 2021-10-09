<?php
require_once "../modeles/modele.php";
require_once "../modeles/message.php";
session_start();
$idUtilisateur = $_SESSION["idUtilisateur"];
$objetMessage = new Message();
$utilisateur = new Utilisateur($idUtilisateur);

if (!empty($_POST["idMessage"])) {
    extract($_POST);
    $nouveau_message = $objetMessage->modifierMessage($idMessage);
    if ($nouvPseudo == true) {
        header("location:../utilisateur/modifierPseudo.php?success=modification");
    } else {
        header("location:../utilisateur/modifierPseudo.php?error=modification");
    }
} else {
    header("location:../utilisateur/modifierPseudo.php?error=idMessage");
}
