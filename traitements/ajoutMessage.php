<?php
require_once "../modeles/modele.php";
session_start();
$objetMessage = new Message();
$idEmploye=$_SESSION["idUtilisateur"];
if(($_GET["id"])){
    $idDiscussion=$_GET["id"];

    if (!empty($_POST["contenu"])){
        extract($_POST);

        if($objetMessage->ajoutMessages($idDiscussion, $contenu, $idEmploye)==true){
            header("location:../utilisateur/discussion.php?id=$idDiscussion");
        }else{
            header("location:../utilisateur/discussion.php?error=fonction");
        }
    }else{
        header("location:../utilisateur/discussion.php?error=post");
    }
}else{
    header("location:../utilisateur/discussion.php?error=missing");
}