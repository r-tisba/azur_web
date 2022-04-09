<?php
require_once "../vues/utilisateur/entete.php";
$objetMessage = new Message();
$objetDiscussion = new Discussion();
$idUtilisateur = $_SESSION["idUtilisateur"];

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
            if ($objetMessage->ajoutMessage($idDiscussion, htmlspecialchars($contenu), $idUtilisateur) == true)
            {
                $service->redirectNow("../vues/utilisateur/discussion.php?id=$idDiscussion");
            } else {
                $service->redirectNow("../vues/utilisateur/discussion.php?error=fonction");
            }
            /* Sinon on crée cette nouvelle discussion */
        } else {
            if($objetDiscussion->creerDiscussion($_SESSION["idUtilisateur"], $idDestinataire) == true)
            {
                /* Et on envoie le message */
                $result = $objetDiscussion->recupererDiscussionViaEnvoyeurDestinataire($_SESSION["idUtilisateur"], $idDestinataire);
                $idDiscussion = $result["idDiscussion"];
                if ($objetMessage->ajoutMessage($idDiscussion, $contenu, $idUtilisateur) == true)
                {
                    $service->redirectNow("../vues/utilisateur/discussion.php?id=$idDiscussion");
                } else {
                    $service->redirectNow("../vues/utilisateur/discussion.php?error=fonction");
                }
            } else {
                $service->redirectNow("../vues/utilisateur/ListeDiscussions.php?error=fonctionDiscussion");
            }
        }
    } else {
        $service->redirectNow("../vues/utilisateur/ListeDiscussions.php?error=post");
    }
} else {
    $service->redirectNow("../vues/utilisateur/ListeDiscussions.php?error=missing");
}
