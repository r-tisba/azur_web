<?php
require_once "../utilisateur/entete.php";
require_once "../modeles/modele.php";
if (empty($_SESSION["identifiant"])) {
    header("location:index.php");
}
$objetEquipe = new Equipe();
$objetUtilisateur = new Utilisateur($_SESSION["idUtilisateur"]);
$utilisateur = $objetUtilisateur->recupererUtilisateur($_SESSION["idUtilisateur"]);
$idUtilisateur = $_SESSION["idUtilisateur"];
$idRole = $utilisateur["idRole"];
$nomRole = $objetUtilisateur->recupererNomRoleViaIdRole($idRole);
$nomRole = $nomRole["nomRole"];
$equipes = $objetUtilisateur->recupererGroupes($idUtilisateur);
?>

<div class="container container_profil">
    <div class="card card_profil_infos col-12">
        <div class="card-header">
            <div class="show-image">
                <a href="../utilisateur/modifierAvatar.php">
                    <div class="div_avatar">
                        <img src="<?= $objetUtilisateur->getAvatar(); ?>" class="rounded-circle avatarProfil">

                    </div>
                    <i class="fas fa-camera icone_camera"></i>
                </a>
            </div>
            <div class="form-group form_infos">
                <div class="form-group form_profil_identifiant">
                    <h3 class="texte_identifiant_profil"><?= $objetUtilisateur->getIdentifiant(); ?></h3>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group form_profil">
                <h3 class="texte_infos_profil">Poste : <?= $objetUtilisateur->getPoste(); ?></h3>
                <div class="row div_equipes">
                    <h3 class="texte_infos_profil">Équipe :</h3>
                    <div class="div_liste_equipes">
                        <?php
                        if (!empty($equipes))
                        {
                            foreach ($equipes as $equipe)
                            {
                                $idEquipe = $equipe["idEquipe"];
                                $imageEquipe = $objetEquipe->recupererImage($equipe["idEquipe"]);
                                ?>
                                <a href="../utilisateur/equipe.php?id=<?= $idEquipe; ?>">
                                    <div class="div_image_equipe">
                                        <?php
                                        if (!empty($imageEquipe)) {
                                        ?>
                                            <img src="<?= $imageEquipe["image"]; ?>" class="miniatureEquipe">
                                            <?= $equipe["nomEquipe"] ?>
                                        <?php
                                        } else {
                                        ?>
                                            <img src="../images/design/image_equipe.png">
                                            <?= $equipe["nomEquipe"] ?>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </a>
                            <?php
                            }
                        }


                        ?>
                    </div>
                </div>
                <h3 class="texte_infos_profil">Rôle : <?= $nomRole; ?></h3>
            </div>
        </div>


    </div>
    <!-- <div>
        <a href="../admin/modifierPseudo.php" type="submit" class="btn btn-outline-primary">Modifier Pseudo</a>
    </div> -->
</div>
<!-- <div class="container-fluid container_profil_annexes">
        <div class="card card_profil_projets col-6">
            <div class="card-header">
                CARD PROJETS EN COURS
            </div>
            <div class="card-body">

            </div>
        </div>
        <div class="card card_profil_discussions col-6">
            <div class="card-header">
                CARD DISCUSSIONS EN COURS
            </div>
            <div class="card-body">

            </div>
        </div>
    </div> -->
</div>

<?php
require_once "../utilisateur/pied.php";
