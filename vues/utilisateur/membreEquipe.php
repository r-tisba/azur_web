<?php
require_once "entete.php";
if (!isset($_SESSION["idUtilisateur"])) {
    header("location:../visiteur/index.php");
}
$objetUtilisateur = new Utilisateur();
$objetDiscussion = new Discussion();
$idEquipe = $_GET["id"];

$utilisateurs = $objetUtilisateur->recupererUtilisateursRolesCompositionViaEquipe($idEquipe);
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
                                        if($utilisateur['idUtilisateur'] !== $_SESSION['idUtilisateur'])
                                        {
                                            if($objetDiscussion->verifierDiscussion($utilisateur['idUtilisateur'], $_SESSION['idUtilisateur']))
                                            {
                                                $valeur = $objetDiscussion->verifierDiscussion($utilisateur['idUtilisateur'], $_SESSION['idUtilisateur']);
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
                            ?>
                        </div>
                    </div>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php
require_once "pied.php";
