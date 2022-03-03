<?php
require_once "../vues/utilisateur/entete.php";
$idUtilisateur = $_SESSION["idUtilisateur"];
$objetMessage = new MessageGroupe();
$idEquipe = $_GET["idEquipe"];

if(!empty($_GET["idMessage"]))
{
    $idMessage = $_GET["idMessage"];
    if($objetMessage->supprimerMessage($idMessage) == true){
        $service->redirectNow("../vues/utilisateur/messagerieGroupe.php?id=$idEquipe&success=suppression");
    } else {
        $service->redirectNow("../vues/utilisateur/messagerieGroupe.php?id=$idEquipe&error=suppression");
    }
} else {
    $service->redirectNow("../vues/utilisateur/messagerieGroupe.php?id=$idEquipe&error=idMessage");
}