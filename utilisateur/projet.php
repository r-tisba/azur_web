<?php
require_once "entete.php";
$equipe = new Equipe($_SESSION["idEquipe"]);



$projets=$equipe->recupererProjets($_SESSION["idEquipe"]);

if(!isset($_SESSION["idUtilisateur"]))
{
  header("location:../visiteur/index.php");
}

?>
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
            <form method="post" action="../traitements/ajoutProjet.php" class="navbar-nav mr-auto">

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
?>
        
    <div class="col-8 col-md-9 mb-4">
        <li class="list-group-item">Nom : <?=$projet["nom"]?></li>
        <li class="list-group-item">A commencer le : <?=$projet["dateDebut"]?></li>
        <li class="list-group-item">A finir le : <?=$projet["dateFin"]?></li>
        <li class="list-group-item">statut : <?php if($projet["fini"]==1){?> le projet est finis <?php }else{ ?> le projet n'est pas finis <?php }?></li>
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