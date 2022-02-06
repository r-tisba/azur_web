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
            $service->redirectNow("../utilisateur/listeProjets.php?id=$idEquipe");
        }
}else{
    $service->redirectNow("../utilisateur/listeProjets.php?error=missing&id=$idEquipe");
}