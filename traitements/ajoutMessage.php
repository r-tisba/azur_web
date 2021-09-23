<?php
require_once "../modeles/modele.php";
session_start();
$idEmploye=$_SESSION["idEmploye"];
if(($_GET["id"])){
    $idDiscussion=$_GET["id"];
    
    if (!empty($_POST["contenu"])){
        extract($_POST);
        
        if(ajoutMessages($idDiscussion, $contenu, $idEmploye)==true){
            header("location:../admin/discussion.php?id=$idDiscussion");
        }else{
            header("location:../admin/discussion.php?error=fonction");
        }
    }else{
        header("location:../admin/discussion.php?error=post");
    }
}else{
    header("location:../admin/discussion.php?error=missing");
}