<?php
require_once "../utilisateur/entete.php";
require_once "../modeles/modele.php";
$utilisateur= new Utilisateur($_SESSION["idUtilisateur"]);

if(empty($_SESSION["identifiant"]))
{
    header("location:index.php");
}

?>

<div class="container-fluid">
<div class="card card-white">
<div class="card-body">

    <div class="show-image">
        <img src="<?=$utilisateur->getAvatar();?>" class="rounded-circle avatarProfil">
        <a href="../utilisateur/modifierAvatar.php">
            <input class="btn btn-outline-primary" type="button" value="Changer avatar">
        </a>
    </div>

    <div class="form-group" >
        <h3><b>Identifiant :</b> <?=$utilisateur->getIdentifiant();?></h3>
        <div class="float-right mt-1" >
        <a href="../admin/modifierPseudo.php" type="submit" class="btn btn-outline-primary" >Modifier Pseudo</a>
        </div>
    </div>

    <hr>
    <div class="form-group" >
        <h3><b>Email :</b> <?=$utilisateur->getidEquipe();?></h3>
        <div class="float-right mb-4">
        <a href="modifierEmail.php" type="submit" class="btn btn-outline-primary">Modifier email</a>
        </div>
    </div>
    <hr>
    <div class="form-group" >
        <h3><b>Mot De Passe :</b> </h3>
        <div class="float-right mb-4">
        <a href="questionSecrete.php" type="submit" class="btn btn-outline-primary">Modifier mot de passe</a>
        </div>
    </div>

</div>
</div>
</div>