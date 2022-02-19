<?php
if(file_exists("../services/fonctions.php")) { require_once "../services/fonctions.php"; }
else if(file_exists("../../services/fonctions.php")) { require_once "../../services/fonctions.php"; }
$service = new Service();
$service->myRequireOnce("modeles/modele.php");
session_start();

$service = new Service();
$objetUtilisateur = new Utilisateur();
$result = $objetUtilisateur->recupererValidation($_SESSION["idUtilisateur"]);
$validation = $result["validation"];

if (!isset($_SESSION["identifiant"]))
{
  $service->redirectNow("../visiteur/index.php");
}

if(strpos($_SERVER["REQUEST_URI"], "utilisateur/validationMdp") == false && $_SERVER["REQUEST_URI"] != "/traitements/sauvegarderMdp.php" && $validation == 0)
{
  $service->redirectNow("../utilisateur/validationMdp.php");
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- ------------------------- GESTION COOKIE ------------------------- -->
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

  $(document).ready(function()
  {
    function afficherModal() {
      var myCookie = getCookie("accept-cookie");

      if (myCookie == null) {
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
        url: "../../traitements/ajoutCookie.php",
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
  <link rel="shortcut icon" href="../../images/design/logo.png" type="image/x-icon">
  <link rel="stylesheet" href="../../style/fontawesome/css/all.css">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" />

  <link rel="stylesheet" href="../../style/styleAP.css">
</head>

<body>
  <nav class="navbar navbar-dark navbar-expand-md bg-dark">
    <a class="navbar-brand titre" href="./index.php">
      <img src="../../images/design/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
      <span class="bleu_azur">Azur</span>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse collapse" id="navbarNavDropdown">
      <div class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-item nav-link" href="/vues/utilisateur/profil.php">Profil</a>
        </li>
      </div>

      <div class="navbar-nav ml-auto">
        <?php
        if (!empty($_SESSION)) {
        ?>
          <div class="div-inline my-2 my-sm-0">
            <a class="nav-item active nav-link apercu_connexion">
              <?= "Vous êtes connecté " . $_SESSION["identifiant"] ?>
            </a>
          </div>
          <a class="btn btn-outline-danger ml-1" href="/vues/utilisateur/deconnexion.php">Se déconnecter</a>
        <?php
        }
        ?>
      </div>
    </div>
  </nav>
  <div class="container0 mt-4">
    <?php
    if ($_SERVER["REQUEST_URI"] != "/utilisateur/mentions-legales.php" && $_SERVER["REQUEST_URI"] != "/utilisateur/deconnexion.php") {
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