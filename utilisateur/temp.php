<?php
// ------------------------ AJOUT D'UN NOUVEAU SUJET ------------------------ //

if(isset($_SESSION["pseudo"]))
{
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
      <input type="text" class="form-control" name="nomSujet" id="nomSujet" placeholder="Quel sujet souhaitez vous ajouter dans la catégorie<?php ?> ?"/>
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