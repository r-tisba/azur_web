<?php
// ------------------------ AJOUT D'UN NOUVEAU SUJET ------------------------ //

if (isset($_SESSION["pseudo"])) {
?>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-white">
          <div class="card-body">

            <form method="post">
              <div class="form-row align-items-center">
                <div class="col-sm-9 my-1">
                  <label for="nomSujet" class="sr-only">Nom sujet :</label>
                  <input type="text" class="form-control" name="nomSujet" id="nomSujet" placeholder="Quel sujet souhaitez vous ajouter dans la catégorie<?php ?> ?" />
                </div>

                <div class="col-sm-3 my-1">
                  <button type="submit" class="btn btn-primary">Ajouter le sujet</button>
                </div>
              </div>
            </form>
            <br>

          <?php
        } else {
          ?>
            <div class="row py-lg-3">
              <div class="col-lg-12 col-md-12 mx-auto">
                <h2 class="fw-dark">Vous n'êtes pas connecté<h2>
                    <p class="lead text-dark">Inscrivez vous pour pouvoir créer des sujets et poster des messages !</p>
                    <p>
              </div>
            </div>
            <hr>

          <?php
        }
          ?>

          <!--
// ------------------------- FIN AJOUT NOUVEAU SUJET ------------------------- //
-->


          <!-- FORMULAIRE AJOUT ETAPE
                                    <div>
                                        <form method="post" action="../traitements/ajoutEtape.php?id=<?= $idEquipe ?>&idProjet=<?= $projet["idProjet"] ?>" class="navbar-nav mr-auto">

                                            <div class="form-group">
                                                <label for="nom">Nom étape:</label>
                                                <input type="text" class="form-control" name="nom" id="nom" placeholder="Saisissez le nom du projet" value="<?= (isset($_POST["nom"]) ? $_POST["nom"] : "") ?>" required />
                                            </div>

                                            <div class="form-group">
                                                <label for="dateDebut">date début :</label>
                                                <input type="date" class="form-control" name="dateDebut" id="dateDebut" placeholder="Saisissez la date de commencement du projet" value="<?= (isset($_POST["dateDebut"]) ? $_POST["dateDebut"] : "") ?>" required />
                                            </div>
                                            <div class="form-group">
                                                <label for="dateFin">date fin :</label>
                                                <input type="date" class="form-control" name="dateFin" id="dateFin" placeholder="Saisissez la date de fin du projet" value="<?= (isset($_POST["dateFin"]) ? $_POST["dateFin"] : "") ?>" required />
                                            </div>

                                            <div class="form-group text-center">
                                                <button type="submit" class="btn btn-outline-primary">Ajouter l'étape</button>
                                            </div>
                                        </form>
                                    </div>
                                    -->


          <!-- FORMULAIRE SUPPR ETAPE
                            <li class="list-group-item">
                                Etape:
                                <ul class="list-group">
                                <?php
                                $etapesProjet = $etapes->etapeProjet($projet["idProjet"]);
                                ?>
                                    <?php

                                    foreach ($etapesProjet as $etapeProjet) {
                                    ?>
                                        <li class="list-group-item">
                                            <?= $etapeProjet["idEtape"] ?>.
                                            <?= $etapeProjet["nomEtape"] ?>
                                            a commancer le : <?= $etapeProjet["dateDebut"] ?>
                                            a finir pour le : <?= $etapeProjet["dateFin"] ?> </label>
                                        </li>
                                    <?php
                                    }
                                    ?>
                                    <form method="post" action="../traitements/validerEtape.php?id=<?= $idEquipe ?>" class="navbar-nav mr-auto">
                                        <div class="form-group">
                                            <label for="idEtape">numero Etape :</label>
                                            <input type="number" class="form-control" name="idEtape" id="idEtape" placeholder="Saisissez l'id de l'etape fini'" value="<?= (isset($_POST["dateFin"]) ? $_POST["dateFin"] : "") ?>" required />
                                        </div>
                                        <div class="form-group text-center">
                                            <button type="submit" class="btn btn-outline-primary">Valider la sélection</button>
                                        </div>
                                    </form>
                                </ul>
                            </li>
                            -->