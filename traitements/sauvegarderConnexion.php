<?php
require_once "../modeles/modele.php";
$service = new Service();
$objetUtilisateur = new Utilisateur();

if (isset($_POST["envoi"]) && !empty($_POST["envoi"]) && $_POST["envoi"] == 1) {
    extract($_POST);

    // Vérification que les inputs aient été remplit
    if (isset($identifiant) || !empty($identifiant) && isset($mdp) || !empty($mdp)) {
        $requete = $objetUtilisateur->recupererInfosConnexion($identifiant);

        // Vérification si l'identifiant existe pas
        if ($requete->rowCount() > 0) {
            // L'identifiant existe
            $utilisateur = $requete->fetch(PDO::FETCH_ASSOC);

            // Vérifier si les mots de passe correspondent
            if (password_verify($mdp, $utilisateur["mdp"]))
            {
                // On connecte l'utilisateur
                @session_start();
                $_SESSION["identifiant"] = $identifiant;
                $_SESSION["role"] = $utilisateur["role"];
                $_SESSION["idUtilisateur"] = $utilisateur["idUtilisateur"];

                if(isset($_POST["checkbox_token"]) && $_POST["checkbox_token"] == "true")
                {
                    // Si le token n'existe pas pour l'utilisateur
                    if($objetUtilisateur->verifierToken($identifiant) == false)
                    {
                        $valide = false;
                        $length = 15;

                        while($valide != true)
                        {
                            $token = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$length);
                            // Vérfication de si le token à bien au moins un chiffre
                            if (preg_match('~[0-9]+~', $token)) { $valide = true; }
                            else { }
                        }
                        $objetUtilisateur->creerToken($token, $identifiant);
                    }
                    else
                    {
                        // Le token existe déjà
                        $resultat = $objetUtilisateur->recupererToken($identifiant);
                        $token = $resultat["token"];
                    }
                    // Création du cookie association id/token
                    setcookie('id-token', $_SESSION["idUtilisateur"] . '-' . $token, time() + 3600 * 262980, '/', '', false, true);

                }
                $service->redirectNow("../visiteur/index.php?success=connexion");

                ?>
                <div class="alert alert-success mt-3">
                    Vous êtes connecté<br>
                    Vous allez être redirigé vers la page d'accueil<br>
                    <a href="../visiteur/index.php">Cliquez ici pour une redirection manuelle</a>
                </div>
                <?php
                $service->redirect("../visiteur/index.php");
            } else {
                $service->redirectNow("../visiteur/index.php?error=falselogin");
            }
        } else {
            $service->redirectNow("../visiteur/index.php?error=falselogin");
        }
    } else {
        $service->redirectNow("../visiteur/index.php?error=missing");
    }
} else {
    $service->redirectNow("location:/");
}
