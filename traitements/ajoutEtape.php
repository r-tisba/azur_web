<?php
require_once "../modeles/modele.php";
require_once "../utilisateur/entete.php";
$etape = new Etape();
$idUtilisateur = $_SESSION["idUtilisateur"];
$idEquipe = $_GET["id"];
$idProjet = $_GET["idProjet"];
if (!empty($_POST["nom"]) && !empty($_POST["dateDebut"]) && !empty($_POST["dateFin"]))
{
        extract($_POST);

        if ($etape->creerEtape($idProjet, $dateDebut, $dateFin, $nom) == true)
        {
            header("location:../utilisateur/projet.php?id=$idEquipe");
        } else {
            header("location:../utilisateur/projet.php?error=fonction&id=$idEquipe");
        }

} else {
    header("location:../utilisateur/projet.php?error=missing&id=$idEquipe");
}