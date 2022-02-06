<?php
require_once "entete.php";

$idEquipe = $_GET["id"];
$objetEquipe = new Equipe();
$objetEtape = new Etape();
$objetProjet = new Projet();
$service = new Service();
$projets = $objetProjet->recupererProjetsEquipe($idEquipe);
?>
<div class="fleche_retour mb-2 ml-4">
    <a href="../utilisateur/equipe.php?id=<?= $idEquipe ?>" class="retour">
        <i class="fas fa-chevron-left"></i>
        Retour
    </a>
</div>
<div class="container">
    <!-- ----------------------------- HAMBURGER AJOUT PROJET ----------------------------- -->
    <!--
    <div class="row">
        <div class="col-md-12 mb-3">
            <div class="card cardHamburger">
                <div class="card-body">

                    <nav class="navbar navbarHamburger">
                        <h1 class="navbar-brand titreSectionHamburger">Ajout d'un nouveau projet</h1>
                        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent11" aria-controls="navbarSupportedContent11" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon hamburger_icon"></span>
                        </button>
                        <div class="navbar-collapse collapse" id="navbarSupportedContent11">
                            <form method="post" action="../traitements/ajoutProjet.php?id=<?= $idEquipe ?>" class="navbar-nav mr-auto">

                                <div class="form-group">
                                    <label for="nom">Nom projet:</label>
                                    <input type="text" class="form-control" name="nom" id="nom" placeholder="Saisissez le nom du projet" value="<?= (isset($_POST["nomProjet"]) ? $_POST["nomProjet"] : "") ?>" required />
                                </div>

                                <div class="form-group">
                                    <label for="importance">Importance :</label>
                                    <input type="int" class="form-control" name="importance" id="importance" placeholder="Saisissez l'importance du projet" value="<?= (isset($_POST["importance"]) ? $_POST["importance"] : "") ?>" required />
                                </div>

                                <div class="form-group">
                                    <label for="dateDebut">Date début :</label>
                                    <input type="date" class="form-control" name="dateDebut" id="dateDebut" placeholder="Saisissez la date de commencement du projet" value="<?= (isset($_POST["dateDebut"]) ? $_POST["dateDebut"] : "") ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="dateFin">Date fin :</label>
                                    <input type="date" class="form-control" name="dateFin" id="dateFin" placeholder="Saisissez la date de fin du projet" value="<?= (isset($_POST["dateFin"]) ? $_POST["dateFin"] : "") ?>" />
                                </div>

                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-outline-primary">Ajouter le projet</button>
                                </div>
                            </form>
                        </div>
                    </nav>

                </div>
            </div>
        </div>
    </div>
    -->
    <!-- ----------------------------- PROJETS EN COURS ----------------------------- -->
    <h1 class="titreCentrePetit"> Projets en cours : </h1>

    <div class="container-fluid">
        <div class="row">

            <?php
            foreach ($projets as $projet)
            {
                $tabBarreProgression = $objetEtape->barreProgression($projet["idProjet"]);
                $tabProgression = $objetEtape->progression($projet["idProjet"]);
                $barreProgression = $tabBarreProgression["COUNT(*)"];
                $progression = $tabProgression["COUNT(*)"];
                $intituleProjet = $projet["intitule"];
                ?>
                <!-- ----------------------------- CONTAINER PROJET ----------------------------- -->
                <div class="container-fluid mb-4">
                    <div class="row">
                        <div class="col-12 div_lien_projet p-0">
                            <a href="projet.php?id=<?=$projet["idProjet"];?>">
                            <div class="card border-0">
                                <div class="card-header header_projet">
                                    <div class="col-12 col-sm-12 col-lg-3 col-md-4 div_titre_projet">
                                        <h1 class="titre_projet py-3"><?= $projet["nomProjet"] ?></h1>
                                    </div>
                                    <div class="col-12 col-sm-12 col-lg-9 col-md-8 div_intitule_dateDeb py-3">
                                        <div class="div_intitule_projet">
                                            <h3 class="intitule_projet"><?= $intituleProjet; ?></h3>
                                        </div>
                                        <div class="text-muted small">
                                            Date de début : <?= $service->dateFr($projet["dateDebut"]); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="div_progressbar">
                                        <div class="progress-bar" role="progressbar" style="width:<?php if (!empty($progression)) { ?> <?= $progression * 100 / $barreProgression ?>%;<?php }elseif($progression){} else { ?><?= 2 ?>%; background : white; <?php } ?>color: black;"
                                         aria-valuenow="<?php if (!empty($progression)) { ?> <?= $progression * 100 / $barreProgression ?><?php } 
                                         else { ?><?= 0 ?><?php } ?>" aria-valuemin="0" aria-valuemax="100">
                                            <?php $valeur_prog=$progression * 100 / $barreProgression; if (!empty($progression)) { ?> <?= variant_int($valeur_prog); ?><?php } else { ?><?= 0 ?><?php } ?>%
                                        </div>
                                    </div>

                                    <div class="div_liste_etapes mt-3">
                                        <h3 class="titre mb-3">Étape(s) en cours :</h3>
                                        <?php

                                        $idProjet = $projet["idProjet"];
                                        $etapes = $objetEtape->recupererEtapesProjetNonFini($idProjet);
                                        $countEtapesEnCours = 0;
                                        $compteur = 0;

                                        foreach ($etapes as $etape)
                                        {
                                            if($objetEtape->etapeEnCours($etape["idEtape"]) == true) { $countEtapesEnCours++; }
                                        }

                                        if(empty($etapes))
                                        {
                                            ?>
                                                <div class="liste_etapes_vide">
                                                    Aucune étape en cours
                                                </div>
                                            <?php
                                        } else
                                        {
                                            foreach ($etapes as $etape)
                                            {

                                                $idProjet = $objetEtape->recupererProjetViaEtape($etape["idEtape"]);

                                                if($objetEtape->etapeEnCours($etape["idEtape"]) == true)
                                                {
                                                    $compteur++;
                                                    ?>
                                                    <div class="div_etape px-4">
                                                        <div class="div_etape_nom">
                                                            <i class="far fa-circle icone_cercle"></i>
                                                            <?= $etape["nomEtape"] ?>
                                                        </div>
                                                        A finir pour le :
                                                        <?php
                                                        if(!empty($etape["dateFin"]))
                                                        {
                                                            print_r($service->dateFr($etape["dateFin"]));

                                                        } else {
                                                            ?>
                                                            Date non spécifié
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                    <?php
                                                    if($countEtapesEnCours != $compteur)
                                                    {
                                                        ?>
                                                        <div class="div_hr my-2">
                                                            <hr class="hrPerso">
                                                        </div>
                                                        <?php
                                                    }
                                                }
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>

<?php
require_once "pied.php";
