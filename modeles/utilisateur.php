<?php

function recupererUtilisateurs()
{
    $requete = getBDD()->prepare("SELECT * FROM utilisateurs");
    $requete->execute();
    return $requete->fetchAll(PDO::FETCH_ASSOC);
}

function recupererUtilisateur($idEmploye)
{
    $requete = getBDD()->prepare("SELECT * FROM utilisateurs WHERE idEmploye = ?");
    $requete->execute([$idEmploye]);
    return $requete->fetch(PDO::FETCH_ASSOC);
}

function recupererInfosConnexion($identifiant)
{
    $requete = getBDD()->prepare("SELECT idEmploye, identifiant, mdp, idRole FROM utilisateurs WHERE identifiant = ?");
    $requete->execute([$identifiant]);
    return $requete;
}

function recupererSecteursRolesUtilisateurs()
{
    $requete = getBDD()->prepare("SELECT * FROM utilisateurs INNER JOIN secteurs USING(idSecteur) INNER JOIN roles USING(idRole)");
    $requete->execute();
    return $requete->fetchAll(PDO::FETCH_ASSOC);
}

function mailUnique($email)
{
    $requete = getBDD()->prepare("SELECT email FROM utilisateurs WHERE email = ?");
    $requete->execute([$email]);
    return $requete;
}

function creerUtilisateur($nom, $prenom, $poste, $idSecteur, $mdp)
{
    $salaire = 0;
    $idRole = 1;
    $identifiant = strtolower($prenom) . "." . strtolower($nom);
    
    $requete = getBDD()->prepare("INSERT INTO 
    utilisateurs(nom, prenom, poste, salaire, idSecteur, identifiant, mdp, idRole)
    VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
    $requete->execute([$nom, $prenom, $poste, $salaire, $idSecteur, $identifiant, $mdp, $idRole]);
    return true;
}

function modifierUtilisateur($idEmploye, $nom, $prenom, $poste, $salaire, $idSecteur, $idRole)
{
    $identifiant = strtolower($prenom) . "." . strtolower($nom);
    $requete = getBDD()->prepare("UPDATE utilisateurs SET nom = ?, prenom = ?, poste = ?, salaire = ?, idSecteur = ?, identifiant=?, idRole=? WHERE idEmploye = ?");
    $requete->execute([$nom, $prenom, $poste, $salaire, $idSecteur, $identifiant, $idRole, $idEmploye]);
    return true;
}

function supprimerUtilisateur($idUtilisateur)
{
    $requete = getBDD()->prepare("DELETE FROM utilisateurs 
    WHERE idUtilisateur = ?");
    $requete->execute([$idUtilisateur]);
    return true;
}

function dateFr($date)
{
    if($datetime = DateTime::createfromformat("Y-m-d H:i:s", $date)){
        return $date = $datetime->format("d/m/Y à H:i");
    } else if($datetime = DateTime::createfromformat("Y-m-d", $date)){
        return $date = $datetime->format("d/m/Y");
    }
}
