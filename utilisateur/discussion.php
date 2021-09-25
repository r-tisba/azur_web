<?php
require_once "entete.php";
require_once "../modeles/modele.php";

$idDiscussion=$_GET["id"];
$idEmploye=$_SESSION["idUtilisateur"];
$objetMessage = new Message();
$service = new Service();
$messages=$objetMessage->recupererMessages($idDiscussion);

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
</div>
</div>
    <div class="card-body">

        <p>
        <?=$message["contenu"];?>
        </p>

    </div>
    <div class="card-footer d-flex flex-wrap justify-content-between align-items-center px-0 pt-0 pb-3">
        <div class="px-4 pt-3"> <!--gauche--></div>
        <div class="px-4 pt-3">
            <?php
            if($message["idEmploye"]==$idEmploye)
            {
            ?>
            <a href="modifierMessage.php?id=<?=$message["idMessage"];?>" class="btn btn-outline-primary p-2" id="bouton">Modifier</a>
            <a href="suppMessage.php?id=<?=$message["idMessage"];?>" class="btn btn-outline-danger p-2" id="bouton">Supprimer</a>
            <?php
            }
            ?>
        </div>
    </div>

</div>
</div>
</div>
</div>

<?php
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
            <?php echo "Une erreur s'est produite lors de l'envoie du formulaire vérifier que votres message ne soit pas vide"; ?>
            <?php break;?>
        <?php case "fonction": ?>
            <?php echo "Une erreur s'est produite lors de l'envoie du  message"; ?>
        <?php break;?>
 <?php
}
?>
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