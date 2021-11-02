<?php
require_once "../utilisateur/entete.php";
require_once "../modeles/modele.php";
if (empty($_SESSION["identifiant"])) {
    header("location:index.php");
}
$equipe = new Equipe();
$objetUtilisateur = new Utilisateur($_SESSION["idUtilisateur"]);
$utilisateur = $objetUtilisateur->recupererUtilisateur($_SESSION["idUtilisateur"]);
$idEmploye=$_SESSION["idUtilisateur"];
$idRole = $utilisateur["idRole"];
$equipes = $objetUtilisateur->recupererGroupes($idEmploye);
$nomRole = $objetUtilisateur->recupererNomRoleViaIdRole($idRole);
$nomRole = $nomRole["nomRole"];
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
                <h3 class="texte_infos_profil">Équipe :
                    <?php
                foreach($equipes as $equipe){
                ?>
                
                        <ul>
                            <li><?= $equipe["nomEquipe"]?></li>
                        </ul>
                    <?php
            }

?>    
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
