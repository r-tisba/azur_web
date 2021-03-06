<?php
require_once "../visiteur/entete.php";

require_once "../../services/fonctions.php";
$service = new Service();
$service->myRequireOnce("modeles/modele.php");

if ($_SERVER["REQUEST_URI"] != "/visiteur/index.php") {
    if (!empty($_SESSION["identifiant"])) {
        $service->redirectNow("../utilisateur/index.php");
    }
}
?>

<!-- MESSAGE D'ACCUEIL SI PAS CONNECTE -->
<section class="text-center container mt-5">
    <div class="row py-2">
        <div class="col-lg-6 col-md-8 mx-auto">
            <h1 class="titre_accueil">Azur</h1>
            <p class="lead text-petit mb-0">Vous devez être connecté pour utiliser l'application</p>
        </div>
    </div>
</section>
<!-- MESSAGE POST-CONNEXION -->
<?php if (!empty($_GET["success"])) {
    if ($_GET["success"] == "connexion") {
?>
        <div class="alert alert-success alert_connexion mt-3">Vous avez bien été connecté <br>
            Vous allez être redirigé vers la page d'accueil<br>
            <a href="../utilisateur/index.php">Cliquez ici pour une redirection manuelle</a>
        </div>
<?php
        $service->redirect("../utilisateur/index.php");
    }
}
?>
<?php if (!empty($_GET["error"])) {
?>
    <div class="alert alert-danger alert_connexion mt-3 col-11 col-md-12">
        <?php switch ($_GET["error"]) {
            case "invalidip2": ?>
                <?php echo "L'adresse IP Admin de ce compte n'a pas été enregistrée. <br/> 
                Vous pouvez le faire dans la table 'id_admins' de la base de données avec votre ID Utilisateur et votre adresse IP. <br/>
                Votre adresse IP : " . $_SERVER['REMOTE_ADDR']; ?>
                <?php break;
            case "invalidip3": ?>
                <?php echo "Votre adresse IP a été bannie"; ?>
                <?php break;
            case "falselogin": ?>
                <?php echo "Identifiant ou mot de passe incorrect"; ?>
                <?php break;
            case "falsecaptcha": ?>
                <?php echo "Le reCAPTCHA doit être rempli"; ?>
                <?php break;
            case "nocaptcha": ?>
                <?php echo "La vérification reCAPTCHA a echoué"; ?>
                <?php break;
            case "missing": ?>
                <?php echo "Au moins un champ n'a pas été saisi"; ?>
                <?php break; ?>
        <?php
        }
        ?>
    </div>
<?php
}
?>

<!-- MESSAGE SI TOKEN -->
<?php
if ($tokenBool == true) {
?>
    <div class="alert alert-success alert_connexion mt-3">Vous avez été connecté automatiquement via les cookies<br>
        Vous pouvez supprimer les cookies dans votre onglet Profil<br>
        Vous allez être redirigé vers la page d'accueil<br>
        <a href="../utilisateur/index.php">Cliquez ici pour une redirection manuelle</a>
    </div>
<?php
    $service->redirect("../utilisateur/index.php");
}
?>

<!-- FORMULAIRE DE CONNEXION -->
<form method="post" action="../../traitements/sauvegarderConnexion.php" id="connexionForm">
    <div class="col-12 text-center mb-4">
        <div class="card card_connexion">
            <div class="card-body">
            <div class="div_inputs_login">
                <div class="form-group">
                    <div class="div_input_icone_id">
                        <i class="far fa-user-circle icone_identifiant"></i>
                        <input type="text" class="form-control" name="identifiant" id="identifiant" placeholder="Identifiant" value="<?= $tokenBool == true ? htmlspecialchars($identifiant, ENT_QUOTES) : "" ?>" required />
                    </div>
                </div>
                <div class="form-group mb-3">
                    <div class="div_input_icone_mdp">
                        <i class="fas fa-lock icone_mdp"></i>
                        <input type="password" class="form-control" name="mdp" id="mdp" placeholder="Mot de passe" value="" required />
                    </div>
                </div>
            </div>
                <div class="form-group mb-3">
                    <div class="form-check">
                        <label class="containerCheck">
                            <input type="checkbox" class="form-check-input hidden" name="checkbox_token" id="checkbox_token" value="true">
                            <span class="checkmark"></span>
                            <label class="form-check-label" for="checkbox_token">Rester connecté</label>
                        </label>
                    </div>
                </div>
                <div class="form-group mb-3 d-flex justify-content-center">
                    <div class="g-recaptcha" data-sitekey="
                    <?php if($_SERVER['REMOTE_ADDR'] == "::1") { echo "6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI"; }
                    else { echo "6Lel-lAfAAAAALp8EZinxQ_APOWrVWVev0yiefCP"; } ?>" 
                    data-callback="enableBtn"></div>
                </div>
                <div class="form-group text-center m-0">
                    <button type="submit" class="button bouton_custom disabled" name="envoi" id="envoi" value="1" disabled="disabled">Connexion</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
function enableBtn(){
   document.getElementById("envoi").disabled = false;
   document.getElementById("envoi").classList.remove("disabled");
 }

 document.addEventListener('DOMContentLoaded', (event) => {
  const recaptcha = document.querySelector('.g-recaptcha');
  recaptcha.setAttribute("data-theme", "dark");
});
</script>
<?php
require_once "../visiteur/pied.php";