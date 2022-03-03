<?php
require_once "../utilisateur/entete.php";
if (empty($_SESSION["identifiant"])) {
    header("location:index.php");
}
$idUtilisateur = $_SESSION["idUtilisateur"];
$objetUtilisateur = new Utilisateur($idUtilisateur);
$utilisateur = $objetUtilisateur->recupererUtilisateur($_SESSION["idUtilisateur"]);
$nomRole = $utilisateur["role"];
$equipes = $objetUtilisateur->recupererEquipesViaIdUtilisateur($idUtilisateur);
?>

<script>
// Suppression des cookies
$(document).ready(function() {
    $('#supprButton').on('click', function(e) {
        e.preventDefault();
        doDelete();
    });
    function doDelete() {
        $.ajax({
            type: "POST",
            url: "../../traitements/supprimerCookie.php",
        })
    }
})
</script>

<div class="container container_profil">
    <div class="card card_profil_infos col-12 p-0 dark">
        <div class="card-header">
            <div class="show-image">
                <a href="../utilisateur/modifierAvatar.php">
                    <div class="div_avatar">
                        <img src="../<?= $objetUtilisateur->getAvatar(); ?>" class="rounded-circle avatarProfil">
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
            <div class="container-flex text-center">
                <div class="row">
                    <h3 class="col-12 texte_infos_profil">Poste : <?= $objetUtilisateur->getPoste(); ?></h3>
                    <div class="col-12 div_equipes mb-3">
                        <h3 class="texte_infos_profil mt-2 mb-0">Équipe :</h3>
                        <div class="row div_liste_equipes">
                            <?php
                            if (!empty($equipes)) {
                                foreach ($equipes as $equipe) {
                                    if (empty($equipe["idEquipe"])) {
                                        ?>
                                        <p class="texte_infos_profil">Vous ne faites parti d'aucune équipe.</p>
                                        <?php
                                    } else {
                                        $idEquipe = $equipe["idEquipe"];
                                        $objetEquipe = new Equipe($idEquipe);
                                        $imageEquipe = $objetEquipe->getImage();
                                        ?>
                                        <div class="col-12 col-md-6 col-lg-2">
                                        <a href="../utilisateur/equipe.php?id=<?= $idEquipe; ?>">
                                            <div class="div_image_equipe mb-2">
                                                <?php
                                                if (!empty($imageEquipe)) {
                                                ?>
                                                    <img src="../<?= $imageEquipe; ?>" class="miniatureEquipe">
                                                    <div class="blanc mt-1"><?= $equipe["nomEquipe"] ?></div>
                                                <?php
                                                } else {
                                                ?>
                                                    <img src="../../images/design/image_equipe.png" class="miniatureEquipe">
                                                    <div class="blanc mt-1"><?= $equipe["nomEquipe"] ?></div>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </a>
                                        </div>
                                        <?php
                                    }
                                }
                            }
                        ?>
                        </div>
                    </div>
                </div>
                <h3 class="texte_infos_profil">Rôle : <?= $nomRole; ?></h3>
                <div class="form-group text-center mb-1 mt-4">
                    <button type="submit" class="btn btn-outline-danger" name="supprButton" id="supprButton">Supprimer les cookies</button>
                </div>
            </div>
        </div>
    </div>
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
