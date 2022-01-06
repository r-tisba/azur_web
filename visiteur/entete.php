<?php
require_once "../modeles/modele.php";
session_start();

$objetUtilisateur = new Utilisateur();
$service = new Service();

$tokenBool = false;
?>

<!-- ------------------------- GESTION COOKIE ------------------------- -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  // Récupère le cookie (si celui ci existe) via son nom
  function getCookie(c_name) {
    var c_value = document.cookie,
      c_start = c_value.indexOf(" " + c_name + "=");
    if (c_start == -1) c_start = c_value.indexOf(c_name + "=");
    if (c_start == -1) {
      c_value = null;
    } else {
      c_start = c_value.indexOf("=", c_start) + 1;
      var c_end = c_value.indexOf(";", c_start);
      if (c_end == -1) {
        c_end = c_value.length;
      }
      c_value = unescape(c_value.substring(c_start, c_end));
    }
    return c_value;
  }

  // Gestion cookie d'acceptation
  $(document).ready(function() {

    function afficherModal() {
      var cookieAccept = getCookie("accept-cookie");

      if (cookieAccept == null) {
        // Si le cookie n'existe pas
        $(document).ready(function() {
          $("#modalCookie").modal("toggle");
        });
      } else {
        // Si le cookie existe
      }
    }

    afficherModal();

    $('#cookieInfosButton').on('click', function(e) {
      e.preventDefault();
      window.location.href = "mentions-legales.php";
    });
    $('#cookieAcceptButton').on('click', function(e) {
      e.preventDefault();
      ajouterCookie();
    });

    function ajouterCookie() {
      $("#modalCookie").modal('hide');
      $.ajax({
        url: "../traitements/ajouterCookie.php",
        type: "POST",
      });
    }
  })
</script>

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
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"> -->


  <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" />
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> -->


  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <!-- Permet la lecture de cookie via JQuery -->
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
</head>

<body>
  <nav class="navbar navbar-dark navbar-expand-md bg-dark">
    <a class="navbar-brand titre" href="index.php">
      <img src="../images/design/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
      <span class="bleu_azur">Azur</span>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse collapse" id="navbarNavDropdown">

    </div>
  </nav>

  <?php
  // Gestion du cookie id-token
  if (isset($_COOKIE["id-token"]))
  {
    $id_token = $_COOKIE["id-token"];
    $valeurCookieToken = explode("-", $id_token);
    $idUtilisateur = $valeurCookieToken[0];
    $token = $valeurCookieToken[1];
    if ($objetUtilisateur->verifierAssociationToken($idUtilisateur, $token))
    {
      $infosUtilisateur = $objetUtilisateur->recupererUtilisateur($idUtilisateur);
      @session_start();
      $_SESSION["identifiant"] = $infosUtilisateur["identifiant"];
      $_SESSION["role"] = $infosUtilisateur["role"];
      $_SESSION["idUtilisateur"] = $idUtilisateur;

      $identifiant = $infosUtilisateur["identifiant"];
      $mdp = $infosUtilisateur["mdp"];
      $tokenBool = true;
    }
  }

    ?>
  <div class="container0 mt-4">

    <?php
    if ($_SERVER["REQUEST_URI"] != "/visiteur/mentions-legales.php" && $_SERVER["REQUEST_URI"] != "/utilisateur/deconnexion.php") {
    ?>
      <!-- Modal Cookie -->
      <div class="modal fade" id="modalCookie" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
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
              <button type="button" class="btn btn-outline-primary" id="cookieInfosButton">Plus d'informations</button>
              <button type="button" class="btn btn-outline-success" id="cookieAcceptButton">J'accepte</button>
            </div>
          </div>
        </div>
      </div>
    <?php
    }
