<?php
/*
function soldeEntreprise()
{

    $requete= getBDD()->prepare("SELECT SUM(gains) FROM revenus WHERE date<NOW()");
    $requete->execute();
    $revenu = $requete->fetch(PDO::FETCH_ASSOC);

    $requete=getBDD()->prepare("SELECT SUM(depense), date FROM depenses WHERE date<NOW()");
    $requete->execute();
    $depense = $requete->fetch(PDO::FETCH_ASSOC);

    $requete=getBDD()->prepare("SELECT SUM(salaire) FROM utilisateurs");
    $requete->execute();
    $salaire = $requete->fetch(PDO::FETCH_ASSOC);

    $compte = $revenu["SUM(gains)"] - $depense["SUM(depense)"] - $salaire["SUM(salaire)"];
    return $compte;

}