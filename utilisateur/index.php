<?php
require_once "entete.php";

if (!isset($_SESSION["identifiant"])) {
  $service->redirectNow("../visiteur/index.php");
}

?>
<main>

  <div class="album py-3">
    <div class="container">

      <!-- CARD 1 : Fiche de paye -->
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

        <div class="col-12 col-lg-4 col-md-6 mb-4">
          <div class="card shadow-sm">
            <div class="card-body cardOutil">
              <h5 class="card-title titreOutil">Casier virtuel</h5>
              <p class="card-text texteOutil">Vos documents</p>
              <div class="d-flex justify-content-center">
                <div class="btn-group">
                  <a href="salaire.php">
                    <img src="../images/design/salaire.png" class="imageSecteur" />
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- CARD 2 : Messagerie -->
        <div class="col-12 col-lg-4 col-md-6 mb-4">
          <div class="card shadow-sm">
            <div class="card-body cardOutil">
              <h5 class="card-title titreOutil">Messagerie</h5>
              <p class="card-text texteOutil">Vos discussions</p>
              <div class="d-flex justify-content-center">
                <div class="btn-group">
                  <a href="listeDiscussions.php">
                    <img src="../images/design/messagerie.png" class="imageSecteur" />
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- CARD 3 : Equipe/Projet -->
        <div class="col-12 col-lg-4 col-md-6 mb-4">
          <div class="card shadow-sm">
            <div class="card-body cardOutil">
              <h5 class="card-title titreOutil">Équipes</h5>
              <p class="card-text texteOutil">Vos projets en cours</p>
              <div class="d-flex justify-content-center">
                <div class="btn-group">
                  <a href="listeEquipes.php">
                    <img src="../images/design/equipe.png" class="imageSecteur" />
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--"col-12 col-sm-6 col-md-4 col-lg-3"
        12 colonnes sur petit écran, 6 colonnes pour demi-écran, etc...
        -->
        <!--CARD 4 : Emploi du temps -->
        <div class="col-12 col-lg-12 col-md-6">
          <div class="card shadow-sm_edt">
            <div class="card-body card_edt">
              <h5 class="card-title titreOutil">Emploi du temps</h5>
              <div class="d-flex justify-content-center">
                <div class="btn-group">
                  <a href="../utilisateur/calendrier/calendrier.php">
                    <img src="../images/design/edt.png" class="imageSecteur" />
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
