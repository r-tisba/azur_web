<?php
require_once "../modeles/modele.php";
$objetUtilisateur = new Utilisateur();
if (isset($_POST["envoi"]) && !empty($_POST["envoi"]) && $_POST["envoi"] == 1) {
    extract($_POST);

    // Vérification que les inputs aient été remplit
    if (isset($identifiant) || !empty($identifiant) && isset($mdp) || !empty($mdp) && isset($captcha)|| isset($captcha)) {
        $requete = $objetUtilisateur->recupererInfosConnexion($identifiant);

        // Vérification si l'identifiant existe pas
        if ($requete->rowCount() > 0) {
            // L'identifiant existe
            $utilisateur = $requete->fetch(PDO::FETCH_ASSOC);

            // Vérifier si les mots de passe correspondent
            if (password_verify($mdp, $utilisateur["mdp"])) {
                // On connecte l'utilisateur
                @session_start();
                $_SESSION["identifiant"] = $identifiant;
                $_SESSION["role"] = $utilisateur["role"];
                $_SESSION["idUtilisateur"] = $utilisateur["idUtilisateur"];


                header("location:../visiteur/index.php?success=connexion");

                ?>
                <div class="alert alert-success mt-3">
                    Vous êtes connecté<br>
                    Vous allez être redirigé vers la page d'accueil<br>
                    <a href="../visiteur/index.php">Cliquez ici pour une redirection manuelle</a>
                </div>
                <?php
                header("refresh:4;../visiteur/index.php");
            } else {
                header("location:../visiteur/index.php?error=falsemdp");
            }
        } else {
            header("location:../visiteur/index.php?error=falseid");
        }
    } else {
        header("location:../visiteur/index.php?error=missing");
    }
} else {
    header("location:/");
}
