<?php

function recupererSecteurs()
{
    $requete = getBDD()->prepare("SELECT * FROM secteurs");
    $requete->execute();
    return $requete->fetchAll(PDO::FETCH_ASSOC);
}

function recupererSecteur($idSecteur)
{
    $requete = getBDD()->prepare("SELECT * FROM secteurs WHERE idSecteur = ?");
    $requete->execute([$idSecteur]);
    return $requete->fetch(PDO::FETCH_ASSOC);
}

function creerSecteur($nomSecteur, $budget)
{
    $requete = getBDD()->prepare("INSERT INTO secteurs(nomSecteur, budget) VALUES(?, ?)");
    $requete->execute([$nomSecteur, $budget]);
    return true;
}

function modifierSecteur($idSecteur, $nomSecteur, $budget)
{
    $requete = getBDD()->prepare("UPDATE secteurs SET nomSecteur = ?, budget = ? WHERE idSecteur = ?");
    $requete->execute([$nomSecteur, $budget, $idSecteur]);
    return true;
}

function supprimerSecteur($idSecteur)
{
    $requete = getBDD()->prepare("DELETE FROM secteurs WHERE idSecteur = ?");
    $requete->execute([$idSecteur]);
    return true;
}