<?php
require_once "../modeles/modele.php";
require_once "../utilisateur/entete.php";
$idUtilisateur = $_SESSION["idUtilisateur"];
$objetMessage = new Message_Groupe();
$idEquipe = $_GET["idEquipe"];

if(!empty($_GET["idMessage"]))
{
    $idMessage = $_GET["idMessage"];
    if($objetMessage->supprimerMessage($idMessage) == true){
        $service->redirectNow("../utilisateur/messagerieGroupe.php?id=$idEquipe&success=suppression");
    } else {
        $service->redirectNow("../utilisateur/messagerieGroupe.php?id=$idEquipe&error=suppression");
    }
} else {
    $service->redirectNow("../utilisateur/messagerieGroupe.php?id=$idEquipe&error=idMessage");
}