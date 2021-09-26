<?php
session_start();
require_once "../modeles/modele.php";
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
</head>

<body>
  <nav class="navbar navbar-dark navbar-expand-md bg-dark">
    <a class="navbar-brand titre" href="index.php">
      <img src="../images/design/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
      Azur
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse collapse w-100 order-3 dual-collapse2" id="navbarNavDropdown">
      <ul class="navbar-nav ml-auto">
        <?php
        if (isset($_SESSION["identifiant"]) && !empty($_SESSION)) {
        ?>

          <div class="div-inline my-2 my-lg-0">
            <a class="nav-item active nav-link">
              <?php echo "Bonjour " . $_SESSION["identifiant"] . " ! Vous êtes connecté" ?>
            </a>
          </div>
          <a class="btn btn-outline-danger ml-1" href="../deconnexion.php">Se déconnecter</a>

        <?php
        } else {
        ?>
          <li class="nav-item">
            <a class="btn btn-outline-success ml-1" href="connexion.php">Se connecter</a>
          </li>
        <?php
        }
        ?>
      </ul>
    </div>
  </nav>
  <div class="container mt-4">