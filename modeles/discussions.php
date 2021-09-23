<?php

function recupererDiscussions()
{
    $requete = getBDD()->prepare("SELECT * FROM discussions");
    $requete->execute();
    return $requete->fetchAll(PDO::FETCH_ASSOC);
}

function recupererDiscussion($idDiscussion)
{
    $requete = getBDD()->prepare("SELECT * FROM discussions WHERE idDiscussion = ?");
    $requete->execute([$idDiscussion]);
    return $requete->fetch(PDO::FETCH_ASSOC);
}

function creerDiscussion($idEnvoyeur, $idDestinataire)
{
    $requete = getBDD()->prepare("INSERT INTO discussions(idEnvoyeur, idDestinataire) VALUES(?, ?)");
    $requete->execute([$idEnvoyeur, $idDestinataire]);
    return true;
}

function supprimerDiscussion($idDiscussion)
{
    $requete = getBDD()->prepare("DELETE FROM discussions WHERE idDiscussion = ?");
    $requete->execute([$idDiscussion]);
    return true;
}

function modifierDiscussion($idEnvoyeur, $idDestinataire, $idDiscussion)
{
    $requete = getBDD()->prepare("UPDATE discussions SET idEnvoyeur=?, idDestinataire=? WHERE idDiscussion = ?");
    $requete->execute([$idEnvoyeur, $idDestinataire, $idDiscussion]);
    return true;
}
