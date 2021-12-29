<?php
require_once "../visiteur/entete.php";
?>

<!-- MESSAGE D'ACCUEIL SI PAS CONNECTE -->
<section class="text-center container">
    <div class="row py-2">
        <div class="col-lg-6 col-md-8 mx-auto">
            <h1 class="titre_accueil">Azur</h1>
            <p class="lead text-petit">Vous devez être connecté pour utiliser l'application</p>
        </div>
    </div>
</section>

<!-- MESSAGE POST-CONNEXION -->
<?php if (!empty($_GET["success"]))
{
    if ($_GET["success"] == "connexion")
    {
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
    <div class="alert alert-danger alert_connexion mt-3">
        <?php switch ($_GET["error"]) {
            case "falsemdp": ?>
                <?php echo "Mot de passe incorrect"; ?>
                <?php break; ?>
            <?php
            case "falseid": ?>
                <?php echo "L'identifiant n'existe pas"; ?>
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

<!-- MESSAGE SI TOKEN -->
<?php
if($tokenBool == true)
{
    ?>
    <div class="alert alert-success alert_connexion mt-3">Vous avez été connecté automatiquement via les cookies<br>
        Vous allez être redirigé vers la page d'accueil<br>
        <a href="../utilisateur/index.php">Cliquez ici pour une redirection manuelle</a>
    </div>
    <?php
    $service->redirect("../utilisateur/index.php");
}
?>

<!-- FORMULAIRE DE CONNEXION -->
<form method="post" action="../traitements/sauvegarderConnexion.php">
    <div class="col-12 text-center my-4">
        <div class="card card_connexion">
            <div class="card-body">
                <div class="form-group">
                    <label for="identifiant">Identifiant :</label>
                    <input type="text" class="form-control" name="identifiant" id="identifiant" placeholder="Saisissez votre identifiant"
                    value="<?= $tokenBool == true ? htmlspecialchars($identifiant, ENT_QUOTES) : "" ?>" required />
                </div>
                <div class="form-group mb-3">
                    <label for="mdp">Mot de passe :</label>
                    <input type="password" class="form-control" name="mdp" id="mdp" placeholder="Saisissez votre mot de passe"
                    value="" required />
                </div>
                <div class="form-group mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="checkbox_token" id="checkbox_token" value="true">
                        <label class="form-check-label" for="checkbox_token">
                            Se souvenir de moi
                        </label>
                    </div>
                </div>
                <div class="form-group text-center m-0">
                    <button type="submit" class="btn btn-outline-primary" name="envoi" id="envoi" value="1">Connexion</button>
                </div>
            </div>
        </div>
    </div>
</form>

<?php
require_once "../visiteur/pied.php";