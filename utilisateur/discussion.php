<?php
require_once "entete.php";
require_once "../modeles/modele.php";

if ($_GET["id"]) {
    $idDiscussion = $_GET["id"];
} else {
?>
    <div class="alert alert-danger mt-2">Erreur lors de la récupération de l'idDiscussion</div>
<?php
    header("refresh:2; ../utilisateur/listeDiscussions.php");
}
$idEmploye = $_SESSION["idUtilisateur"];
$objetUtilisateur = new Utilisateur();
$objetMessage = new Message();
$service = new Service();
$messages = $objetMessage->recupererMessages($idDiscussion);
$interlocuteur = $objetUtilisateur->recupererInterlocuteur($idDiscussion);

?>
<div class="fleche_retour mb-2 ml-4">
    <a href="../utilisateur/listeDiscussions.php" class="retour">
        <i class="fas fa-chevron-left"></i>
        Retour
    </a>
</div>
<?php
/* GESTION DES ERREURS OU SUCCES */
if (!empty($_GET["success"]) && $_GET["success"] == "suppression") {
?>
    <div class="alert alert-success mt-3">La supression a bien été effectué</div>
<?php
    header("refresh:2;../utilisateur/discussion.php?id=$idDiscussion");
} else if (!empty($_GET["success"]) && $_GET["success"] == "modification") {
?>
    <div class="alert alert-success mt-3">La modification a bien été effectué</div>
<?php
    header("refresh:2; ../utilisateur/discussion.php?id=$idDiscussion");
}
if (!empty($_GET["error"])) {
?>
    <div class="alert alert-danger mt-2">
        <?php switch ($_GET["error"]) {
            case "missing": ?>
                <?php echo "Au moins un des champs est vide"; ?>
                <?php break; ?>
            <?php
            case "post": ?>
                <?php echo "Une erreur s'est produite lors de l'envoie du formulaire vérifier que votre message ne soit pas vide"; ?>
                <?php break; ?>
            <?php
            case "fonction": ?>
                <?php echo "Une erreur s'est produite lors de l'envoi du message"; ?>
                <?php break; ?>
            <?php
            case "modification": ?>
                <?php echo "Une erreur s'est produite lors de la modification du message"; ?>
                <?php break; ?>
            <?php
            case "suppression": ?>
                <?php echo "Une erreur s'est produite lors de la suppression"; ?>
                <?php break; ?>
            <?php
            case "idMessage": ?>
                <?php echo "Une erreur s'est produite lors de la récupération de l'idMessage"; ?>
                <?php break; ?>
        <?php
        }
        ?>
    </div>
<?php
}
/* BLOC CONVERSATION */
?>
<div class="containerFil mt-2">
    <div class="card cardDiscussion">
        <div class="card-header headerDiscussion">
            <h1 class="titreDiscussion">En conversation avec <?= $interlocuteur; ?> </h1>
        </div>
        <div class="card-body bodyDiscussion">
            <?php
            foreach ($messages as $message) {
                $date = $message["date"];
                /* dispositionMessages() détermine l'affichage du message dans le fil selon son auteur */
                $service->dispositionMessages($message);
            ?>
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
                        <?php if ($message["idEmploye"] == $_SESSION["idUtilisateur"]) { ?>
                            <a href="../traitements/modificationMessage.php?idMessage=<?= $message["idMessage"]; ?>" class="icone_edit mr-2">
                                <i class="far fa-edit"></i>
                            </a>
                            <a href="../traitements/supprimerMessage.php?idMessage=<?= $message["idMessage"]; ?>&idDiscussion=<?= $message["idDiscussion"]; ?>" class="icone_poubelle">
                                <i class="far fa-trash-alt"></i>
                            </a>
                        <?php } ?>
                    </div>
                </div>

                <div class="card-body p-2 pl-3">
                    <p class="mb-1">
                        <?= $message["contenu"]; ?>
                    </p>
                </div>
        </div>
    </div>
    <!-- Influe sur l'affichage du message selon son auteur -->
    <?php if ($message["idEmploye"] != $_SESSION["idUtilisateur"]) { ?> <div class="col-3 col-md-4"></div> <?php } ?>
</div>
</div>
<?php
            }
?>
</div>
</div>
</div>
<div class="containerFil mt-4">
    <!-- INPUT NOUVEAU MESSAGE -->
    <form method="post" action="../traitements/ajoutMessage.php?id=<?= $idDiscussion; ?>">
        <div class="form-group">
            <textarea class="form-control" name="contenu" id="contenu" placeholder="Envoyer un message à <?= $interlocuteur; ?>" rows="6"></textarea>
        </div>

        <div class="form-group text-center">
            <button type="submit" class="btn btn-outline-primary">Poster le message</button>
        </div>
    </form>
</div>
<?php
require_once "pied.php";
