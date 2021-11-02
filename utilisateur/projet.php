<?php
require_once "entete.php";
if(!isset($_SESSION["idUtilisateur"]))
{
  header("location:../visiteur/index.php");
}
$idEquipe=$_GET["id"];
$equipe = new Equipe();
$leProjet= new Projet();
$etapes= new Etape();
$projets=$equipe->recupererProjetEquipe($idEquipe);
?>
<div class="fleche_retour mb-2 ml-4">
    <a href="../utilisateur/equipe.php?id=<?=$idEquipe?>" class="retour">
        <i class="fas fa-chevron-left"></i>
        Retour
    </a>
</div>
<div class="container">
<div class="row">
    <div class="col-md-12 mb-3">
    <div class="card ">
    <div class="card-body">

        <nav class="navbar navbar-7">
            <h1 class="navbar-brand titreAjout">Ajout d'un nouveau projet : </h1>
            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent11" aria-controls="navbarSupportedContent11" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse" id="navbarSupportedContent11">
            <form method="post" action="../traitements/ajoutProjet.php?id=<?=$idEquipe?>" class="navbar-nav mr-auto">

                <div class="form-group">
                    <label for="nom">Nom projet:</label>
                    <input type="text" class="form-control" name="nom" id="nom" placeholder="Saisissez le nom du projet" value="<?=(isset($_POST["nom"]) ? $_POST["nom"] : "")?>" required/>
                </div>

                <div class="form-group">
                    <label for="importance">importance :</label>
                    <input type="int" class="form-control" name="importance" id="importance" placeholder="Saisissez l'importance du projet" value="<?=(isset($_POST["importance"]) ? $_POST["importance"] : "")?>" required/>
                </div>

                <div class="form-group">
                    <label for="dateDebut">date début :</label>
                    <input type="date" class="form-control" name="dateDebut" id="dateDebut" placeholder="Saisissez la date de commencement du projet" value="<?=(isset($_POST["dateDebut"]) ? $_POST["dateDebut"] : "")?>"/>
                </div>
                <div class="form-group">
                    <label for="dateFin">date fin :</label>
                    <input type="date" class="form-control" name="dateFin" id="dateFin" placeholder="Saisissez la date de fin du projet" value="<?=(isset($_POST["dateFin"]) ? $_POST["dateFin"] : "")?>"/>
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


<h1> Nos projets : </h1>

<ul class="list-group">
<div class="container-fluid">
<div class="row">
    
<?php
foreach($projets as $projet)
{
    $tabBarreProgression=$etapes->barreProgression($projet["idProjet"]);
    $tabProgression=$etapes->progression($projet["idProjet"]);
    $barreProgression=$tabBarreProgression["COUNT(*)"];
    $progression=$tabProgression["COUNT(*)"];
    
?>
        
    <div class="col-8 col-md-9 mb-4">
        <li class="list-group-item">Nom : <?=$projet["nom"]?></li>
        <li class="list-group-item">A commencer le : <?=$projet["dateDebut"]?></li>
        <li class="list-group-item">A finir le : <?=$projet["dateFin"]?></li>

        <li class="list-group-item">
        <div class="row">
            <div class="col-md-12 mb-3">
            <div class="card ">
            <div class="card-body">
                    <h4>Ajout d'une nouvelle étape : </h4>
                    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent11" aria-controls="navbarSupportedContent11" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div>
                    <form method="post" action="../traitements/ajoutEtape.php?id=<?=$idEquipe?>&idProjet=<?=$projet["idProjet"]?>" class="navbar-nav mr-auto">

                        <div class="form-group">
                            <label for="nom">Nom étape:</label>
                            <input type="text" class="form-control" name="nom" id="nom" placeholder="Saisissez le nom du projet" value="<?=(isset($_POST["nom"]) ? $_POST["nom"] : "")?>" required/>
                        </div>

                        <div class="form-group">
                            <label for="dateDebut">date début :</label>
                            <input type="date" class="form-control" name="dateDebut" id="dateDebut" placeholder="Saisissez la date de commencement du projet" value="<?=(isset($_POST["dateDebut"]) ? $_POST["dateDebut"] : "")?>" required/>
                        </div>
                        <div class="form-group">
                            <label for="dateFin">date fin :</label>
                            <input type="date" class="form-control" name="dateFin" id="dateFin" placeholder="Saisissez la date de fin du projet" value="<?=(isset($_POST["dateFin"]) ? $_POST["dateFin"] : "")?>" required/>
                        </div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-outline-primary">Ajouter l'étape</button>
                        </div>
                    </form>
                    </div>
            </div>
            </div>
            </div>
            </div>
        </li>

        <li class="list-group-item">
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width:<?php if(!empty($progression)){?> <?=$progression*100/$barreProgression?><?php }else{?><?=0?><?php }?>%; color: black;" 
                aria-valuenow="<?php if(!empty($progression)){?> <?=$progression*100/$barreProgression?><?php }else{?><?=0?><?php }?>" 
                aria-valuemin="0" aria-valuemax="100">
                <?php if(!empty($progression)){?> <?=$progression*100/$barreProgression?><?php }else{?><?=0?><?php }?>%
            </div>
            </div>
        </li>
        <li class="list-group-item">
            Etape:
            <ul class="list-group">
            <?php
            $etapesProjet=$etapes->etapeProjet($projet["idProjet"]);
            ?>
            
                <?php
                
                foreach($etapesProjet as $etapeProjet)
                {
                    ?>
                    <li class="list-group-item">
                        <?=$etapeProjet["idEtape"]?>.
                          <?= $etapeProjet["nomEtape"]?>                        
                             a commancer le : <?= $etapeProjet["dateDebut"]?>
                             a finir pour le : <?= $etapeProjet["dateFin"]?> </label>
                    </li>
                    
                    
                <?php
                }
                ?>
                <form method="post" action="../traitements/validerEtape.php?id=<?=$idEquipe?>" class="navbar-nav mr-auto">
                    <div class="form-group">
                            <label for="idEtape">numero Etape :</label>
                            <input type="number" class="form-control" name="idEtape" id="idEtape" placeholder="Saisissez l'id de l'etape fini'" value="<?=(isset($_POST["dateFin"]) ? $_POST["dateFin"] : "")?>" required/>
                        </div>
                <div class="form-group text-center">
                            <button type="submit" class="btn btn-outline-primary">Valider la sélection</button>
                    </div>
            </form>
            </ul>
        </li>

    </div>
        
    <?php
}
    ?>
</div>
</div>
</ul>
</div>

<?php
require_once "pied.php";