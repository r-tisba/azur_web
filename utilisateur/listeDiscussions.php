<?php
require_once "../utilisateur/entete.php";
require_once "../modeles/modele.php";
$idUtilisateur = $_SESSION["idUtilisateur"];
$objetDiscussion = new Discussion($idUtilisateur);
$objetUtilisateur = new Utilisateur($idUtilisateur);
$objetMessage = new Message();
$service = new Service();
$discussions = $objetDiscussion->recupererDiscussions();
?>

<div class="fleche_retour mb-2 ml-4">
    <a href="../utilisateur/index.php" class="retour">
        <i class="fas fa-chevron-left"></i>
        Retour
    </a>
</div>
<?php
/* GESTION DES ERREURS OU SUCCES */
if (!empty($_GET["success"]) && $_GET["success"] == "discussion") {
    ?>
    <div class="alert alert-success mt-3">L'ajout de la discussion a bien été effectué</div>
    <?php
        header("refresh:2;../utilisateur/ListeDiscussions.php");
    }
    if (!empty($_GET["error"]))
    {
        ?>
        <div class="alert alert-danger mt-2">
            <?php switch ($_GET["error"]) {
                case "missing": ?>
                    <?php echo "Veuillez indiquer un destinataire"; ?>
                    <?php break; ?>
                <?php
                case "post": ?>
                    <?php echo "Veuillez saisir un message"; ?>
                    <?php break; ?>
                <?php
                case "fonctionDiscussion": ?>
                    <?php echo "Une erreur s'est produite lors de la création de la discussion"; ?>
                    <?php break; ?>
                    <?php
                case "suppression": ?>
                    <?php echo "Une erreur s'est produite lors de la suppression de la discussion"; ?>
                    <?php break; ?>
                    <?php
                case "suppressionMessage": ?>
                    <?php echo "Une erreur s'est produite lors de la suppression des messages de la discussion"; ?>
                    <?php break; ?>
                <?php
            }
            ?>
        </div>
        <?php
    }
    ?>

<div class="text-center mt-3">
    <h1 class="titreCentrePetit">Démarrer une nouvelle discussion : </h1>
</div>
<div class="container">
<!-- ------------------------- HAMBURGER NOUVELLE DISCUSSION ------------------------- -->
<div class="nouvelleDiscussion">
<div class="row">
    <div class="col-md-12 mb-3">
        <div class="card cardHamburger">
            <div class="card-body">
                <nav class="navbar navbarHamburger">
                    <h1 class="navbar-brand titreSection_hamburger">Saisie du destinataire et du message</h1>
                    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent11" aria-controls="navbarSupportedContent11" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon hamburger_icon"></span>
                    </button>
                    <div class="navbar-collapse collapse" id="navbarSupportedContent11">
                    <!-- ------------------------- SELECT DESTINATAIRE ------------------------- -->
                        <form method="post" action="../traitements/ajoutDiscussion.php">
                            <div class="form-group">
                            <label for="idDestinataire">Envoi d'un message à : </label>
                            <select name="idDestinataire" id="idDestinataire" class="form-control">
                                <?php
                                $utilisateurs = $objetUtilisateur->recupererUtilisateurs();
                                foreach($utilisateurs as $utilisateur)
                                {
                                    /* Verif pour éviter qu'on s'envoie un message à soi-même */
                                    if($utilisateur["identifiant"] == $_SESSION["identifiant"])
                                    {
                                        continue;
                                    } else {
                                        ?>
                                            <option value="<?=$utilisateur["idUtilisateur"];?>">
                                                <?=$utilisateur["identifiant"] . " | " . $utilisateur["poste"];?>
                                            </option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                            </div>
                        <!-- ------------------------- INPUT MESSAGE ------------------------- -->
                            <div class="form-group">
                                <label for="idUtilisateur">Contenu du message : </label>
                                <textarea class="form-control" name="contenu" id="contenu" placeholder="Saisissez votre message " rows="6"></textarea>
                            </div>

                            <div class="form-group text-center mb-1">
                                <button type="submit" class="btn btn-outline-primary">Envoyer</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>

<h1 class="titreCentrePetit mb-3"> Liste des discussions en cours : </h1>
<ul class="list-group">
<div class="container-fluid">
<div class="row">
<?php
/* ------------------------- AFFICHAGE DES DISCUSSIONS EN COURS ------------------------- */
foreach($discussions as $discussion)
{
    /* ------------ Si l'utilisateur de la session a initié la discussion ------------ */
    if($discussion["idEnvoyeur"] == $idUtilisateur)
    {
        $idContact = $discussion["idDestinataire"];
        $utilisateur = $objetUtilisateur->recupererUtilisateur($idUtilisateur);
        $contact = $objetUtilisateur->recupererUtilisateur($idContact);
        $dernierMessage = $objetMessage->recupererDernierMessage($discussion["idDiscussion"]);
        ?>
        <div class="container-fluid">
        <div class="row">
        <div class="col-md-12">
        <div class="card mb-4" style="border: none;">
        <div class="card-header text-white bg-dark">
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
                    <?php if($contact["role"]=="Admin" || $contact["role"]=="SuperAdmin") { ?> <a style="color:blue;"> <?=$contact["prenom"] . " " . $contact["nom"];?></a>
                    <?php } if($contact["role"]=="Utilisateur"){?><a><?=$contact["prenom"] . " " . $contact["nom"];?></a><?php } ?>
                    <div class="text-muted small">Dernière activité : <?=$service->dateFrAvecHeure($dernierMessage["max_date"]);?></div>
                </div>
                <!-- Top right -->
                <a href="../traitements/supprimerDiscussion.php?idDiscussion=<?=$discussion["idDiscussion"];?>" class="icone_poubelle" onclick="return confirm('Êtes-vous sûr de vouloir supprimer la discussion ? Tous les messages seront également supprimés')">
                <i class="far fa-trash-alt"></i>
                </a>
            </div>
        </div>
        <!--
        <a href="discussion.php?id=<?=$discussion["idDiscussion"];?>" class="card_discussion">
                    -->
        <div class="card-body px-2 py-1 background_black">
            <p>
                <i class="text-white">Dernier message : </i>
                <?= $service->afficherMessage($discussion["idDiscussion"]); ?>
            </p>
        </div>
        </a>
        </div>
        </div>
        </div>
        </div>
        <?php

    /* ------------ Si l'utilisateur de la session n'a pas initié la discussion ------------ */
    } else if ($discussion["idDestinataire"] == $idUtilisateur)
    {
        $idContact = $discussion["idEnvoyeur"];
        $utilisateur = $objetUtilisateur->recupererUtilisateur($idUtilisateur);
        $contact = $objetUtilisateur->recupererUtilisateur($idContact);
        $dernierMessage = $objetMessage->recupererDernierMessage($discussion["idDiscussion"]);
        ?>
        <div class="container-fluid">
        <div class="row">
        <div class="col-md-12">
        <div class="card mb-4" style="border: none;">
        <div class="card-header text-white bg-dark">
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
                    <?php if($contact["role"]=="Admin" || $contact["role"]=="SuperAdmin") { ?> <a style="color:rgb(0,157,236);"> <?=$contact["prenom"] . " " . $contact["nom"];?></a>
                    <?php } if($contact["role"]=="Utilisateur"){?><a><?=$contact["prenom"] . " " . $contact["nom"];?></a><?php } ?>
                    <div class="text-muted small">Dernière activité : <?=$service->dateFrAvecHeure($dernierMessage["max_date"]);?></div>
                </div>
                <!-- Top right -->
                <a href="../traitements/supprimerDiscussion.php?idDiscussion=<?=$discussion["idDiscussion"];?>" class="icone_poubelle" onclick="return confirm('Êtes-vous sûr de vouloir supprimer la discussion ? Tous les messages seront également supprimés')">
                    <i class="far fa-trash-alt"></i>
                </a>
            </div>
        </div>
        <!--
        <a href="discussion.php?id=<?=$discussion["idDiscussion"];?>" class="card_discussion">
                -->
        <div class="card-body px-2 py-1 background_black">
            <p>
                <i class="text-white">Dernier message : </i>
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
</div>
</div>

<?php
require_once "../utilisateur/pied.php";