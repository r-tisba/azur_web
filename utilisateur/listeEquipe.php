<?php
require_once "entete.php";
if(!isset($_SESSION["identifiant"]))
{
  header("location:../visiteur/index.php");
}
$idUtilisateur=$_SESSION["idUtilisateur"];
$utilisateur= new Utilisateur();
$equipes=$utilisateur->recupererGroupes($idUtilisateur);

foreach($equipes as $equipe){
    ?>
    <div class="col-12 col-lg-4 col-md-6 mb-4">
          <div class="card shadow-sm">
            <div class="card-body outil">
              <h5 class="card-title titreOutil"><?= $equipe["nomEquipe"]?></h5>
              <div class="d-flex justify-content-center">
                <div class="btn-group">
                  <a href="equipe.php?id=<?= $equipe["idEquipe"]?>">
                  <img src="<?= $equipe["image"]?>" class="imageSecteur"/>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php
}

?>




<?php
require_once "pied.php";
?>