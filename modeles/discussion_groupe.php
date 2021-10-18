<?php

class Discussion_Groupe extends Modele
{
    private $idEquipe;
    private $idEmploye;
    private $idDestinataire;

    private $discussion = [];

    public function __construct($idD = null)
    {
        if ($idD !== null) {
            $sqlEnv = "SELECT * FROM discussions_groupe WHERE idEmploye = ?";
            $sqlDes = "SELECT * FROM discussions_groupe WHERE idDestinataire = ?";

            $requete = $this->getBdd()->prepare($sqlEnv);
            $requete->execute([$idD]);
            $discussionE = $requete->fetch(PDO::FETCH_ASSOC);
            if(empty($discussionE)) { $discussionE = []; }

            $requete = $this->getBdd()->prepare($sqlDes);
            $requete->execute([$idD]);
            $discussionD = $requete->fetch(PDO::FETCH_ASSOC);
            if(empty($discussionD)) { $discussionD = []; }

            $discussion = array_merge($discussionE, $discussionD);

            $this->idEquipe = $idD;
            $this->idEmploye = $discussion["idEmploye"];
            $this->idDestinataire = $discussion["idDestinataire"];

            $requete = $this->getBdd()->prepare("SELECT * FROM messages WHERE idEquipe = ?");
            $requete->execute([$idD]);
            $messages = $requete->fetchAll(PDO::FETCH_ASSOC);

            foreach ($messages as $message) {
                $objetMessage = new Message($message["idMessage"]);
                $this->messages[] = $objetMessage;
            }
        }
    }

    public function initialiserDiscussion($idEquipe, $idEmploye, $idDestinataire)
    {
        $this->idEquipe = $idEquipe;
        $this->idEmploye = $idEmploye;
        $this->idDestinataire = $idDestinataire;

        $requete = $this->getBdd()->prepare("SELECT idMessage, contenu, date, idEmploye FROM messages WHERE idEquipe = ?");
        $requete->execute([$idEquipe]);
        $messagesDiscussion = $requete->fetchAll(PDO::FETCH_ASSOC);

        foreach ($messagesDiscussion as $messageDiscussion) {
            $objetMessage = new Message();
            $objetMessage->initialiserMessage($messageDiscussion["idMessage"], $messageDiscussion["contenu"], $messageDiscussion["date"], $messageDiscussion["idEmploye"]);
            $this->messages[] = $objetMessage;
        }
    }

    public function recupererDiscussions()
    {
        $requete = $this->getBDD()->prepare("SELECT * FROM discussions_groupe");
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }
    public function recupererDiscussion($idEquipe)
    {
        $requete = $this->getBDD()->prepare("SELECT * FROM discussions_groupe WHERE idEquipe = ?");
        $requete->execute([$idEquipe]);
        return $requete->fetch(PDO::FETCH_ASSOC);
    }
    public function creerDiscussion($idEmploye, $idDestinataire)
    {
        $requete = $this->getBDD()->prepare("INSERT INTO discussions_groupe(idEmploye, idDestinataire) VALUES(?, ?)");
        $requete->execute([$idEmploye, $idDestinataire]);
        return true;
    }
    public function supprimerDiscussion($idEquipe)
    {
        $requete = $this->getBDD()->prepare("DELETE FROM discussions_groupe WHERE idEquipe = ?");
        $requete->execute([$idEquipe]);
        return true;
    }
    public function modifierDiscussion($idEmploye, $idDestinataire, $idEquipe)
    {
        $requete = $this->getBDD()->prepare("UPDATE discussions_groupe SET idEmploye=?, idDestinataire=? WHERE idEquipe = ?");
        $requete->execute([$idEmploye, $idDestinataire, $idEquipe]);
        return true;
    }
    public function verifierDiscussion($idEmploye, $idDestinataire)
    {
        $requete = $this->getBDD()->prepare("SELECT idEquipe FROM discussions_groupe WHERE idEmploye = ? AND idDestinataire = ?");
        $requete->execute([$idEmploye, $idDestinataire]);
        if(empty($requete))
        {
            $requete = $this->getBDD()->prepare("SELECT idEquipe FROM discussions_groupe WHERE idEmploye = ? AND idDestinataire = ?");
            $requete->execute([$idDestinataire, $idEmploye]);
            if(empty($requete))
            {
                return false;
            } else
            {
                return $requete->fetch(PDO::FETCH_ASSOC);;
            }
        } else {
            return $requete->fetch(PDO::FETCH_ASSOC);;
        }
    }
    public function recupererDiscussionViaEnvoyeurDestinataire($idEmploye, $idDestinataire)
    {
        $requete = $this->getBDD()->prepare("SELECT idEquipe FROM discussions_groupe WHERE idEmploye = ? AND idDestinataire = ?");
        $requete->execute([$idEmploye, $idDestinataire]);
        return $requete->fetch(PDO::FETCH_ASSOC);
    }

    public function getIdEquipe()
    {
        return $this->idEquipe;
    }
    public function getIdEmploye()
    {
        return $this->idEmploye;
    }
    public function getIdDestinataire()
    {
        return $this->idDestinataire;
    }
    public function getDiscussion()
    {
        return $this->discussion;
    }
}
