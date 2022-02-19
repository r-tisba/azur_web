<?php
require_once "../../services/fonctions.php";
$service = new Service();
$service->myRequireOnce("modeles/modele.php");
$objetUtilisateur = new Utilisateur();
session_start();

// Vérification que les données requises aient été entrées dans le formulaire
if (!empty($_POST["mdp"]) && !empty($_POST["verifMdp"]))
{
    $inputMdp = $_POST["mdp"];
    // Vérification que le mot de passe fait au moins 8 caractères
    if (strlen($inputMdp) >= 8)
    {
        // Vérification que le mot de passe fait au moins 1 lettre
        if (preg_match("/[a-z]/i", $inputMdp))
        {
            // Vérification que le mot de passe fait au moins 1 majuscule
            if (preg_match("/[A-Z]/", $inputMdp))
            {
                // Vérification que le mot de passe fait au moins 1 chiffre
                if (preg_match('~[0-9]+~', $inputMdp))
                {
                    // Vérification que le mot de passe fait au moins 1 caractère spécial
                    if (preg_match('/[\'^£$%&*()}{@#~?!><>,|=_+¬-]/', $inputMdp))
                    {
                        // Vérification que les 2 mots de passe correspondent
                        if ($inputMdp == $_POST["verifMdp"])
                        {
                            $mdp = password_hash($inputMdp, PASSWORD_BCRYPT);
                            if ($objetUtilisateur->validerUtilisateur($_SESSION["idUtilisateur"], $mdp) == true)
                            {
                                $service->redirectNow("../vues/utilisateur/validationMdp.php?success=validation");
                            } else {
                                $service->redirectNow("../vues/utilisateur/validationMdp.php?error=validationsave");
                            }
                        } else {
                            $service->redirectNow("../vues/utilisateur/validationMdp.php?error=mdpnotsame");
                        }
                    } else {
                        $service->redirectNow("../vues/utilisateur/validationMdp.php?error=mdpspechar");
                    }
                } else {
                    $service->redirectNow("../vues/utilisateur/validationMdp.php?error=mdpdigit");
                }
            } else {
                $service->redirectNow("../vues/utilisateur/validationMdp.php?error=mdpcaps");
            }
        } else {
            $service->redirectNow("../vues/utilisateur/validationMdp.php?error=mdpletter");
        }
    } else {
        $service->redirectNow("../vues/utilisateur/validationMdp.php?error=mdplength");
    }
} else {
    $service->redirectNow("../vues/utilisateur/validationMdp.php?error=missing");
}
