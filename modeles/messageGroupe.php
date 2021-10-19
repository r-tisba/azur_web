<?php

class Message_Groupe extends Modele
{
    private $idMessageGroupe;
    private $contenu;
    private $date;
    private $idEmploye;

    public function __construct($idM = null)
    {
        if ($idM !== null) {
            $requete = $this->getBdd()->prepare("SELECT * FROM messagesgroupe WHERE idMessageGroupe = ?");
            $requete->execute([$idM]);
            $message = $requete->fetch(PDO::FETCH_ASSOC);

            $this->idMessageGroupe = $idM;
            $this->reponse = $message["contenu"];
            $this->validite = $message["date"];
            $this->validite = $message["idEmploye"];
        }
    }

    public function initialiserMessage($idMessageGroupe, $contenu, $date, $idEmploye)
    {
        $this->idMessageGroupe = $idMessageGroupe;
        $this->contenu = $contenu;
        $this->date = $date;
        $this->idEmploye = $idEmploye;
    }
    public function ajoutMessages($idEquipe, $contenu, $idEmploye)
    {
        $requete = $this->getBDD()->prepare("INSERT INTO messagesgroupe(idEquipe, contenu, date, idEmploye) VALUES(?, ?, ?, ?)");
        $requete->execute([$idEquipe, $contenu, date("Y-m-d H:i:s"), $idEmploye]);
        return true;
    }

    public function messagesgroupe($idEquipe, $contenu, $idEmploye)
    {
        $requete = $this->getBDD()->prepare("INSERT INTO messagesgroupe(idEquipe, contenu, date, idEmploye) VALUES(?, ?, ?, ?)");
        $requete->execute([$idEquipe, $contenu, date("Y-m-d H:i:s"), $idEmploye]);
        return true;
    }


    public function recupererMessages($idEquipe)
    {
        $requete = $this->getBDD()->prepare("SELECT * FROM messagesgroupe LEFT JOIN utilisateurs USING(idEquipe, idEmploye) WHERE idEquipe = ?");
        $requete->execute([$idEquipe]);
        $messagesgroupe = $requete->fetchAll(PDO::FETCH_ASSOC);
        return $messagesgroupe;
    }

    public function recupererMessage($idMessageGroupe)
    {
        $requete = $this->getBDD()->prepare("SELECT * FROM messagesgroupe LEFT JOIN utilisateurs USING(idEmploye, idEquipe)  WHERE idMessageGroupe = ?");
        $requete->execute([$idMessageGroupe]);
        $message = $requete->fetch(PDO::FETCH_ASSOC);
        return $message;
    }
    public function recupereridEquipeViaMessage($idMessageGroupe)
    {
        $requete = $this->getBDD()->prepare("SELECT idEquipe FROM messagesgroupe WHERE idMessageGroupe = ?");
        $requete->execute([$idMessageGroupe]);
        $idEquipe = $requete->fetch(PDO::FETCH_ASSOC);
        return $idEquipe;
    }
    public function recupererDernierMessage($idEquipe)
    {
        $requete = $this->getBDD()->prepare("SELECT t.contenu, max_date FROM messagesgroupe t INNER JOIN
        (SELECT contenu, MAX(date) AS max_date FROM messagesgroupe GROUP BY contenu) a ON a.contenu = t.contenu AND a.max_date = date AND idEquipe = ?");
        $requete->execute([$idEquipe]);
        return $requete->fetch(PDO::FETCH_ASSOC);
    }

    public function recupererDernierMessageFull($idEquipe)
    {
        $requete = $this->getBDD()->prepare("SELECT t.*, u.*, d.* FROM messagesgroupe t INNER JOIN
        (SELECT contenu, MAX(date) AS max_date FROM messagesgroupe GROUP BY contenu) a ON a.contenu = t.contenu AND a.max_date = date
        LEFT JOIN utilisateurs u USING(idEmploye) LEFT JOIN discussions_groupe d USING(idEquipe) WHERE idEquipe = ?");
        $requete->execute([$idEquipe]);
        return $requete->fetch(PDO::FETCH_ASSOC);
    }
    public function modifierMessage($contenu, $idMessageGroupe)
    {
        $requete = $this->getBDD()->prepare("UPDATE messagesgroupe SET contenu = ?, dateModif = ? WHERE idMessageGroupe = ?");
        $requete->execute([$contenu, date("Y-m-d H:i:s"), $idMessageGroupe]);
        return true;

        $this->idMessageGroupe=$idMessageGroupe;
    }
    public function supprimerMessage($idMessageGroupe)
    {
        $requete = $this->getBDD()->prepare("DELETE FROM messagesgroupe WHERE idMessageGroupe = ?");
        $requete->execute([$idMessageGroupe]);
        return true;

        $this->idCategorie=$idMessageGroupe;
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