<?php
require_once "entete.php";

$idProjet = $_GET["id"];
$objetEtape = new Etape();
$service = new Service();
$objetProjet = new Projet();

$projet = $objetProjet->recupererProjet($idProjet);
$idEquipe = $objetProjet->recupererEquipeViaProjet($idProjet);
$etapes = $objetEtape->recupererEtapesProjet($idProjet);
$intituleProjet = $projet["intitule"];

$premier = true;
?>
<div class="fleche_retour mb-2 ml-4">
    <a href="../utilisateur/listeProjets.php?id=<?= $idEquipe["idEquipe"] ?>" class="retour">
        <i class="fas fa-chevron-left"></i>
        Retour
    </a>
</div>

<div class="container-fluid container_etape">


    <div class="row">
        <div class="col-md-12 mb-3">
            <div class="card border-0 div_details_projet">
                <div class="card-header header_projet">
                    <div class="col-12 col-sm-12 col-lg-3 col-md-4 div_titre_projet">
                        <h1 class="titre_projet py-3"><?= $projet["nom"] ?></h1>
                    </div>
                    <div class="col-12 col-sm-12 col-lg-9 col-md-8 div_intitule py-3">
                        <div class="div_intitule_projet">
                            <h3 class="intitule_projet"><?= $intituleProjet; ?></h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="div_contexte_projet">
                        <h3 class="titreCentrePetit text-center">Contexte du projet</h3>
                        <?= $projet["contexte"]; ?>
                    </div>
                    <div class="div_dates_projet mt-3">
                        <h3 class="titreDiscussion">Période du projet : Du <?= $service->dateFr($projet["dateDebut"]); ?> au <?= $service->dateFr($projet["dateFin"]); ?></h3>
                    </div>
                </div>
            </div>

            <div class="div_liste_etapes">
                <div class="card">
                    <div class="card-header">
                        <h3 class="titreCentrePetit text-center my-2">Étapes</h3>
                    </div>
                    <div class="card-body">
                        <!-- ------------------------------ ETAPES TERMINEES ------------------------------ -->
                        <div class="div_etapes_finies">
                            <?php
                            foreach ($etapes as $etape)
                            {
                            ?>
                                <?php
                                if ($etape["etatEtape"] == 1)
                                {
                                    if ($premier == false) { ?> <div class="hr_vert"></div> <?php }
                                    else { $premier = false; } ?>

                                    <div class="div_etape_projet d-flex">
                                        <div class="div_etat_nom col-6 col-md-6 col-lg-5">
                                            <i class="far fa-check-circle icone_termine"></i>
                                            <?= $etape["nomEtape"]; ?>
                                        </div>
                                        <div class="div_dates_debut_fin col-6 col-md-6 col-lg-7">
                                            Du <?= $service->dateFr($etape["dateDebut"]); ?> au <?= $service->dateFr($etape["dateFin"]); ?>
                                        </div>
                                    </div>

                                <?php
                                }
                                ?>
                            <?php
                            }
                            ?>
                        </div>
                        <!-- ------------------------------ ETAPES EN COURS ------------------------------ -->
                        <div class="div_etapes_encours">
                            <?php
                            foreach ($etapes as $etape)
                            {
                            ?>
                                <?php
                                if ($etape["etatEtape"] == 0 && $objetEtape->etapeEnCours($etape["idEtape"]))
                                {
                                    if ($premier == false) { ?> <div class="hr_bleu"></div> <?php }
                                    else { $premier = false; } ?>

                                    <div class="div_etape_projet d-flex">
                                        <div class="div_etat_nom col-6 col-md-6 col-lg-5">
                                            <i class="far fa-play-circle icone_encours"></i>
                                            <?= $etape["nomEtape"]; ?>
                                        </div>
                                        <div class="div_dates_debut_fin col-6 col-md-6 col-lg-7">
                                            Du <?= $service->dateFr($etape["dateDebut"]); ?> au
                                            <?php
                                            if (!empty($etape["dateFin"])) { echo $service->dateFr($etape["dateFin"]); }
                                            else { ?> Date non spécifié <?php } ?>
                                        </div>
                                    </div>

                                <?php
                                }
                                ?>
                            <?php
                            }
                            ?>
                        </div>
                        <!-- ------------------------------ ETAPES FUTURES ------------------------------ -->
                        <div class="div_etapes_futures">
                        <?php
                            foreach ($etapes as $etape)
                            {
                            ?>
                                <?php
                                if ($etape["etatEtape"] == 0 && !($objetEtape->etapeEnCours($etape["idEtape"])))
                                {
                                    if ($premier == false) { ?> <div class="hr_gris"></div> <?php }
                                    else { $premier = false; } ?>

                                    <div class="div_etape_projet d-flex">
                                        <div class="div_etat_nom col-6 col-md-6 col-lg-5">
                                            <i class="far fa-pause-circle icone_futures"></i>
                                            <?= $etape["nomEtape"]; ?>
                                        </div>
                                        <div class="div_dates_debut_fin col-6 col-md-6 col-lg-7">
                                            Du <?= $service->dateFr($etape["dateDebut"]); ?> au
                                            <?php
                                            if (!empty($etape["dateFin"])) { echo $service->dateFr($etape["dateFin"]); }
                                            else { ?> Date non spécifié <?php } ?>
                                        </div>
                                    </div>

                                <?php
                                }
                                ?>
                            <?php
                            }
                            ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
<?php
require_once "pied.php";
