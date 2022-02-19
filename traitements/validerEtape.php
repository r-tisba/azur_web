<?php
require_once "../vues/utilisateur/entete.php";
$etape = new Etape();
$idUtilisateur = $_SESSION["idUtilisateur"];
$idEquipe = $_GET["id"];
if (!empty($_POST["idEtape"]))
{
    extract($_POST);
        if ($etape->validerEtape($idEtape) == true)
        {
            $service->redirectNow("../vues/utilisateur/listeProjets.php?id=$idEquipe");
        }
}else{
    $service->redirectNow("../vues/utilisateur/listeProjets.php?error=missing&id=$idEquipe");
}