<?php
session_start();
require_once "../modeles/modele.php";
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acu'Gestion</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../stylePPE.css">
    <link rel="shortcut icon" href="logo.png" type="image/x-icon">
</head>

<body>
<nav class="navbar navbar-dark navbar-expand-md bg-dark">
  <a class="navbar-brand" href="index.php">
    <img src="logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
    Mon entreprise
  </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <div class="navbar-nav">

        <?php
        if(!empty($_SESSION["identifiant"]) && $_SESSION["idRole"] == 2)
        {
        ?>
        <li class="nav-item">
          <a class="nav-item nav-link" href="inscription.php">Inscrire un employé</a>
        </li>
        <?php
        }
        ?>

            <a class="nav-item nav-link" href="#">Autre truc</a>
            <a class="nav-item nav-link" href="#">Encore un autre truc</a>
            <a class="nav-item nav-link" href="#">Toujours un autre truc</a>
        </div>

        <?php

        if (isset($_SESSION["identifiant"]) && !empty($_SESSION))
        {
          ?>

          <div class="div-inline my-2 my-lg-0">
            <a class="nav-item active nav-link">
            <?php echo "Bonjour " . $_SESSION["identifiant"] . " ! Vous êtes connecté"?>
            </a>
          </div>
          <a class="btn btn-outline-danger ml-1" href="../admin/deconnexion.php">Se déconnecter</a>

          <?php
        } else {
          ?>
          <a class="btn btn-outline-success ml-auto" href="inscription.php">S'inscrire</a>
          <a class="btn btn-outline-primary ml-1" href="connexion.php">Se connecter</a>
          <?php
        }
        ?>
    </div>
</nav>
<div class="container mt-4">
