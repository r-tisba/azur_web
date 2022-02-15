<?php
require_once "../modeles/modele.php";
require_once "../utilisateur/entete.php";
$objetDiscussion = new Discussion();
$idUtilisateur = $_SESSION["idUtilisateur"];
if (!empty($_GET["idEnvoyeur"])&& !empty($_GET["idReceveur"])) {
    extract($_GET);
    if($objetDiscussion->verifierDiscussion($idEnvoyeur, $idReceveur)==false){
        $ajoutDiscussion=$objetDiscussion->creerDiscussion($idEnvoyeur, $idReceveur);
        $discussion=$objetDiscussion->verifierDiscussion($idEnvoyeur, $idReceveur);
        $idDiscussion=$discussion["idDiscussion"];
        header("location:../utilisateur/discussion.php?id=$idDiscussion");
    }else{
        $discussion=$objetDiscussion->verifierDiscussion($idEnvoyeur, $idReceveur);
        $idDiscussion=$discussion["idDiscussion"];
        header("location:../utilisateur/discussion.php?id=$idDiscussion");
    }

} else {
    header("location:../utilisateur/discussion.php?error=missing");
}
