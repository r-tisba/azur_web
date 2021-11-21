<?php
require_once "entete.php";

$idUtilisateur = $_SESSION["idUtilisateur"];
$utilisateur = new Utilisateur();
$equipes = $utilisateur->recupererEquipesViaIdUtilisateur($idUtilisateur);
?>
<div class="fleche_retour mb-2 ml-4">
    <a href="../utilisateur/index.php" class="retour">
        <i class="fas fa-chevron-left"></i>
        Retour
    </a>
</div>

<div class="container container_wrap">
<?php
foreach ($equipes as $equipe)
{
?>
  <div class="col-12 col-lg-6 col-md-6 mb-4">
    <div class="card shadow-sm">
      <div class="card-body outil">
        <h5 class="card-title titreOutil"><?= $equipe["nomEquipe"] ?></h5>
        <div class="d-flex justify-content-center">
          <div class="btn-group">
            <a href="equipe.php?id=<?= $equipe["idEquipe"] ?>">
              <img src="<?= $equipe["image"] ?>" class="imageSecteur" />
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php
}
?>
</div>




<?php
require_once "pied.php";
?>