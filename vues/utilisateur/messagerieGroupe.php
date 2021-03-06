<?php
require_once "entete.php";
$service = new Service();
$objetEquipe = new Equipe();

if (!empty($_GET["id"])) {
    $idEquipe = $_GET["id"];
} else {
    ?>
    <div class="containerFil mt-2">
        <div class="alert alert-danger mt-2">Erreur lors de la récupération de la disscussion de l'équipe</div>
    </div>
    <?php
    $service->redirectOneSec("../utilisateur/listeEquipes.php");
}

$idUtilisateur = $_SESSION["idUtilisateur"];
$idEquipe = $_GET["id"];

// Vérification de si l'utilisateur a bien accès à cet page
if($objetEquipe->verifierPresenceUtilisateurEquipe($idUtilisateur, $idEquipe) != true) { $service->redirectNow("../utilisateur/listeEquipes.php"); }

$objetUtilisateur = new Utilisateur();
$objetMessageGroupe = new MessageGroupe($idEquipe);
$messages = $objetMessageGroupe->getMessages();
$nomGroupe = $messages[0]["nomEquipe"];
$verification = false;

// Vérification de si l'utilisateur a bien accès à cet page
foreach($messages as $message) { $message["idUtilisateur"] == $idUtilisateur ? $verification = true : ''; }
if($verification == false) { $service->redirectNow("../utilisateur/listeEquipes.php"); }
?>
<div class="fleche_retour mb-2 ml-4">
    <a href="../utilisateur/equipe.php?id=<?= $idEquipe ?>" class="retour">
        <i class="fas fa-chevron-left"></i>
        Retour
    </a>
</div>

<div class="containerFil mt-2">
    <?php

    /* GESTION DES ERREURS OU SUCCES */
    if (!empty($_GET["success"]) && $_GET["success"] == "suppression") {
    ?>
        <div class="alert alert-success mt-3">La supression a bien été effectué</div>
    <?php
        $service->redirectOneSec("../utilisateur/messagerieGroupe.php?id=$idEquipe");
    } else if (!empty($_GET["success"]) && $_GET["success"] == "modification") {
    ?>
        <div class="alert alert-success mt-3">La modification a bien été effectué</div>
    <?php
        $service->redirectOneSec("../utilisateur/messagerieGroupe.php?id=$idEquipe");
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
                    <?php echo "Une erreur s'est produite lors de l'envoi du formulaire vérifier que votre message ne soit pas vide"; ?>
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
    <div class="card cardDiscussion">
        <div class="card-header headerDiscussion">
            <h1 class="titreDiscussion"><?= $nomGroupe; ?> </h1>
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
                            <img src="../<?= $message["avatar"]; ?>" class="d-block ui-w-40 rounded-circle avatar">
                        </div>
                        <div class="media-body ml-3">
                            <a><?= $message["prenom"]; ?></a>
                            <a><?= $message["nom"]; ?></a>

                            <div class="text-muted small"><?= $service->dateFrAvecHeure($date); ?></div>
                        </div>
                        <?php if ($message["idUtilisateur"] == $_SESSION["idUtilisateur"]) { ?>
                            <a href="../../traitements/modificationMessageGroupe.php?idMessage=<?= $message["idMessageGroupe"]; ?>" class="icone_edit mr-2">
                                <i class="far fa-edit"></i>
                            </a>
                            <a href="../../traitements/supprimerMessageGroupe.php?idMessage=<?= $message["idMessageGroupe"]; ?>&idEquipe=<?= $message["idEquipe"]; ?>" class="icone_poubelle">
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
    <?php if ($message["idUtilisateur"] != $_SESSION["idUtilisateur"]) { ?> <div class="col-3 col-md-4"></div> <?php } ?>
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
    <form method="post" action="../../traitements/ajoutMessageGroupe.php?id=<?= $idEquipe; ?>">
        <div class="form-group">
            <textarea class="form-control dark" name="contenu" id="contenu" placeholder="Envoyer un message au groupe <?= $nomGroupe; ?>" rows="6"></textarea>
        </div>

        <div class="form-group text-center">
            <button type="submit" class="btn btn-outline-primary">Poster le message</button>
        </div>
    </form>
</div>
<?php
require_once "pied.php";
