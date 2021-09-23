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
    <link rel="shortcut icon" href="logo.png" type="image/x-icon">
</head>

<body>

<nav class="navbar navbar-dark navbar-expand-md bg-dark">
  <a class="navbar-brand" href="index.php">
    <img src="../images/design/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
    Azur
  </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNavDropdown">
     

        <?php

        if (isset($_SESSION["identifiant"]) && !empty($_SESSION))
        {
          ?>
          
          <div class="div-inline my-2 my-lg-0">
            <a class="nav-item active nav-link" style="color: #00FF00;">
              <?= "Vous êtes connecté " . $_SESSION["identifiant"]?>
            </a>
          </div>
          <a class="btn btn-outline-danger ml-1" href="deconnexion.php">Se déconnecter</a>
          
          <?php
        } else {
          ?>
          <a class="btn btn-outline-success ml-auto" href="../visiteur/inscription.php">S'inscrire</a>
          <a class="btn btn-outline-primary ml-1" href="../visiteur/connexion.php">Se connecter</a> 
          <?php
        }
        ?>
    </div>
</nav>
<div class="container mt-4">
