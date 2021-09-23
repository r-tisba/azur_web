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

      <!-- CARD 1 : Fiche de paye -->
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

        <div class="col-12 col-lg-4 col-md-6 mb-4">
          <div class="card shadow-sm">
            <div class="card-body">
            <h5 class="card-title">Salaire</h5>
            <p class="card-text">Fiche de paye</p>
              <div class="d-flex justify-content-center">
                <div class="btn-group">
                  <a href="salaire.php">
                    <img src="https://commsoft.ca/Public/img/uploaded/Employ%C3%A9s_Traitement%20de%20la%20paie_250x250.png" class="imageSecteur"/>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- CARD 2 : Messagerie -->
        <div class="col-12 col-lg-4 col-md-6 mb-4">
          <div class="card shadow-sm">
          <div class="card-body">
          <h5 class="card-title">Messagerie</h5>
              <div class="d-flex justify-content-center">
                <div class="btn-group">
                  <a href="listeDiscussions.php">
                  <img src="https://forfrenchaddicts.com/wp-content/uploads/2020/07/8d338f5acd60bfbc9b5fb1b208c8814f-outlined-email-round-icon-by-vexels.png" class="imageSecteur"/>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- CARD 3 : Equipe -->
        <div class="col-sm-12 col-lg-4 col-md-6 mb-4">
          <div class="card shadow-sm">
            <div class="card-body">
              <h5 class="card-title">Equipe</h5>
              <p class="card-text">votre équipe</p>
              <div class="d-flex justify-content-center">
                <div class="btn-group">
                  <a href="equipe.php">
                  <img src="https://i1.wp.com/leviagermutualise.fr/wp-content/uploads/2016/08/equipe-logo.png" class="imageSecteur"/>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--"col-12 col-sm-6 col-md-4 col-lg-3"
        12 colonnes sur petit écran, 6 colonnes pour demi-écran, etc...
        -->
        <!--CARD 4 : Emploie du temps -->
        <div class="col-12 col-lg-12 col-md-6">
          <div class="card shadow-sm">
            <div class="card-body">
              <h5 class="card-title">Emploie du temps</h5>
              <p class="card-text">Gérez le budget alloué aux différents secteurs</p>
              <div class="d-flex justify-content-center">
                <div class="btn-group">
                  <a href="epdt.php">
                    <img src="https://www.axess.fr/sites/default/files/medias/image/2020/12/xBESOIN,P20-,P20Emploi,P20du,P20temps.png.pagespeed.ic.rHZo1MQC6H.png" class="imageSecteurGrand"/>
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
