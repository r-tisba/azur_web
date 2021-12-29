<body>
  <nav class="navbar navbar-dark navbar-expand-md bg-dark">
    <a class="navbar-brand titre" href="index.php">
      <img src="../images/design/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
      Azur
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse collapse" id="navbarNavDropdown">

    </div>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </nav>
  <div class="container0 mt-4">

    <!-- ------------------------- GESTION COOKIE ------------------------- -->

    <?php
    if (!isset($_COOKIE["accept-cookie"])) {
      echo '<script type="text/javascript">'
        . '$( document ).ready(function() {'
        . '$("#modalCookie").modal("show");'
        . '});'
        . '</script>';
    }
    ?>
    <script>
      console.log("BBBBBBBBBBBBBBBB");
      $('#cookieInfosButton').on('click', function(e) {
        e.preventDefault();

      });
      $('#cookieAcceptButton').on('click', function(e) {
        e.preventDefault();
        console.log("AAAAAAAAAAAAAAA");
        ValideCookie();
      });

      function ValideCookie() {
        <?php
        // time() définit la date d'expiration du cookie (24h car 3600 secondes * 24)
        setcookie('accept-cookie', 1, time() + 3600 * 24, '/', '', true, true);
        ?>
      }
    </script>

    <!-- Modal Cookie -->
    <div class="modal fade" id="modalCookie" tabindex="-1" role="dialog" aria-labelledby="modalCookieTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title titre" id="modalCookieTitle">Azur</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Ce site web utilise les cookies pour facilier votre navigation.
          </div>
          <div class="modal-footer">
            <form method="post">
              <button type="button" class="btn btn-outline-secondary" id="cookieInfosButton">Plus d'informations</button>
              <button type="button" class="btn btn-outline-primary" id="cookieAcceptButton">J'accepte</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <?php



///////////////////////////////////////////////////////////////


<?php
require_once "../modeles/modele.php";
session_start();
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

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  <!-- //////////////////////////////////////////////////////////////////////////////// -->

  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script> -->

  <!-- //////////////////////////////////////////////////////////////////////////////// -->

  <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" />
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> -->

  <script>
    // $('#cookieInfosButton').on('click', function(e) {
    //   e.preventDefault();
    //   console.log("BOUTON INFOS");
    // });
    // $('#cookieAcceptButton').on('click', function(e) {
    //   e.preventDefault();
    //   console.log("BOUTON AJOUTER COOKIE")
    //   ajouterCookie();
    // });

    // $('#testButton').on("click", function() {
    //   console.log("AAAAAAAAAAAAAAAAAAAAAAA");
    // });

    // function ajouterCookie() {
    //   $("#modalCookie").modal('hide');
    //   console.log("AJOUTER COOKIE")
    //   $.ajax({
    //     url: "../traitements/ajouterCookie.php",
    //     type: "POST",
    //   });
    // }
  </script>
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

    <div class="navbar-collapse collapse" id="navbarNavDropdown">

    </div>
  </nav>
  <div class="container0 mt-4">

    <!-- COOKIE -->

    <?php
    // if (!isset($_COOKIE["accept-cookie"])) {
    //   echo '<script type="text/javascript">'
    //     . '$(document).ready(function() {'
    //     . '$("#modalCookie").modal("show");'
    //     . '});'
    //     . '</script>';
    // }
    ?>

    <!-- Modal Cookie -->
    <div class="modal fade" id="modalCookie" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">

        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title titre">Azur</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Ce site web utilise les cookies pour facilier votre navigation.
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-outline-primary" id="cookieInfosButton">Plus d'informations</button>
            <button type="submit" class="btn btn-outline-success" id="cookieAcceptButton">J'accepte</button>
            <button type="button" class="btn btn-outline-secondary" id="testButton">Test</button>
          </div>
        </div>
      </div>
    </div>

    <?php
