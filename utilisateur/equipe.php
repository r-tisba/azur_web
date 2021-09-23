<?php
require_once "entete.php";

if(!isset($_SESSION["identifiant"]))
{
  header("location:../visiteur/index.php");
}

?>
<main>

<div class="album py-3">
    <div class="container">

      <!-- CARD 1 : Membre -->
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

        <div class="col-12 col-lg-4 col-md-6 mb-4">
          <div class="card shadow-sm">
            <div class="card-body">
            <h5 class="card-title">Membre</h5>
            <p class="card-text">Vos cohéquipier</p>
              <div class="d-flex justify-content-center">
                <div class="btn-group">
                  <a href="membreEquipe.php">
                    <img src="https://svgsilh.com/svg_v2/2324013.svg" class="imageSecteur"/>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- CARD 2 : Projet -->
        <div class="col-sm-12 col-lg-4 col-md-6 mb-4">
          <div class="card shadow-sm">
            <div class="card-body">
              <h5 class="card-title">Prjojet</h5>
              <p class="card-text">Vos projet</p>
              <div class="d-flex justify-content-center">
                <div class="btn-group">
                  <a href="projet.php">
                  <img src="https://image.flaticon.com/icons/png/512/1087/1087902.png" class="imageSecteur"/>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--"col-12 col-sm-6 col-md-4 col-lg-3"
        12 colonnes sur petit écran, 6 colonnes pour demi-écran, etc...
        -->
        

  </div>

</main>

<?php
require_once "pied.php";