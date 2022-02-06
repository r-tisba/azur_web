<?php
require_once "entete.php";
require_once "../modeles/modele.php";
if(!isset($_SESSION["idUtilisateur"]))
{
  header("location:../visiteur/index.php");
}
$objetUtilisateur = new Equipe();
$idEquipe = $_GET["id"];

$utilisateurs = $objetUtilisateur->recupererUtilisateursRolesCompositionViaEquipe($idEquipe);



?>
<div class="fleche_retour mb-2 ml-4">
    <a href="../utilisateur/equipe.php?id=<?=$idEquipe?>" class="retour">
        <i class="fas fa-chevron-left"></i>
        Retour
    </a>
</div>
<div class="container">

<h1> Membre équipe : </h1>

<ul class="list-group">
<div class="container-fluid">
<div class="row">

<?php
foreach($utilisateurs as $utilisateur)
{
?>

    <div class="col-8 col-md-9 mb-4">
        <li class="list-group-item">Nom : <?=$utilisateur["nom"]?></li>
        <li class="list-group-item">Prénom : <?=$utilisateur["prenom"]?></li>
        <li class="list-group-item">Poste : <?=$utilisateur["poste"]?></li>
        <li class="list-group-item">Rôle : <?=$utilisateur["nomRole"]?></li>
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