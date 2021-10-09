<?php
require_once "entete.php";
require_once "../modeles/modele.php";

$idDiscussion=$_GET["id"];
$idEmploye=$_SESSION["idUtilisateur"];
$objetMessage = new Message();
$service = new Service();
$messages=$objetMessage->recupererMessages($idDiscussion);

?>
<div class="mb-4 fleche_retour">
    <a href="../utilisateur/listeDiscussions.php" class="retour">
        <i class="fas fa-chevron-left"></i>
        Retour
    </a>
</div>
<?php

if(!empty($_GET["success"]) && $_GET["success"] == "suppression")
{
    ?>
    <div class="alert alert-success mt-3">La supression a bien été effectué</div>
        <?php
        header("refresh:2;../utilisateur/discussion.php?id=$idDiscussion");
} else if(!empty($_GET["success"]) && $_GET["success"] == "modification")
{
    ?>
    <div class="alert alert-success mt-3">La modification a bien été effectué</div>
        <?php
        header("refresh:2;../utilisateur/discussion.php?id=$idDiscussion");
}
if (!empty($_GET["error"]))
{
    ?>
    <div class="alert alert-danger mt-2">
    <?php switch($_GET["error"])
{        case "missing": ?>
            <?php echo "Au moins un des champs est vide"; ?>
            <?php break;?>
        <?php case "post": ?>
            <?php echo "Une erreur s'est produite lors de l'envoie du formulaire vérifier que votre message ne soit pas vide"; ?>
            <?php break;?>
        <?php case "fonction": ?>
            <?php echo "Une erreur s'est produite lors de l'envoi du message"; ?>
            <?php break;?>
        <?php case "modification": ?>
            <?php echo "Une erreur s'est produite lors de la modification du message"; ?>
            <?php break;?>
        <?php case "suppression": ?>
            <?php echo "Une erreur s'est produite lors de la suppression"; ?>
            <?php break;?>
        <?php case "idMessage": ?>
            <?php echo "Une erreur s'est produite lors de la récupération de l'idMessage"; ?>
            <?php break;?>
 <?php
}
?>
    </div>
<?php
}

foreach($messages as $message)
{
    $date = $message["date"];
?>
<div class="container-fluid mt-100">
<div class="row">
<div class="col-md-12">
<div class="card mb-4">
<div class="card-header">
    <div class="media flex-wrap w-100 align-items-center">
        <div class="avatar">
            <img src="<?=$message["avatar"];?>" class="d-block ui-w-40 rounded-circle avatar">
        </div>
        <div class="media-body ml-3">
        <a><?=$message["prenom"];?></a>
        <a><?=$message["nom"];?></a>

        <div class="text-muted small"><?=$service->dateFr($date);?></div>
        </div>
        <?php if($message["idEmploye"] == $_SESSION["idUtilisateur"])
        { ?>
            <a href="../traitements/modificationMessage.php?idMessage=<?=$message["idMessage"];?>" class="icone_edit mr-2">
                <i class="far fa-edit"></i>
                </a>
            <a href="../traitements/supprimerMessage.php?idMessage=<?=$message["idMessage"];?>&idDiscussion=<?=$message["idDiscussion"];?>" class="icone_poubelle">
                <i class="far fa-trash-alt"></i>
            </a>
        <?php } ?>
    </div>
</div>
    <div class="card-body">
        <p>
        <?=$message["contenu"];?>
        </p>
    </div>
</div>
</div>
</div>
</div>
<?php
}
?>
<form method="post" action= "../traitements/ajoutMessage.php?id=<?=$idDiscussion;?>">
    <div class="form-group">
        <label for="contenu">Contenu :</label>
        <textarea class="form-control" name="contenu" id="contenu" placeholder="Saisissez le message" rows="6"></textarea>
    </div>

    <div class="form-group text-center">
        <button type="submit" class="btn btn-outline-primary">Poster le message</button>
    </div>
    </form>
<?php
require_once "pied.php";