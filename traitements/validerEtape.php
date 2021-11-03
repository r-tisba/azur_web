<?php
require_once "../modeles/modele.php";
require_once "../utilisateur/entete.php";
$etape = new Etape();
$idUtilisateur = $_SESSION["idUtilisateur"];
$idEquipe = $_GET["id"];
if (!empty($_POST["idEtape"]))
{
    extract($_POST);
        if ($etape->validerEtape($idEtape) == true)
        {
            header("location:../utilisateur/projet.php?id=$idEquipe");
        }
}else{
    header("location:../utilisateur/projet.php?error=missing&id=$idEquipe");
}