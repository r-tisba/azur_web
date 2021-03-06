<?php
require_once "../utilisateur/entete.php";

if (empty($_SESSION["identifiant"])) {
    $service->redirectNow("../visiteur/index.php");
}
$idUtilisateur = $_SESSION["idUtilisateur"];
$objetUtilisateur = new Utilisateur($idUtilisateur);
$validation = $objetUtilisateur->getValidation();

if ($validation == 1) {
    $service->redirectNow("../utilisateur/index.php");
}
?>

<?php if (!empty($_GET["success"])) {
    if ($_GET["success"] == "validation") {
?>
        <div class="alert alert-success alert_connexion mt-3">Votre mot de passe a été changé <br>
            Vous allez être redirigé vers la page d'accueil<br>
            <a href="../utilisateur/index.php">Cliquez ici pour une redirection manuelle</a>
        </div>
<?php
        $service->redirect("../utilisateur/index.php");
    }
}
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 text-center">
            <h2 class="titreSection">Changement de votre mot de passe</h2>
        </div>
        <div class="col-lg-9 col-md-9 mx-auto mb-3">
            <div class="card card-body dark">
                <h2 class="titreDiscussion text-center mb-2">Bienvenue sur <span class="bleu_azur">Azur</span> !</h2>
                <p class="lead mb-2">Pour votre 1ère connexion, vous allez devoir choisir le mot de passe de votre compte. <br>
                    Votre mot de passe doit comporter au moins :
                <ul class="card_list">
                    <li>8 caractères</li>
                    <li>1 lettre</li>
                    <li>1 majuscule</li>
                    <li>1 chiffre</li>
                    <li>1 caractère spécial</li>
                </ul>
            </div>
        </div>

        <!-- ----------------------------------- MESSAGE D'ERREUR ----------------------------------- -->
        <?php if (!empty($_GET["error"])) {
        ?>
            <div class="alert alert-danger alert_connexion mt-3">
                <?php switch ($_GET["error"]) {
                    case "validationsave": ?>
                        <?php echo "Une erreur s'est produite lors de la validation"; ?>
                        <?php break; ?>
                    <?php
                    case "mdplength": ?>
                        <?php echo "Le mot de passe doit faire au moins 8 caractères"; ?>
                        <?php break; ?>
                    <?php
                    case "mdpletter": ?>
                        <?php echo "Le mot de passe doit faire au moins 1 lettre"; ?>
                        <?php break; ?>
                    <?php
                    case "mdpcaps": ?>
                        <?php echo "Le mot de passe doit faire au moins 1 majuscule"; ?>
                        <?php break; ?>
                    <?php
                    case "mdpdigit": ?>
                        <?php echo "Le mot de passe doit faire au moins 1 chiffre"; ?>
                        <?php break; ?>
                    <?php
                    case "mdpspechar": ?>
                        <?php echo "Le mot de passe doit faire au moins 1 caractère spécial"; ?>
                        <?php break; ?>
                    <?php
                    case "mdpnotsame": ?>
                        <?php echo "Les deux mots de passe saisies ne sont pas identiques"; ?>
                        <?php break; ?>
                    <?php
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

        <div class="col-8 text-center mt-2">
            <form method="POST" action="../../traitements/sauvegarderMdp.php">
                <div class="card card_validation">
                    <div class="card-body card_flex">
                        <div class="form-group">
                            <label for="mdp">Nouveau mot de passe :</label>
                            <input type="password" class="form-control" name="mdp" id="mdp" placeholder="Saisissez le mot de passe" value="" required>
                        </div>
                        <div class="form-group">
                            <label for="mdp">Confirmer le mot de passe :</label>
                            <input type="password" class="form-control" name="verifMdp" id="verifMdp" placeholder="Saisissez à nouveau le mot de passe" value="" required>
                        </div>

                        <div class="form-group text-center m-0">
                            <button type="submit" class="button bouton_custom" name="envoi" id="envoi" value="1">Confirmer</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
require_once "../visiteur/pied.php";
