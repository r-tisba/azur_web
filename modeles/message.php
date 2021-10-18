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
    public function recupererMessage($idMessage)
    {
        $requete = $this->getBDD()->prepare("SELECT * FROM messages LEFT JOIN utilisateurs USING(idEmploye) LEFT JOIN discussions USING(idDiscussion)  WHERE idMessage = ?");
        $requete->execute([$idMessage]);
        $message = $requete->fetch(PDO::FETCH_ASSOC);
        return $message;
    }
    public function recupererIdDiscussionViaMessage($idMessage)
    {
        $requete = $this->getBDD()->prepare("SELECT idDiscussion FROM messages WHERE idMessage = ?");
        $requete->execute([$idMessage]);
        $idDiscussion = $requete->fetch(PDO::FETCH_ASSOC);
        return $idDiscussion;
    }

        // public function recupererDernierMessage($idDiscussion)
    // {
    //     $requete = $this->getBDD()->prepare("SELECT MAX(date), contenu FROM messages WHERE idDiscussion = ?");
    //     $requete->execute([$idDiscussion]);
    //     return $requete->fetch(PDO::FETCH_ASSOC);
    // }

    public function recupererDernierMessage($idDiscussion)
    {
        $requete = $this->getBDD()->prepare("SELECT t.contenu, max_date FROM messages t INNER JOIN
        (SELECT contenu, MAX(date) AS max_date FROM messages GROUP BY contenu) a ON a.contenu = t.contenu AND a.max_date = date AND idDiscussion = ?");
        $requete->execute([$idDiscussion]);
        return $requete->fetch(PDO::FETCH_ASSOC);
    }

    public function recupererDernierMessageFull($idDiscussion)
    {
        $requete = $this->getBDD()->prepare("SELECT t.*, u.*, d.* FROM messages t INNER JOIN
        (SELECT contenu, MAX(date) AS max_date FROM messages GROUP BY contenu) a ON a.contenu = t.contenu AND a.max_date = date
        LEFT JOIN utilisateurs u USING(idEmploye) LEFT JOIN discussions d USING(idDiscussion) WHERE idDiscussion = ?");
        $requete->execute([$idDiscussion]);
        return $requete->fetch(PDO::FETCH_ASSOC);
    }
    public function modifierMessage($contenu, $idMessage)
    {
        $requete = $this->getBDD()->prepare("UPDATE messages SET contenu = ?, dateModif = ? WHERE idMessage = ?");
        $requete->execute([$contenu, date("Y-m-d H:i:s"), $idMessage]);
        return true;

        $this->idMessage=$idMessage;
    }
    public function supprimerMessage($idMessage)
    {
        $requete = $this->getBDD()->prepare("DELETE FROM messages WHERE idMessage = ?");
        $requete->execute([$idMessage]);
        return true;
    }
    public function supprimerMessagesDiscussion($idDiscussion)
    {
        $requete = $this->getBDD()->prepare("DELETE FROM messages WHERE idDiscussion = ?");
        $requete->execute([$idDiscussion]);
        return true;
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
}
