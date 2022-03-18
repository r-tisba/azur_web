<?php
require_once "../services/fonctions.php";
$service = new Service();
$service->myRequireOnce("modeles/modele.php");
$objetUtilisateur = new Utilisateur();
// 1 == IP Valide, 2 == IP Admin non enregistrée, 3 == IP Bannie
$ipValide = 1;

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
            if (password_verify($mdp, $utilisateur["mdp"])) {

                // Si l'utilisateur est admin ou superAdmin, on vérifie que l'adresse IP est autorisée
                if ($utilisateur["role"] == "Admin" || $utilisateur["role"] == "SuperAdmin") {
                    $ipAutorisees = $objetUtilisateur->recupererIpAutoriseesUtilisateur($utilisateur["idUtilisateur"]);
                    $ipValide = 2;

                    foreach ($ipAutorisees as $ipAutorisee) {
                        $ipAutorisee['ip'] == $_SERVER['REMOTE_ADDR'] ? $ipValide = 1 : '';
                    }
                }
                // Vérifier que l'ip n'est pas bannie
                if($objetUtilisateur->verifierBannissementUtilisateur($_SERVER['REMOTE_ADDR'])) {
                    $ipValide = 3;
                }
                // Vérification de si l'adresse IP est valide
                if ($ipValide == 1) {
                    // On connecte l'utilisateur
                    @session_start();
                    $_SESSION["identifiant"] = $identifiant;
                    $_SESSION["role"] = $utilisateur["role"];
                    $_SESSION["idUtilisateur"] = $utilisateur["idUtilisateur"];

                    // Ajout de la connexion dans les logs
                    $objetUtilisateur->ajoutLogConnexion($_SESSION["idUtilisateur"]);

                    if (isset($_POST["checkbox_token"]) && $_POST["checkbox_token"] == "true") {
                        // Si le token n'existe pas pour l'utilisateur
                        if ($objetUtilisateur->verifierToken($identifiant) == false) {
                            $valide = false;
                            $length = 15;

                            while ($valide != true) {
                                $token = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, $length);
                                // Vérfication de si le token à bien au moins un chiffre
                                if (preg_match('~[0-9]+~', $token)) {
                                    $valide = true;
                                } else {
                                }
                            }
                            $objetUtilisateur->creerToken($token, $identifiant);
                        } else {
                            // Le token existe déjà
                            $resultat = $objetUtilisateur->recupererToken($identifiant);
                            $token = $resultat["token"];
                        }
                        // Création du cookie association id/token
                        setcookie('id-token', $_SESSION["idUtilisateur"] . '-' . $token, time() + 3600 * 262980, '/', '', false, true);
                    }
                    $service->redirectNow("../vues/visiteur/index.php?success=connexion");

                    ?>
                    <div class="alert alert-success mt-3">
                        Vous êtes connecté<br>
                        Vous allez être redirigé vers la page d'accueil<br>
                        <a href="../vues/visiteur/index.php">Cliquez ici pour une redirection manuelle</a>
                    </div>
                    <?php
                    $service->redirect("../vues/visiteur/index.php");
                } else {
                    if($ipValide == 2) { $service->redirectNow("../vues/visiteur/index.php?error=invalidip2"); }
                    else { $service->redirectNow("../vues/visiteur/index.php?error=invalidip3"); }
                }
            } else {
                $service->redirectNow("../vues/visiteur/index.php?error=falselogin");
            }
        } else {
            $service->redirectNow("../vues/visiteur/index.php?error=falselogin");
        }
    } else {
        $service->redirectNow("../vues/visiteur/index.php?error=missing");
    }
} else {
    $service->redirectNow("location:/");
}
