<?php
require_once "entete.php";
require_once "../modeles/modele.php";
$idEmploye = $_SESSION["idUtilisateur"];
$objetDiscussion = new Discussion($idEmploye);
$objetUtilisateur = new Utilisateur($idEmploye);
$objetMessage = new Message();
$service = new Service();
$discussions = $objetDiscussion->recupererDiscussions();
?>

<h1> Liste des discussions en cours : </h1>
<ul class="list-group">
<div class="container-fluid">
<div class="row">
<?php
foreach($discussions as $discussion)
{
    /* Si l'utilisateur de la session a initié la discussion */
    if($discussion["idEnvoyeur"] == $idEmploye)
    {
        $idContact = $discussion["idDestinataire"];
        $utilisateur = $objetUtilisateur->recupererUtilisateur($idEmploye);
        $contact = $objetUtilisateur->recupererUtilisateur($idContact);

        $dernierMessage = $objetMessage->recupererDernierMessage($discussion["idDiscussion"]);
        ?>
        <div class="container-fluid mt-100">
        <div class="row">
        <div class="col-md-12">
        <div class="card mb-4">
        <div class="card-header">
        <div class="media flex-wrap w-100 align-items-center">
            <div class="rondAvatar">
                <?php if(!empty($contact["avatar"])) { ?>
                    <img src="<?=$contact["avatar"];?>" class="d-block ui-w-40 rounded-circle avatar">
                <?php } else { ?>
                    <img src="../images/avatar/avatarUtilisateur2.png" class="d-block ui-w-25 rounded-circle avatar">
                    <?php } ?>
            </div>

            <div class="media-body ml-3">
                Conversation avec :
                <?php if($contact["idRole"]==2) { ?> <a style="color:blue;"> <?=$contact["prenom"] . " " . $contact["nom"];?></a>
                <?php } if($contact["idRole"]==1){?><a><?=$contact["prenom"] . " " . $contact["nom"];?></a><?php } ?>
                <div class="text-muted small">Dernière activité : <?=$service->dateFr($dernierMessage["max_date"]);?></div>
            </div>
            <!-- Top right -->
            <a href="../traitements/supprimerDiscussion.php" class="icone_poubelle">
            <i class="far fa-trash-alt"></i>
            </a>
        </div>
        </div>
        <a href="discussion.php?id=<?=$discussion["idDiscussion"];?>" class="card_discussion">
            <div class="card-body px-2 py-1">
                <p>
                    <i>Dernier message : </i>
                    <?= $service->afficherMessage($discussion["idDiscussion"]); ?>
                </p>
            </div>
        </a>
        </div>
        </div>
        </div>
        </div>
        <?php

    /* Si l'utilisateur de la session n'a pas initié la discussion */
    } else if ($discussion["idDestinataire"] == $idEmploye)
    {
        $idContact = $discussion["idEnvoyeur"];
        $utilisateur = $objetUtilisateur->recupererUtilisateur($idEmploye);
        $contact = $objetUtilisateur->recupererUtilisateur($idContact);

        $dernierMessage = $objetMessage->recupererDernierMessage($discussion["idDiscussion"]);

        ?>

        <div class="container-fluid mt-100">
        <div class="row">
        <div class="col-md-12">
        <div class="card mb-4">
        <div class="card-header">
        <div class="media flex-wrap w-100 align-items-center">
            <div class="rondAvatar">
            <?php if(!empty($contact["avatar"])) { ?>
                    <img src="<?=$contact["avatar"];?>" class="d-block ui-w-40 rounded-circle avatar">
                <?php } else { ?>
                    <img src="../images/avatar/avatarUtilisateur2.png" class="d-block ui-w-25 rounded-circle avatar">
                    <?php } ?>
            </div>

            <div class="media-body ml-3">
                Conversation avec :
                <?php if($contact["idRole"]==2) { ?> <a style="color:blue;"> <?=$contact["prenom"] . " " . $contact["nom"];?></a>
                <?php } if($contact["idRole"]==1){?><a><?=$contact["prenom"] . " " . $contact["nom"];?></a><?php } ?>
                <div class="text-muted small">Dernière activité : <?=$service->dateFr($dernierMessage["max_date"]);?></div>
            </div>
            <!-- Top right -->
            <a href="../traitements/supprimerDiscussion.php" class="icone_poubelle">
            <i class="far fa-trash-alt"></i>
            </a>
        </div>
        </div>
        <a href="discussion.php?id=<?=$discussion["idDiscussion"];?>" class="card_discussion">
        <div class="card-body px-2 py-1">
            <p>
                <i>Dernier message : </i>
                <?= $service->afficherMessage($discussion["idDiscussion"]); ?>
            </p>
        </div>
        </div>
        </div>
        </div>
        </div>
        <?php
    } else {

    }

    }
    ?>
</div>
</div>
</ul>
</div>

<?php
require_once "pied.php";