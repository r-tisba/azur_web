<?php

class Message extends Modele
{
    private $idMessage;
    private $contenu;
    private $date;
    private $idEmploye;

    public function __construct($idM = null)
    {
        if ($idM !== null) {
            $requete = $this->getBdd()->prepare("SELECT * FROM messages WHERE idMessage = ?");
            $requete->execute([$idM]);
            $message = $requete->fetch(PDO::FETCH_ASSOC);

            $this->idMessage = $idM;
            $this->reponse = $message["contenu"];
            $this->validite = $message["date"];
            $this->validite = $message["idEmploye"];
        }
    }

    public function initialiserMessage($idMessage, $contenu, $date, $idEmploye)
    {
        $this->idMessage = $idMessage;
        $this->contenu = $contenu;
        $this->date = $date;
        $this->idEmploye = $idEmploye;
    }

   /* public function recupererDernierMessage($idDiscussion)
    {
        $requete = $this->getBDD()->prepare("SELECT MAX(date), contenu FROM messages WHERE idDiscussion = ?");
        $requete->execute([$idDiscussion]);
        return $requete->fetch(PDO::FETCH_ASSOC);
    }*/
    public function ajoutMessages($idDiscussion, $contenu, $idEmploye)
    {
        $requete = $this->getBDD()->prepare("INSERT INTO messages(idDiscussion, contenu, date, idEmploye) VALUES(?, ?, ?, ?)");
        $requete->execute([$idDiscussion, $contenu, date("Y-m-d H:i:s"), $idEmploye]);
        return true;
    }

    public function recupererMessages($idDiscussion)
    {
        $requete = $this->getBDD()->prepare("SELECT * FROM messages LEFT JOIN utilisateurs USING(idEmploye) LEFT JOIN discussions USING(idDiscussion)  WHERE idDiscussion = ?");
        $requete->execute([$idDiscussion]);
        $messages = $requete->fetchAll(PDO::FETCH_ASSOC);
        return $messages;
    }

    public function getIdMessage()
    {
        return $this->idMessage;
    }
    public function getContenu()
    {
        return $this->contenu;
    }
    public function getDate()
    {
        return $this->date;
    }
    public function getIdEmploye()
    {
        return $this->idEmploye;
    }

    function recupererDernierMessage($idDiscussion)
    {
        $requete = $this->getBDD()->prepare("SELECT MAX(date), contenu FROM messages WHERE idDiscussion = ?");
        $requete->execute([$idDiscussion]);
        return $requete->fetch(PDO::FETCH_ASSOC);
    }
    /*function ajoutMessages($idDiscussion, $contenu, $idEmploye)
    {
        $requete = $this->getBDD()->prepare("INSERT INTO messages(idDiscussion, contenu, date, idEmploye) VALUES(?, ?, ?, ?)");
        $requete->execute([$idDiscussion, $contenu, date("Y-m-d H:i:s"), $idEmploye]);
        return true;
    }*/

    function messages($idDiscussion)
    {
        $requete = $this->getBDD()->prepare("SELECT * FROM messages LEFT JOIN utilisateurs USING(idEmploye) LEFT JOIN discussions USING(idDiscussion)  WHERE idDiscussion = ?");
        $requete->execute([$idDiscussion]);
        $messages = $requete->fetchAll(PDO::FETCH_ASSOC);
        return $messages;
    }
}
