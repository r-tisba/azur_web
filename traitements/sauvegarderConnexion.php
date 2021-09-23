<?php
require_once "../modeles/modele.php";

if(isset($_POST["envoi"]) && !empty($_POST["envoi"]) && $_POST["envoi"] == 1)
{
    extract($_POST);

    // Vérification que les inputs aient été remplit
    if (isset($identifiant) || !empty($identifiant) && isset($mdp) || !empty($mdp))
    {
        // Vérification que le mot de passe fait au moins 6 caractères
        if(strlen($_POST["mdp"]) >= 6)
        {
            $requete = recupererInfosConnexion($identifiant);

            // Vérification si l'identifiant existe pas
            if($requete->rowCount() > 0)
            {
                // L'identifiant existe
                $utilisateur = $requete->fetch(PDO::FETCH_ASSOC);

                // Vérifier si les mots de passe correspondent
                if(password_verify($mdp, $utilisateur["mdp"]))
                {
                    // On connecte l'utilisateur
                    @session_start();
                    $_SESSION["identifiant"] = $identifiant;
                    $_SESSION["idRole"] = $utilisateur["idRole"];
                    $_SESSION["idEmploye"] = $utilisateur["idEmploye"];

                    header("location:/visiteur/connexion.php?success=connexion");

                    ?>
                    <div class="alert alert-success mt-3">
                    Vous êtes connecté<br>
                    Vous allez être redirigé vers la page d'accueil<br>
                    <a href="/visiteur/connexion.php">Cliquez ici pour une redirection manuelle</a>
                    </div>
                    <?php
                    header("refresh:4;/visiteur/connexion.php");

                } else {
                    header("location:/visiteur/connexion.php?error=falsemdp");
            }
            } else {
                header("location:/visiteur/connexion.php?error=falseid");
            }
        } else {
            header("location:/visiteur/connexion.php?error=mdplength");
        }
    } else {
        header("location:/visiteur/connexion.php?error=missing");
    } 
} else {
    header("location:/");
}