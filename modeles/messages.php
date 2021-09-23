<?php

function recupererDernierMessage($idDiscussion)
{
    $requete = getBDD()->prepare("SELECT MAX(date), contenu FROM messages WHERE idDiscussion = ?");
    $requete->execute([$idDiscussion]);
    return $requete->fetch(PDO::FETCH_ASSOC);
}
function ajoutMessages($idDiscussion, $contenu, $idEmploye){
    $requete = getBDD()->prepare("INSERT INTO messages(idDiscussion, contenu, date, idEmploye) VALUES(?, ?, ?, ?)");
    $requete->execute([$idDiscussion,$contenu, date("Y-m-d H:i:s"), $idEmploye]);
    return true;
        
}

function messages($idDiscussion){
    $requete = getBDD()->prepare("SELECT * FROM messages LEFT JOIN utilisateurs USING(idEmploye) LEFT JOIN discussions USING(idDiscussion)  WHERE idDiscussion = ?");
    $requete->execute([$idDiscussion]);
    $messages = $requete->fetchAll(PDO::FETCH_ASSOC);
    return $messages;
}
