<?php
require_once "entete.php";
if (!isset($_GET["id"])) {
    $service->redirectOneSec("../visiteur/index.php");
}

$idProjet = $_GET["id"];
$service = new Service();
$objetEtape = new Etape();
$objetProjet = new Projet($idProjet);
$objetEquipe = new Equipe();

$idUtilisateur = $_SESSION["idUtilisateur"];
$requete = $objetProjet->recupererEquipeViaProjet($idProjet);
$idEquipe = $requete["idEquipe"];

// Vérification de si l'utilisateur a bien accès à cet page
if($objetEquipe->verifierPresenceUtilisateurEquipe($idUtilisateur, $idEquipe) != true) { $service->redirectNow("../utilisateur/listeEquipes.php"); }

$etapes = $objetProjet->getEtapes();
$intituleProjet = $objetProjet->getIntitule();
$contexteProjet = $objetProjet->getContexte();
$premier = true;
?>
<div class="fleche_retour mb-2 ml-4">
    <a href="../utilisateur/listeProjets.php?id=<?= $idEquipe ?>" class="retour">
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
                        <h1 class="titre_projet py-3"><?= $objetProjet->getNomProjet(); ?></h1>
                    </div>
                    <div class="col-12 col-sm-12 col-lg-9 col-md-8 div_intitule py-3">
                        <div class="div_intitule_projet">
                            <h3 class="intitule_projet"><?= $intituleProjet; ?></h3>
                        </div>
                    </div>
                </div>
                <div class="card-body darker">
                    <div class="div_contexte_projet">
                        <h3 class="titreCentrePlusPetit text-center">Contexte du projet</h3>
                        <?php
                        if(!empty($contexteProjet))
                        { ?>
                            <div class="text-center">
                                <?= $contexteProjet; ?>
                            </div>
                        <?php
                        }
                        else
                        { ?>
                            <div class="muted">Pas de contexte renseigné</div>
                        <?php
                        }
                         ?>
                    </div>
                    <div class="div_dates_projet mt-3">
                        <h3 class="titreDiscussion mt-3">Période du projet : Du <?= $service->dateFr($objetProjet->getDateDebut()); ?> au <?= $service->dateFr($objetProjet->getDateFin()); ?></h3>
                    </div>
                </div>
            </div>

            <div class="div_liste_etapes">
                <div class="card border-0">
                    <div class="card-header header_mb dark">
                        <h3 class="titreCentrePetit text-center my-2">Étapes</h3>
                    </div>
                    <div class="card-body darker">
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
                                        <div class="div_etat_nom col-6 col-md-6 col-lg-7">
                                            <i class="far fa-check-circle icone_termine"></i>
                                            <?= $etape["nomEtape"]; ?>
                                        </div>
                                        <div class="div_dates_debut_fin col-6 col-md-6 col-lg-5">
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
                        <!-- ------------------------------ ETAPES DEPASSEES ------------------------------ -->
                        <div class="div_etapes_depassees">
                            <?php
                            foreach ($etapes as $etape)
                            {
                            ?>
                                <?php
                                if ($etape["etatEtape"] == 0 && $objetEtape->etapeEnCours($etape["idEtape"]) == false)
                                {
                                    if ($premier == false) { ?> <div class="hr_rouge"></div> <?php }
                                    else { $premier = false; } ?>

                                    <div class="div_etape_projet d-flex">
                                        <div class="div_etat_nom col-6 col-md-6 col-lg-7">
                                            <i class="far fa-times-circle icone_depassees"></i>
                                            <?= $etape["nomEtape"]; ?>
                                        </div>
                                        <div class="div_dates_debut_fin col-6 col-md-6 col-lg-5">
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
                                        <div class="div_etat_nom col-6 col-md-6 col-lg-7">
                                            <i class="far fa-play-circle icone_encours"></i>
                                            <?= $etape["nomEtape"]; ?>
                                        </div>
                                        <div class="div_dates_debut_fin col-6 col-md-6 col-lg-5">
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
                                if ($etape["etatEtape"] == 0 && $objetEtape->etapeFutures($etape["idEtape"]))
                                {
                                    if ($premier == false) { ?> <div class="hr_gris"></div> <?php }
                                    else { $premier = false; } ?>

                                    <div class="div_etape_projet d-flex">
                                        <div class="div_etat_nom col-6 col-md-6 col-lg-7">
                                            <i class="far fa-pause-circle icone_futures"></i>
                                            <?= $etape["nomEtape"]; ?>
                                        </div>
                                        <div class="div_dates_debut_fin col-6 col-md-6 col-lg-5">
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
