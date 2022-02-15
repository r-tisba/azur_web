<?php
require_once "../visiteur/entete.php";
?>

<div class="container connexion_container">
    <h1 class="titre_accueil mb-4">Connexion</h1>
    <?php if (!empty($_GET["success"]) && $_GET["success"] == "connexion")
    {
        
        ?>
        <div class="alert alert-success mt-3">Vous avez bien été connecté <br>
            Vous allez être redirigé vers la page d'accueil<br>
            <a href="../test.php">Cliquez ici pour une redirection manuelle</a>
            
        </div>
    <?php
        header("refresh:5;../test.php");
    }
    ?>
    <?php if (!empty($_GET["error"])) {
    ?>
        <div class="alert alert-danger mt-3">
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
    <form action="javascript:alert(grecaptcha.getResponse(widgetId1));">
      <div id="example1"></div>
      <br>
      <input type="submit" value="getResponse">
    </form>
    <br>
    <!-- Resets reCAPTCHA widgetId2 upon submit. -->
    <form action="javascript:grecaptcha.reset(widgetId2);">
      <div id="example2"></div>
      <br>
      <input type="submit" value="reset">
    </form>
    <br>
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
                    <div id="captcha"></div>

                </div>
            </div>
        </div>
    </form>
    
    
    
</div>