<?php
function recupererRoles()
{
    $requete = getBDD()->prepare("SELECT * FROM roles");
    $requete->execute();
    return $requete->fetchAll(PDO::FETCH_ASSOC);
}

function recupererRole($idRole)
{
    $requete = getBDD()->prepare("SELECT * FROM roles WHERE idRole = ?");
    $requete->execute([$idRole]);
    return $requete->fetch(PDO::FETCH_ASSOC);
}