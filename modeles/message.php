<?php

class Message extends Modele
{
    private $idMessage;
    private $contenu;
    private $date;
    private $idUtilisateur;

    public function __construct($idM = null)
    {
        if ($idM !== null) {
            $requete = $this->getBdd()->prepare("SELECT * FROM messages WHERE idMessage = ?");
            $requete->execute([$idM]);
            $message = $requete->fetch(PDO::FETCH_ASSOC);

            $this->idMessage = $idM;
            $this->contenu = $message["contenu"];
            $this->date = $message["date"];
        }
    }

    public function initialiserMessage($idMessage, $contenu, $date, $idUtilisateur)
    {
        $this->idMessage = $idMessage;
        $this->contenu = $contenu;
        $this->date = $date;
        $this->idUtilisateur = $idUtilisateur;
    }

    public function ajoutMessages($idDiscussion, $contenu, $idUtilisateur)
    {
        $requete = $this->getBDD()->prepare("INSERT INTO messages(idDiscussion, contenu, date, idUtilisateur) VALUES(?, ?, ?, ?)");
        $requete->execute([$idDiscussion, $contenu, date("Y-m-d H:i:s"), $idUtilisateur]);
        return true;
    }


    public function recupererMessages($idDiscussion)
    {
        $requete = $this->getBDD()->prepare("SELECT * FROM messages LEFT JOIN utilisateurs USING(idUtilisateur) LEFT JOIN discussions USING(idDiscussion)  WHERE idDiscussion = ?");
        $requete->execute([$idDiscussion]);
        $messages = $requete->fetchAll(PDO::FETCH_ASSOC);
        return $messages;
    }

    public function recupererMessage($idMessage)
    {
        $requete = $this->getBDD()->prepare("SELECT * FROM messages LEFT JOIN utilisateurs USING(idUtilisateur) LEFT JOIN discussions USING(idDiscussion)  WHERE idMessage = ?");
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

    // public function recupererDernierMessage($idDiscussion)
    // {
    //     $requete = $this->getBDD()->prepare("SELECT m1.date, m1.contenu, m1.idMessage FROM messages m1 INNER JOIN
    //     (SELECT max(date) date, idMessage FROM messages GROUP BY idMessage) m2
    //     ON m1.idMessage = m2.idMessage AND m1.date = m2.date; AND idDiscussion = ?");
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
        LEFT JOIN utilisateurs u USING(idUtilisateur) LEFT JOIN discussions d USING(idDiscussion) WHERE idDiscussion = ?");
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
    public function getidUtilisateur()
    {
        return $this->idUtilisateur;
    }
}
