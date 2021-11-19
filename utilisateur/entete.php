<?php
require_once "../modeles/modele.php";
session_start();

if (!isset($_SESSION["identifiant"]))
{
  header("location:../visiteur/index.php");
}
?>

<!doctype html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Azur</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="../style/stylePPE.css">
  <link rel="shortcut icon" href="../images/design/logo.png" type="image/x-icon">

  <link rel="stylesheet" href="../style/fontawesome/css/all.css">
</head>

<body>
  <nav class="navbar navbar-dark navbar-expand-md bg-dark">
    <a class="navbar-brand titre" href="/ap/azur_web/utilisateur/index.php">
      <img src="../images/design/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
      Azur
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse collapse" id="navbarNavDropdown">
      <div class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-item nav-link" href="/ap/azur_web/utilisateur/profil.php">Profil</a>
        </li>
        <?php
        if (!empty($_SESSION["identifiant"]) && $_SESSION["role"] == "Admin" || $_SESSION["role"] == "SuperAdmin") {
        ?>
          <li class="nav-item">
            <a class="nav-item nav-link" href="/ap/azur_web/utilisateur/inscription.php">Créer un utilisateur</a>
          </li>
        <?php
        }
        ?>
        <!-- <a class="nav-item nav-link" href="#">Autre truc</a>
        <a class="nav-item nav-link" href="#">Encore un autre truc</a>
        <a class="nav-item nav-link" href="#">Toujours un autre truc</a> -->
      </div>

      <div class="navbar-nav ml-auto">
        <?php
        if (isset($_SESSION["identifiant"]) && !empty($_SESSION)) {
        ?>

          <div class="div-inline my-2 my-sm-0">
            <a class="nav-item active nav-link apercu_connexion">
              <?= "Vous êtes connecté " . $_SESSION["identifiant"] ?>
            </a>
          </div>
          <a class="btn btn-outline-danger ml-1" href="/ap/azur_web/utilisateur/deconnexion.php">Se déconnecter</a>
        <?php
        }
        ?>
      </div>
    </div>
  </nav>
  <div class="container0 mt-4">