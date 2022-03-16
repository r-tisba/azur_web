<?php
// NON UTILISE

// require_once "../vues/utilisateur/entete.php";
// $etape = new Etape();
// $idUtilisateur = $_SESSION["idUtilisateur"];
// $idEquipe = $_GET["id"];
// $idProjet = $_GET["idProjet"];
// if (!empty($_POST["nom"]) && !empty($_POST["dateDebut"]) && !empty($_POST["dateFin"]))
// {
//         extract($_POST);

//         if ($etape->creerEtape($idProjet, $dateDebut, $dateFin, $nom) == true)
//         {
//             $service->redirectNow("../vues/utilisateur/listeProjets.php?id=$idEquipe");
//         } else {
//             $service->redirectNow("../vues/utilisateur/listeProjets.php?error=fonction&id=$idEquipe");
//         }

// } else {
//     $service->redirectNow("../vues/utilisateur/listeProjets.php?error=missing&id=$idEquipe");
// }