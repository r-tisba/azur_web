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
    if($discussion["idEnvoyeur"] == $idEmploye)
    {
        $idContact = $discussion["idDestinataire"];
        $idContact = 1;
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
                <? } else { ?>
                    <img src="../images/avatar/avatarUtilisateur2.png" class="d-block ui-w-25 rounded-circle avatar">
                    <?php } ?>
            </div>

            <div class="media-body ml-3">
                Conversation avec :
                <?php if($contact["idRole"]==2) { ?> <a style="color:blue;"> <?=$contact["prenom"] . " " . $contact["nom"];?></a>
                <?php } if($contact["idRole"]==1){?><a><?=$contact["prenom"] . " " . $contact["nom"];?></a><?php } ?>
                <div class="text-muted small">Dernière activité : <?=$service->dateFr($dernierMessage["MAX(date)"]);?></div>
            </div>
            <!-- Top right -->
            <a href="../traitements/supprimerDiscussion.php" class="icone_poubelle">
            <i class="far fa-trash-alt"></i>
            </a>
        </div>
        </div>
        <a href="discussion.php?id=<?=$discussion["idDiscussion"];?>" class="card_discussion">
            <div class="card-body">
                <p>
                    <i>Dernier message : </i>
                    <?=$dernierMessage["contenu"];?>
                </p>
            </div>
        </a>
            <!-- <div class="card-footer d-flex flex-wrap justify-content-between align-items-center px-0 pt-0 pb-3">
                <div class="">
                    <a href="discussion.php?id=<?=$discussion["idDiscussion"];?>" class="btn btn-outline-primary p-2 bouton_discussion" id="bouton">Accéder à la discussion</a>
                    <a href="supprimerDiscussion.php?id=<?=$discussion["idDiscussion"];?>" class="btn btn-outline-danger p-2 bouton_discussion" id="bouton">Supprimer la discussion</a>
                </div>
            </div> -->
        </div>
        </div>
        </div>
        </div>
        <?php
    } else if ($discussion["idReceveur"] == $idEmploye)
    {



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