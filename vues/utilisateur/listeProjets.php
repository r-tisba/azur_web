<?php
require_once "entete.php";

$idUtilisateur = $_SESSION["idUtilisateur"];
$idEquipe = $_GET["id"];
$objetEquipe = new Equipe();
$objetEtape = new Etape();
$objetProjet = new Projet();
$service = new Service();

// Vérification de si l'utilisateur a bien accès à cet page
if($objetEquipe->verifierPresenceUtilisateurEquipe($idUtilisateur, $idEquipe) != true) { $service->redirectNow("../utilisateur/listeEquipes.php"); }
$projets = $objetProjet->recupererProjetsEquipe($idEquipe);
// PAGINATION
empty($_GET['page']) ? $page = 1 : $page = intval($_GET['page']);
$projetParPage = 6;
$nbProjetsTotal = count($projets);
$nbPages = ceil($nbProjetsTotal / $projetParPage);
if ($page > $nbPages) { $page = $nbPages; }
if ($page < 1) { $page = 1; }
// Calcule la position du 1er éléments à afficher sur la page
$offset = ($page - 1) * $projetParPage;
// Récupère les éléments du tableau qui seront affichés sur la page
$projets = array_slice($projets, $offset, $projetParPage);
$page_first = $page > 1 ? 1 : '';
$page_prev  = $page > 1 ? $page-1 : '';
$page_next  = $page < $nbPages ? $page + 1 : '';
$page_last  = $page < $nbPages ? $nbPages : '';
?>
<div class="fleche_retour mb-2 ml-4">
    <a href="../utilisateur/equipe.php?id=<?= $idEquipe ?>" class="retour">
        <i class="fas fa-chevron-left"></i>
        Retour
    </a>
</div>
<div class="containerPerso">
    <!-- ----------------------------- PROJETS EN COURS ----------------------------- -->
    <h1 class="titreCentrePetit blanc"> Projets en cours : </h1>

    <div class="container-fluid">
        <div class="row_projets">
            <?php
            if(empty($projets)) {
                ?>
                <h2 class="titre_projets_vide">Aucun projet existant pour cette équipe</h2>
                <?php
             }
            foreach ($projets as $projet)
            {
                /* ----------------------------- BARRE DE PROGRESSION ----------------------------- */
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
                                        <div class="progress-bar" role="progressbar" 
                                        style="width:<?php if (!empty($progression)) { ?> <?= $progression * 100 / $barreProgression ?>%;<?php } elseif($progression){} else { echo 2; ?>%; background : white; <?php } ?> color: black;" aria-valuenow="<?php if (!empty($progression)) { ?> <?= $progression * 100 / $barreProgression ?><?php } else { echo 0; } ?>" aria-valuemin="0" aria-valuemax="100">
                                            <?php $valeur_prog=$progression * 100 / $barreProgression; if (!empty($progression)) { echo round($valeur_prog, 0); } else { echo 0; } ?>%
                                        </div>
                                    </div>

                                    <div class="div_liste_etapes mt-3">
                                        <h3 class="titre mb-3">Étape(s) en cours :</h3>
                                        <?php

                                        $idProjet = $projet["idProjet"];
                                        $etapes = $objetProjet->recupererEtapesProjetNonFini($idProjet);
                                        $countEtapesEnCours = 0;
                                        $compteur = 0;
                    
                                        foreach ($etapes as $etape)
                                        {
                                            if($objetEtape->etapeEnCours($etape["idEtape"]) == true) { $countEtapesEnCours++; }
                                        }
                                        if($countEtapesEnCours == 0)
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
            if($nbPages > 0) {
            ?>
            <div class="div_pagination">
                <div class="apercu_pagination mb-2">
                    <a href="listeProjets?id=<?= $idUtilisateur; ?>&page=<?php echo $page_first; ?>">« Premier</a>
                    <a href="listeProjets?id=<?= $idUtilisateur; ?>&page=<?php echo $page_prev; ?>">Précédant</a>
                    <a href="listeProjets?id=<?= $idUtilisateur; ?>&page=<?php echo $page_next; ?>">Suivant</a>
                    <a href="listeProjets?id=<?= $idUtilisateur; ?>&page=<?php echo $page_last; ?>">Dernier »</a>
                </div>
                <div class="">Page <?= $page; ?> sur <?= $nbPages; ?></div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>

<?php
require_once "pied.php";
