<?php
require_once "../modeles/modele.php";
session_start();
$idUtilisateur = $_SESSION["idUtilisateur"];
$objetMessage = new Message_Groupe();
$idEquipe = $_GET["idEquipe"];

if(!empty($_GET["idMessage"]))
{
    $idMessage = $_GET["idMessage"];
    if($objetMessage->supprimerMessage($idMessage) == true){
        header("location:../utilisateur/messagerieGroupe.php?id=$idEquipe&success=suppression");
    } else {
        header("location:../utilisateur/messagerieGroupe.php?id=$idEquipe&error=suppression");
    }
} else {
    header("location:../utilisateur/messagerieGroupe.php?id=$idEquipe&error=idMessage");
}