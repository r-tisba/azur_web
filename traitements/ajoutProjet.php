<?php
require_once "../modeles/modele.php";
require_once "../utilisateur/entete.php";
$projet = new Projet();
$idUtilisateur = $_SESSION["idUtilisateur"];
$idEquipe = $_GET["id"];
if (!empty($_POST["nom"]) && !empty($_POST["importance"]) && !empty($_POST["dateDebut"]) && !empty($_POST["dateFin"]))
{
        extract($_POST);

        if ($projet->ajoutProjet($idEquipe, $nomProjet, $dateDebut, $dateFin, $importance) == true)
        {
            $service->redirectNow("../utilisateur/listeProjets.php?id=$idEquipe");
        } else {
            $service->redirectNow("../utilisateur/listeProjets.php?error=fonction&id=$idEquipe");
        }

} else {
    $service->redirectNow("../utilisateur/listeProjets.php?error=missing&id=$idEquipe");
}