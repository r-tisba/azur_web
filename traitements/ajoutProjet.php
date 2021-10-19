<?php
require_once "../modeles/modele.php";
session_start();
$projet = new Projet();
$idEmploye = $_SESSION["idUtilisateur"];
$idEquipe = $_SESSION["idEquipe"];
if (!empty($_POST["nom"]) && !empty($_POST["importance"]) && !empty($_POST["dateDebut"]) && !empty($_POST["dateFin"])) {

        extract($_POST);

        if ($projet->ajoutProjet($idEquipe, $nom, $dateDebut, $dateFin, $importance) == true)
        {
            header("location:../utilisateur/projet.php");
        } else {
            header("location:../utilisateur/projet.php?error=fonction");
        }
   
} else {
    header("location:../utilisateur/projet.php?error=missing");
}