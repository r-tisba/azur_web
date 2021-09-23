<?php
require_once "../visiteur/entete.php";

if (isset($_SESSION["identifiant"])) {
    header("location:../admin/index.php");
}

?>

<!-- MESSAGE D'ACCUEIL SI PAS CONNECTE -->
<section class="text-center container">
    <div class="row py-2">
        <div class="col-lg-6 col-md-8 mx-auto">
            <h1 class="titre_accueil">Azur<h1>
                    <p class="lead text-muted">Vous devez être connecté pour utiliser l'application</p>
        </div>
    </div>
</section>

<!-- MESSAGE POST-CONNEXION -->
<div class="container">
    <?php if (!empty($_GET["success"]) && $_GET["success"] == "connexion") {
    ?>
        <div class="alert alert-success alert_connexion mt-3">Vous avez bien été connecté <br>
            Vous allez être redirigé vers la page d'accueil<br>
            <a href="index.php">Cliquez ici pour une redirection manuelle</a>
        </div>
    <?php
        header("refresh:5;index.php");
    }
    ?>
    <?php if (!empty($_GET["error"])) {
    ?>
        <div class="alert alert-danger alert_connexion mt-3">
            <?php switch ($_GET["error"]) {
                case "falsemdp": ?>
                    <?php echo "Le mot de passe n'existe pas"; ?>
                    <?php break; ?>
                <?php
                case "falseid": ?>
                    <?php echo "L'identifiant n'existe pas"; ?>
                    <?php break; ?>
                <?php
                case "mdplength": ?>
                    <?php echo "Le mot de passe doit faire au moins 6 caractères"; ?>
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

    <!-- FORMULAIRE DE CONNEXION -->
    <form method="post" action="../traitements/sauvegarderConnexion.php">
        <div class="col-12 text-center">
            <div class="col-12 align-self-center">
                <div class="card card-body card_connexion">
                    <div class="form-group">
                        <label for="identifiant">Identifiant :</label>
                        <input type="text" class="form-control" name="identifiant" id="identifiant" placeholder="Saisissez votre identifiant" value="<?= (isset($_POST["identifiant"]) ? $_POST["identifiant"] : "") ?>" required />
                    </div>
                    <div class="form-group mb-4">
                        <label for="mdp">Mot de passe :</label>
                        <input type="password" class="form-control" name="mdp" id="mdp" placeholder="Saisissez votre mot de passe" required />
                    </div>
                    <div class="form-group text-center ">
                        <button type="submit" class="btn btn-outline-primary" name="envoi" id="envoi" value="1">Connexion</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>