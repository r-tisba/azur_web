<?php
require_once "../utilisateur/entete.php";
$idUtilisateur = $_SESSION["idUtilisateur"];
$objetDiscussion = new Discussion($idUtilisateur);
$objetUtilisateur = new Utilisateur($idUtilisateur);
$objetMessage = new Message();
$service = new Service();
$discussions = $objetDiscussion->getDiscussions();

// PAGINATION
empty($_GET['page']) ? $page = 1 : $page = intval($_GET['page']);
$discussionsParPage = 5;
$nbDiscussionsTotal = count($discussions);
$nbPages = ceil($nbDiscussionsTotal / $discussionsParPage);
if ($page > $nbPages) {
    $page = $nbPages;
}
if ($page < 1) {
    $page = 1;
}
// Calcule la position du 1er éléments à afficher sur la page
$offset = ($page - 1) * $discussionsParPage;
// Récupère les éléments du tableau qui seront affichés sur la page
$discussions = array_slice($discussions, $offset, $discussionsParPage);
$page_first = $page > 1 ? 1 : '';
$page_prev  = $page > 1 ? $page - 1 : '';
$page_next  = $page < $nbPages ? $page + 1 : '';
$page_last  = $page < $nbPages ? $nbPages : '';
?>

<div class="fleche_retour mb-2 ml-4">
    <a href="../utilisateur/index.php" class="retour">
        <i class="fas fa-chevron-left"></i>
        Retour
    </a>
</div>
<?php
if (!empty($_GET['select'])) {
    $idUtilisateurGet = $_GET['select'];
}
?>

<div class="container">
    <?php
    /* GESTION DES ERREURS OU SUCCES */
    if (!empty($_GET["success"]) && $_GET["success"] == "discussion") { ?>
        <div class="alert alert-success mt-3">L'ajout de la discussion a bien été effectué</div>
    <?php
        $service->redirectOneSec("../utilisateur/listeDiscussions.php");
    } else if (!empty($_GET["success"]) && $_GET["success"] == "suppression") { ?>
        <div class="alert alert-success mt-3">La discussion a bien été supprimé</div>
    <?php
        $service->redirectOneSec("../utilisateur/listeDiscussions.php");
    }
    if (!empty($_GET["error"])) {
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
    <!-- ------------------------- HAMBURGER NOUVELLE DISCUSSION ------------------------- -->
    <div class="row">
        <div class="col-md-12 mb-3">
            <div class="card cardHamburger">
                <div class="card-body">
                    <nav class="navbar navbarHamburger">
                        <h1 class="navbar-brand titreSection_hamburger">Saisie du destinataire et du message</h1>
                        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent11" aria-controls="navbarSupportedContent11" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon hamburger_icon"></span>
                        </button>
                        <div class="navbar-collapse <?= !empty($_GET['form']) ? "" : "collapse"; ?>" id="navbarSupportedContent11">
                            <!-- ------------------------- SELECT DESTINATAIRE ------------------------- -->
                            <form method="post" action="../../traitements/ajoutDiscussion.php">
                                <div class="form-group">
                                    <label for="idDestinataire">Envoi d'un message à : </label>
                                    <select name="idDestinataire" id="idDestinataire" class="form-control selectpicker" data-live-search="true">
                                        <optgroup label="Utilisateurs :" class="blanc">
                                            <?php
                                            $utilisateurs = $objetUtilisateur->recupererUtilisateurs();
                                            foreach ($utilisateurs as $utilisateur) {
                                                /* Verif pour éviter qu'on s'envoie un message à soi-même */
                                                if ($utilisateur["identifiant"] == $_SESSION["identifiant"]) {
                                                    continue;
                                                } else {
                                            ?>
                                                    <option value="<?= $utilisateur["idUtilisateur"]; ?>" <?= !empty($_GET['select']) && $utilisateur["idUtilisateur"] == $idUtilisateurGet ? "selected = 'selected'" : ""; ?>>
                                                        <?= $utilisateur["identifiant"] . " | " . $utilisateur["poste"]; ?>
                                                    </option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </optgroup>
                                    </select>
                                </div>
                                <!-- ------------------------- INPUT MESSAGE ------------------------- -->
                                <div class="form-group">
                                    <label for="idUtilisateur">Contenu du message : </label>
                                    <textarea class="form-control dark" name="contenu" id="contenu" placeholder="Saisissez votre message " rows="6"></textarea>
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

    <h1 class="titreCentrePetit mb-3"> Liste des discussions en cours : </h1>
    <ul class="list-group">
        <div class="container-fluid">
            <div class="row_discussions">
                <?php
                $resultat = $objetDiscussion->recupererNbDiscussions($idUtilisateur);
                $nbDiscussions = $resultat['nb_discussions'];
                // On détermine le nombre d'articles par page
                $parPage = 10;
                // On calcule le nombre de pages total
                $pages = ceil($nbDiscussions / $parPage);

                /* ------------------------- AFFICHAGE DES DISCUSSIONS EN COURS ------------------------- */
                foreach ($discussions as $discussion) {
                    $idContact = $discussion["idDestinataire"];
                    $discussion['idEnvoyeur'] == $idUtilisateur ? $idContact = $discussion["idDestinataire"] : $idContact = $discussion["idEnvoyeur"];
                    $objetContact = new Utilisateur($idContact);
                    $avatarContact = $objetContact->getAvatar();
                    $roleContact = $objetContact->getRole();
                    $prenomContact = $objetContact->getPrenom();
                    $nomContact = $objetContact->getNom();
                    $dernierMessage = $objetMessage->recupererDernierMessage($discussion["idDiscussion"]);
                    ?>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card mb-4" style="border: none;">
                                    <div class="card-header text-white bg-dark">
                                        <div class="media flex-wrap w-100 align-items-center">
                                            <div class="rondAvatar">
                                                <?php if (!empty($avatarContact)) { ?>
                                                    <img src="../<?= $avatarContact; ?>" class="d-block ui-w-40 rounded-circle avatar">
                                                <?php } else { ?>
                                                    <img src="../../images/avatar/avatarUtilisateur2.png" class="d-block ui-w-25 rounded-circle avatar">
                                                <?php } ?>
                                            </div>

                                            <div class="media-body ml-3">
                                                Conversation avec :
                                                <?php if ($roleContact == "Admin" || $roleContact == "SuperAdmin") { ?> <a style="color:rgb(0,157,236);"> <?= $prenomContact . " " . $nomContact; ?></a>
                                                <?php }
                                                if ($roleContact == "Utilisateur") { ?><a><?= $prenomContact . " " . $nomContact; ?></a><?php } ?>
                                                <div class="text-muted small">Dernière activité : <?= $service->dateFrAvecHeure($dernierMessage["max_date"]); ?></div>
                                            </div>
                                            <!-- Top right -->
                                            <a href="../../traitements/supprimerDiscussion.php?idDiscussion=<?= $discussion["idDiscussion"]; ?>" class="icone_poubelle" onclick="return confirm('Êtes-vous sûr de vouloir supprimer la discussion ? Tous les messages seront également supprimés')">
                                                <i class="far fa-trash-alt"></i>
                                            </a>
                                        </div>
                                    </div>
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
                }
                if ($nbPages > 0) {
                ?>
                    <div class="div_pagination">
                        <div class="apercu_pagination mb-2">
                            <a href="listeDiscussions?page=<?php echo $page_first; ?>">« Premier</a>
                            <a href="listeDiscussions?page=<?php echo $page_prev; ?>">Précédant</a>
                            <a href="listeDiscussions?page=<?php echo $page_next; ?>">Suivant</a>
                            <a href="listeDiscussions?page=<?php echo $page_last; ?>">Dernier »</a>
                        </div>
                        <div class="">Page <?= $page; ?> sur <?= $nbPages; ?></div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </ul>
</div>
</div>
</div>
<script>
    $(function() {
        $('select').selectpicker();
    });
</script>
<?php
require_once "../utilisateur/pied.php";
