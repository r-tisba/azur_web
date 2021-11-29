<?php
require_once "../utilisateur/entete.php";

if (!isset($_GET["id"])) {
  header("location:../visiteur/index.php");
}
$idEquipe = $_GET["id"];
$objetEquipe = new Equipe();
$equipe = $objetEquipe->recupererEquipe($idEquipe);
?>
<main>
  <div class="fleche_retour mb-2 ml-4">
    <a href="../utilisateur/listeEquipes.php" class="retour">
      <i class="fas fa-chevron-left"></i>
      Retour
    </a>
  </div>
  <div class="container">
    <div class="col-12 text-center">
      <h2 class="titreSection hr_titre">Équipe <?= $equipe["nomEquipe"]; ?></h2>
    </div>
    <div class="album py-3">

      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

        <!-- CARD 2 : Projet -->
        <div class="col-12 mb-4">
          <div class="card shadow-sm">
            <div class="card-body">
              <h5 class="card-title titreOutil">Projets en cours</h5>
              <div class="d-flex justify-content-center">
                <div class="btn-group">
                  <a href="listeProjets.php?id=<?= $idEquipe ?>">
                    <img src="../images/design/projet.png" class="imageSecteurGrand" />
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- CARD 2 : Membre -->
        <div class="col-12 col-lg-6 col-md-6 mb-4">
          <div class="card shadow-sm">
            <div class="card-body">
              <h5 class="card-title titreOutil">Membres de l'équipe</h5>
              <div class="d-flex justify-content-center">
                <div class="btn-group">
                  <a href="membreEquipe.php?id=<?= $idEquipe ?>">
                    <img src="https://svgsilh.com/svg_v2/2324013.svg" class="imageSecteur" />
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- CARD 3 : Messagerie -->
        <div class="col-sm-12 col-lg-6 col-md-6 mb-4">
          <div class="card shadow-sm">
            <div class="card-body">
              <h5 class="card-title titreOutil">Messagerie du groupe</h5>
              <div class="d-flex justify-content-center">
                <div class="btn-group">
                  <a href="messagerieGroupe.php?id=<?= $idEquipe ?>">
                    <img src="https://cdn-0.smartandroid.fr/wp-content/uploads/2020/09/envoyer-message-groupe3.png" class="imageSecteur" />
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
</main>

<?php
require_once "pied.php";
