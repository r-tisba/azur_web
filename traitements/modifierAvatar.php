<?php
require_once "../modeles/modele.php";
require_once "../utilisateur/entete.php";
$dossier = "../images/avatar/";

$utilisateur = new Utilisateur($_SESSION["idUtilisateur"]);
$extension = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
$avatar = $dossier . "avatar_" . $_SESSION["identifiant"] . "." . $extension;

// Vérifier si on peut récupérer les dimensions de l'image
if(getimagesize($_FILES["image"]["tmp_name"]))
{
    // Vérifier si le poids en octet de l'image ne dépasse pas 3M
    if($_FILES["image"]["size"] <= 3000000)
    {
        // Vérifier le vrai type du fichier
        if($_FILES["image"]["type"] == "image/png" || $_FILES["image"]["type"] == "image/jpg" || $_FILES["image"]["type"] == "image/jpeg")
        {
            if(move_uploaded_file($_FILES["image"]["tmp_name"], $avatar)){
                $modifAvatar = $utilisateur->modifierAvatar($avatar, $_SESSION["idUtilisateur"]);
                if($modifAvatar == true)
                {
                    $service->redirectNow("../utilisateur/modifierAvatar.php?success=modification");
                } else {
                    $service->redirectNow("../utilisateur/modifierAvatar.php?error=ajout");
                }
            } else {
                $service->redirectNow("../utilisateur/modifierAvatar.php?error=fichier");
            }
        } else {
            $service->redirectNow("../utilisateur/modifierAvatar.php?error=type");
        }
    } else {
        $service->redirectNow("../utilisateur/modifierAvatar.php?error=taille");
    }
} else {
    $service->redirectNow("../utilisateur/modifierAvatar.php?error=image");
}
?>