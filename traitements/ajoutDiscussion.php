<?php
require_once "../modeles/modele.php";
session_start();
$objetMessage = new Message();
$objetDiscussion = new Discussion();
$idEmploye = $_SESSION["idUtilisateur"];

if (!empty($_POST["idDestinataire"]))
{
    $idDestinataire = $_POST["idDestinataire"];

    if (!empty($_POST["contenu"]))
    {
        extract($_POST);

        /* Vérification de si la discussion entre les deux utilisateurs existent déjà */
        /* Si discussion existe déjà, on y envoie le message */
        if($objetDiscussion->verifierDiscussion($_SESSION["idUtilisateur"], $idDestinataire) != false)
        {
            $verif = $objetDiscussion->verifierDiscussion($_SESSION["idUtilisateur"], $idDestinataire);
            $idDiscussion = $verif["idDiscussion"];
            if ($objetMessage->ajoutMessages($idDiscussion, $contenu, $idEmploye) == true)
            {
               header("location:../utilisateur/discussion.php?id=$idDiscussion");
            } else {
                header("location:../utilisateur/discussion.php?error=fonction");
            }
            /* Sinon on crée cette nouvelle discussion */
        } else {
            if($objetDiscussion->creerDiscussion($_SESSION["idUtilisateur"], $idDestinataire) == true)
            {
                /* Et on envoie le message */
                $result = $objetDiscussion->recupererDiscussionViaEnvoyeurDestinataire($_SESSION["idUtilisateur"], $idDestinataire);
                $idDiscussion = $result["idDiscussion"];
                if ($objetMessage->ajoutMessages($idDiscussion, $contenu, $idEmploye) == true)
                {
                    header("location:../utilisateur/discussion.php?id=$idDiscussion");
                } else {
                    header("location:../utilisateur/discussion.php?error=fonction");
                }
            } else {
                header("location:../utilisateur/ListeDiscussions.php?error=fonctionDiscussion");
            }
        }
    } else {
        header("location:../utilisateur/ListeDiscussions.php?error=post");
    }
} else {
    header("location:../utilisateur/ListeDiscussions.php?error=missing");
}
