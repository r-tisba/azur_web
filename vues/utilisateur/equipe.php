<?php
require_once "../utilisateur/entete.php";

if (!isset($_GET["id"])) {
  $service->redirectNow("../visiteur/index.php");
}
$idUtilisateur = $_SESSION["idUtilisateur"];
$idEquipe = $_GET["id"];
$objetEquipe = new Equipe($idEquipe);

// Vérification de si l'utilisateur a bien accès à cet page
if($objetEquipe->verifierPresenceUtilisateurEquipe($idUtilisateur, $idEquipe) != true) { $service->redirectNow("../utilisateur/listeEquipes.php"); }
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
      <h2 class="titreSection hr_titre">Équipe <?= $objetEquipe->getNomEquipe(); ?></h2>
    </div>
    <div class="album py-3">

      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

        <!-- CARD 2 : Projet -->
        <div class="col-12 mb-4">
          <div class="card dark">
            <div class="card-body">
              <h5 class="card-title titreOutil">Projets en cours</h5>
              <div class="d-flex justify-content-center">
                <div class="btn-group">
                  <a href="listeProjets.php?id=<?= $idEquipe ?>">
                    <img src="../../images/design/projet.png" class="imageSecteurGrand" />
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- CARD 2 : Membre -->
        <div class="col-12 col-lg-6 col-md-6 mb-4">
          <div class="card dark">
            <div class="card-body">
              <h5 class="card-title titreOutil">Membres de l'équipe</h5>
              <div class="d-flex justify-content-center">
                <div class="btn-group">
                  <a href="membreEquipe.php?id=<?= $idEquipe ?>">
                    <img src="../../images/design/membre_equipe.png" class="imageSecteur" />
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- CARD 3 : Messagerie -->
        <div class="col-sm-12 col-lg-6 col-md-6 mb-4">
          <div class="card dark">
            <div class="card-body">
              <h5 class="card-title titreOutil">Messagerie</h5>
              <div class="d-flex justify-content-center">
                <div class="btn-group">
                  <a href="messagerieGroupe.php?id=<?= $idEquipe ?>">
                    <img src="../../images/design/messagerie_groupe.png" class="imageSecteur" />
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
