<?php
require_once "entete.php";
$equipe = new Equipe($_SESSION["idEquipe"]);

$projets=$equipe->recupererProjets();

if(!isset($_SESSION["idEmploye"]))
{
  header("location:../visiteur/index.php");
}

?>
<div class="container">

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