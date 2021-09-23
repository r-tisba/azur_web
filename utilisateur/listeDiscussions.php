<?php
require_once "entete.php";
require_once "../modeles/modele.php";
print_r($_SESSION);
$objetDiscussion = new Discussion($_SESSION["idUtilisateur"]);
$discussions = $objetDiscussion->recupererDiscussions();
$idEmploye = $_SESSION["idEmploye"];
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
        $utilisateur = recupererUtilisateur($idEmploye);
        $contact = recupererUtilisateur($idContact);
        printf($contact);

        $dernierMessage = recupererDernierMessage($discussion["idDiscussion"]);

        ?>

        <div class="container-fluid mt-100">
        <div class="row">
        <div class="col-md-12">
        <div class="card mb-4">
        <div class="card-header">
        <div class="media flex-wrap w-100 align-items-center">
            <div class="rondAvatar">
                <img src="<?=$contact["avatar"];?>" class="d-block ui-w-40 rounded-circle avatar">
            </div>

            <div class="media-body ml-3">
                Conversation avec :
                <?php if($contact["idRole"]==2){?> <a style="color:blue;"> <?=$contact["prenom"] . " " . $contact["nom"];?></a>
                <?php }if($contact["idRole"]==1){?><a><?=$contact["prenom"] . " " . $contact["nom"];?></a><?php } ?>

                <div class="text-muted small">Dernière activité : <?=dateFr($dernierMessage["MAX(date)"]);?></div>
            </div>
        </div>
        </div>
            <div class="card-body">

                <p>
                <i>Dernier message : </i>
                <?=$dernierMessage["contenu"];?>
                </p>

            </div>
            <div class="card-footer d-flex flex-wrap justify-content-between align-items-center px-0 pt-0 pb-3">
                <div class="px-4 pt-3"> <!--gauche--></div>
                <div class="px-4 pt-3">

                    <a href="discussion.php?id=<?=$discussion["idDiscussion"];?>" class="btn btn-outline-primary p-2" id="bouton">Accéder à la discussion</a>
                    <a href="supprimerDiscussion.php?id=<?=$discussion["idDiscussion"];?>" class="btn btn-outline-danger p-2" id="bouton">Supprimer la discussion</a>

                </div>
            </div>
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