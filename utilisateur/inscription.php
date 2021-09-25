<?php
require_once "../utilisateur/entete.php";
$objetSecteur = new Secteur();
?>

<div class="container">
    <h1>Inscription</h1>

    <?php if (!empty($_GET["success"]) && $_GET["success"] == "inscription")
    {
        ?>
        <div class="alert alert-success mt-2">Vous avez bien été inscrit <br>
        Vous allez être redirigé vers l'accueil</div>
    <?php
    header("refresh:4;../utilisateur/index.php");
    }
    ?>
    <?php if (!empty($_GET["error"]))
    {
    ?>
        <div class="alert alert-danger mt-2">
        <?php switch ($_GET["error"])
        {
            case "inscriptionsave": ?>
                <?php echo "Une erreur s'est produite lors de l'enregistrement"; ?>
                <?php break;?>
            <?php case "mdplength": ?>
                <?php echo "Le mot de passe doit faire au moins 6 caractères"; ?>
                <?php break;?>
            <?php case "mdpnotsame": ?>
                <?php echo "Les deux mots de passe saisies ne sont pas identiques"; ?>
                <?php break;?>
            <?php case "missing": ?>
                <?php echo "Au moins un champ n'a pas été saisi"; ?>
                <?php break;?>
        <?php
        }
        ?>
        </div>
    <?php
    }
    ?>

    <form method="post" action="../traitements/sauvegarderInscription.php">
        <div class="form-group">
            <label for="nom">Nom :</label>
            <input type="text" class="form-control" name="nom" id="nom" placeholder="Saisissez votre nom" value="<?=(isset($_POST["nom"]) ? $_POST["nom"] : "")?>" required/>
        </div>

        <div class="form-group">
            <label for="prenom">Prénom :</label>
            <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Saisissez votre prénom" value="<?=(isset($_POST["prenom"]) ? $_POST["prenom"] : "")?>" required/>
        </div>

        <div class="form-group">
            <label for="poste">Poste :</label>
            <input type="text" class="form-control" name="poste" id="poste" placeholder="Saisissez votre poste" value="<?=(isset($_POST["poste"]) ? $_POST["poste"] : "")?>" required/>
        </div>

        <div class="form-group">
            <label for="idSecteur">Secteur :</label>
            <select name="idSecteur" id="idSecteur" class="form-control">
            <?php
                $secteurs = $objetSecteur->recupererSecteurs();
                foreach ($secteurs as $secteur)
                {
                    ?>
                    <option value="<?=$secteur["idSecteur"];?>">
                    <?=$secteur["nomSecteur"];?>
                    </option>
                    <?php
                }
            ?>
            </select>
        </div>
        <div class="form-group">
            <label for="mdp">Mot de passe (6 caractères minimum):</label>
            <input type="password" class="form-control" name="mdp" id="mdp" placeholder="Créer votre mot de passe" required/>
        </div>
        <div class="form-group">
            <label for="verifMdp">Vérifier votre mot de passe :</label>
            <input type="password" class="form-control" name="verifMdp" id="verifMdp" placeholder="Saisissez à nouveau votre mot de passe" required/>
        </div>

        <div class="form-group text-center">
            <button type="submit" class="btn btn-outline-primary" name="envoi" id="envoi" value="1">S'inscrire !</button>
        </div>
    </form>
</div>
