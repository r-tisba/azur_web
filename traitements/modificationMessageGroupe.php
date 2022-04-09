<?php
require_once "../vues/utilisateur/entete.php";

if (!isset($_SESSION["idUtilisateur"])) {
    $service->redirectNow("../visiteur/index.php");
}
if (!empty($_GET["idMessage"])) {
    $idMessage = $_GET["idMessage"];
}

$idUtilisateur = $_SESSION['idUtilisateur'];
$service = new Service();
$objetMessage = new MessageGroupe();
$message = $objetMessage->recupererMessage($idMessage);

// Vérification de l'auteur du message à modifier
$idEquipe = $objetMessage->recupereridEquipeViaMessage($idMessage);
$idEquipe = $idEquipe["idEquipe"];
if($message['idUtilisateur'] != $idUtilisateur) { $service->redirectNow("../vues/utilisateur/messagerieGroupe.php?id=$idEquipe"); }
$date = $message["date"];

?>
<div class="container">
<?php

if (!empty($_POST["inputModifMessage"])) {
    $contenu = $_POST["inputModifMessage"];
    $objetMessage->modifierMessage(htmlspecialchars($contenu), $idMessage);
?>
        <div class="alert alert-success mt-2">Message modifié</div>
<?php
    $service->redirectOneSec("../vues/utilisateur/messagerieGroupe.php?id=$idEquipe");
} else {
?>

    <div class="mb-4 fleche_retour">
        <a href="../vues/utilisateur/messagerieGroupe.php?id=<?= $idEquipe ?>" class="retour">
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
                    <div class="card-body p-2 pl-3">
                        <form method="post">
                            <div class="form-group">
                                <textarea class="form-control dark" name="inputModifMessage" id="inputModifMessage" placeholder="Saisissez le message" rows="1"><?php echo $service->gererGuillemets($message["contenu"]); ?></textarea>
                            </div>
                            <div class="form-group text-center m-0">
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
require_once "../vues/utilisateur/pied.php";
?>