<?php
require_once "../utilisateur/entete.php";
require_once "../modeles/modele.php";
?>
<div class="container">
    <div class="row row_modifAvatar">
        <div class="col-8">
            <?php
            if (!empty($_GET["success"]) && $_GET["success"] == "modification") {
            ?>
                <div class="alert alert-success">
                    La photo de profil a bien été modifiée<br>
                    Vous allez être redirigé vers votres profil<br>
                    <a href="../utilisateur/profil.php">Cliquez ici pour une redirection manuelle</a>
                </div>
            <?php
                header("refresh:3;../utilisateur/profil.php");
            }

            if (!empty($_GET["error"])) {
            ?>
                <div class="alert alert-danger mt-3">
                    <?php switch ($_GET["error"]) {
                        case "missing": ?>
                            <?php echo "Le document n'est pas une image"; ?>
                            <?php break; ?>
                        <?php
                        case "taille": ?>
                            <?php echo "L'image est trop lourde séléctionnez une image qui ne dépasse pas 3Mo"; ?>
                            <?php break; ?>
                        <?php
                        case "type": ?>
                            <?php echo "L'image doit être en format jpeg ou png"; ?>
                            <?php break; ?>
                        <?php
                        case "fichier": ?>
                            <?php echo "Une erreur s'est produite lors du chargement de l'image"; ?>
                            <?php break; ?>
                        <?php
                        case "ajout": ?>
                            <?php echo "Une erreur s'est produite lors de la modification de votre photo de profil"; ?>
                            <?php break; ?>
                        <?php
                        case "image": ?>
                            <?php echo "Le document n'est pas une image"; ?>
                            <?php break; ?>
                    <?php
                    }
                    ?>
                </div>
            <?php
            }
            ?>

            <div class="card p-0">
                <div class="card-header">
                    <h3 class="titreOutil" style="margin: 0">Charger une image</h3>
                </div>
                <div class="card-body py-0 px-3">
                    <form action="../traitements/modifierAvatar.php" method="post" enctype="multipart/form-data">
                        <div class="row row_form_modifAvatar">
                            <div class="div_import_image">
                                <input type="file" name="image" />
                            </div>
                            <div class="text-center">
                                <button class="btn btn-outline-primary align-center" type="submit">Modifier la photo de profil</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require_once "pied.php";
