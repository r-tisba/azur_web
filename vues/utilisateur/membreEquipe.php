<?php
require_once "entete.php";
if (!isset($_GET["id"])) {
    $service->redirectNow("../visiteur/index.php");
}

$idUtilisateur = $_SESSION["idUtilisateur"];
$idEquipe = $_GET["id"];
$objetUtilisateur = new Utilisateur();
$objetDiscussion = new Discussion();
$objetEquipe = new Equipe();

// Vérification de si l'utilisateur a bien accès à cet page
if($objetEquipe->verifierPresenceUtilisateurEquipe($idUtilisateur, $idEquipe) != true) { $service->redirectNow("../utilisateur/listeEquipes.php"); }

$utilisateurs = $objetUtilisateur->recupererUtilisateursRolesCompositionViaEquipe($idEquipe);
// PAGINATION
empty($_GET['page']) ? $page = 1 : $page = intval($_GET['page']);
$utilisateurParPage = 6;
$nbUtilisateursTotal = count($utilisateurs);
$nbPages = ceil($nbUtilisateursTotal / $utilisateurParPage);
if ($page > $nbPages) { $page = $nbPages; }
if ($page < 1) { $page = 1; }
// Calcule la position du 1er éléments à afficher sur la page
$offset = ($page - 1) * $utilisateurParPage;
// Récupère les éléments du tableau qui seront affichés sur la page
$utilisateurs = array_slice($utilisateurs, $offset, $utilisateurParPage);
$page_first = $page > 1 ? 1 : '';
$page_prev  = $page > 1 ? $page-1 : '';
$page_next  = $page < $nbPages ? $page + 1 : '';
$page_last  = $page < $nbPages ? $nbPages : '';
?>

<div class="fleche_retour mb-2 ml-4">
    <a href="../utilisateur/equipe.php?id=<?= $idEquipe ?>" class="retour">
        <i class="fas fa-chevron-left"></i>
        Retour
    </a>
</div>

<div class="container">
    <div class="">
        <div class="card border-0">
            <div class="card-header header_mb dark">
                <h3 class="titreCentrePetit text-center my-2">Membre de l'équipe</h3>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <div class="container-fluid">
                        <div class="row row_membreEquipe">

                            <?php
                            foreach ($utilisateurs as $utilisateur) {
                            ?>
                                <div class="col-12 col-md-8 col-lg-6 div_membreEquipe">
                                    <div class="div_avatar_membreEquipe mr-2 mb-4">

                                        <img src="../<?= $utilisateur["avatar"]; ?>" class="avatar_membreEquipe">
                                    </div>

                                    <div class="div_contact_membreEquipe">
                                        <div class="d-flex">
                                        <h3 class="texte_infos_profil mr-3"><?= $utilisateur['prenom'] . " " . $utilisateur['nom']; ?></h3>
                                        <?php
                                        if($utilisateur['idUtilisateur'] !== $idUtilisateur)
                                        {
                                            if($objetDiscussion->verifierDiscussion($utilisateur['idUtilisateur'], $idUtilisateur))
                                            {
                                                $valeur = $objetDiscussion->verifierDiscussion($utilisateur['idUtilisateur'], $idUtilisateur);
                                                $idDiscussion = $valeur['idDiscussion'];
                                                ?>
                                                <a href="../utilisateur/discussion.php?id=<?= $idDiscussion; ?>" class="icone_actualiser">
                                                    <i class="fas fa-comments"></i>
                                                </a>
                                                <?php
                                            }
                                            else
                                            {
                                                ?>
                                                <a href="../utilisateur/listeDiscussions.php?form=open&select=<?= $utilisateur['idUtilisateur'];?>" class="icone_actualiser">
                                                    <i class="fas fa-comments"></i>
                                                </a>
                                                <?php
                                            }
                                        ?>
                                        <?php
                                        }
                                        ?>
                                        </div>
                                        <h3 class="texte_infos_profil"><?= $utilisateur['poste']; ?></h3>
                                    </div>
                                </div>
                            <?php
                            }
                            if($nbPages > 0) {
                            ?>
                            <div class="div_pagination clair">
                                <div class="apercu_pagination mb-2">
                                    <a href="membreEquipe?id=<?= $idEquipe; ?>&page=<?php echo $page_first; ?>">« Premier</a>
                                    <a href="membreEquipe?id=<?= $idEquipe; ?>&page=<?php echo $page_prev; ?>">Précédant</a>
                                    <a href="membreEquipe?id=<?= $idEquipe; ?>&page=<?php echo $page_next; ?>">Suivant</a>
                                    <a href="membreEquipe?id=<?= $idEquipe; ?>&page=<?php echo $page_last; ?>">Dernier »</a>
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
</div>

<?php
require_once "pied.php";