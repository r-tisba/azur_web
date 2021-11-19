<?php
require_once "../modeles/modele.php";
require_once "../utilisateur/entete.php";

if (!isset($_SESSION["idUtilisateur"])) {
    header("location:../visiteur/index.php");
}
if (!empty($_GET["idMessage"])) {
    $idMessage = $_GET["idMessage"];
}

$service = new Service();
$objetMessage = new Message_Groupe();
$message = $objetMessage->recupererMessage($idMessage);
$idEquipe = $objetMessage->recupereridEquipeViaMessage($idMessage);
$idEquipe = $idEquipe["idEquipe"];
$date = $message["date"];

if (!empty($_POST["inputModifMessage"])) {
    $contenu = $_POST["inputModifMessage"];
    $objetMessage->modifierMessage($contenu, $idMessage);
?>
        <div class="alert alert-success mt-2">Message modifié</div>
<?php
    header("refresh:1;../utilisateur/messagerieGroupe.php?id=$idEquipe");
} else {
?>

    <div class="mb-4 fleche_retour">
        <a href="../utilisateur/messagerieGroupe.php?id=<?= $idEquipe ?>" class="retour">
            <i class="fas fa-chevron-left"></i>
            Retour
        </a>
    </div>

    <h1 class="titreCentre">Modification du message : </h1>
    <div class="container-fluid mt-100">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4 cardMessage_perso">
                    <div class="card-header">
                        <div class="media flex-wrap w-100 align-items-center">
                            <div class="avatar">
                                <img src="<?= $message["avatar"]; ?>" class="d-block ui-w-40 rounded-circle avatar">
                            </div>
                            <div class="media-body ml-3">
                                <a><?= $message["prenom"]; ?></a>
                                <a><?= $message["nom"]; ?></a>

                                <div class="text-muted small"><?= $service->dateFrAvecHeure($date); ?></div>
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