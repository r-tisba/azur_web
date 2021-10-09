<?php
require_once "../utilisateur/entete.php";
require_once "../modeles/modele.php";

if (!isset($_SESSION["idUtilisateur"])) {
    header("location:../visiteur/index.php");
}
if (!empty($_GET["idMessage"])) {
    $idMessage = $_GET["idMessage"];
}

$service = new Service();
$objetMessage = new Message();
$message = $objetMessage->recupererMessage($idMessage);
$idDiscussion = $objetMessage->recupererIdDiscussionViaMessage($idMessage);
$idDiscussion = $idDiscussion["idDiscussion"];
$date = $message["date"];

if (!empty($_POST["inputModifMessage"])) {
    $contenu = $_POST["inputModifMessage"];
    $objetMessage->modifierMessage($contenu, $idMessage);
?>
<?php
    header("refresh:1;../utilisateur/discussion.php?id=$idDiscussion");
} else {
?>

    <div class="mb-4 fleche_retour">
        <a href="../utilisateur/discussion.php?id=<?= $idDiscussion ?>" class="retour">
            <i class="fas fa-chevron-left"></i>
            Retour
        </a>
    </div>

    <h1 class="titreCentre">Modification du message : </h1>
    <div class="container-fluid mt-100">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="media flex-wrap w-100 align-items-center">
                            <div class="avatar">
                                <img src="<?= $message["avatar"]; ?>" class="d-block ui-w-40 rounded-circle avatar">
                            </div>
                            <div class="media-body ml-3">
                                <a><?= $message["prenom"]; ?></a>
                                <a><?= $message["nom"]; ?></a>

                                <div class="text-muted small"><?= $service->dateFr($date); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <div class="form-group">
                                <textarea class="form-control" name="inputModifMessage" id="inputModifMessage" placeholder="Saisissez le message" rows="1"><?php echo $service->gererGuillemets($message["contenu"]); ?></textarea>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-outline-primary">Modifier le message</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}
require_once "../utilisateur/pied.php";
?>