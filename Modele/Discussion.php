<?php

class Discussion extends Modele
{
    private $idDiscussion;
    private $idEnvoyeur;
    private $idDestinataire;

    private $discussion = [];

    public function __construct($idD = null)
    {
        if($idD !== null)
        {
            $sqlE = "SELECT * FROM discussions WHERE idEnvoyeur = ?";
            $sqlD = "SELECT * FROM discussions WHERE idDestinataire = ?";

            $requete = $this->getBdd()->prepare($sqlE);
            $requete->execute([$idD]);
            $discussionE = $requete->fetch(PDO::FETCH_ASSOC);
                
            $requete = $this->getBdd()->prepare($sqlD);
            $requete->execute([$idD]);
            $discussionD = $requete->fetch(PDO::FETCH_ASSOC);
            
            $discussion = array_merge($discussionE, $discussionD);
            
            $this->idDiscussion = $idD;
            $this->idEnvoyeur = $discussion["idEnvoyeur"];
            $this->idDestinataire = $discussion["idDestinataire"];

            $requete = $this->getBdd()->prepare("SELECT * FROM messages WHERE idDiscussion = ?");
            $requete->execute([$idD]);
            $messages = $requete->fetchAll(PDO::FETCH_ASSOC);

            foreach($messages as $message)
            {
                $objetMessage = new Message($message["idMessage"]);
                $this->messages[] = $objetMessage;
            }

        }
    }

    public function initialiserDiscussion($idDiscussion, $idEnvoyeur, $idDestinataire)
    {
        $this->idDiscussion = $idDiscussion;
        $this->idEnvoyeur = $idEnvoyeur;
        $this->idDestinataire = $idDestinataire;
    
        $requete = $this->getBdd()->prepare("SELECT idMessage, contenu, date, idEmploye FROM messages WHERE idDiscussion = ?");
        $requete->execute([$idDiscussion]);
        $messagesDiscussion = $requete->fetchAll(PDO::FETCH_ASSOC);

        foreach($messagesDiscussion as $messageDiscussion)
        {
            $objetMessage = new Message();
            $objetMessage->initialiserMessage($messageDiscussion["idMessage"], $messageDiscussion["contenu"], $messageDiscussion["date"], $messageDiscussion["idEmploye"]);
            $this->messages[] = $objetMessage;
        }
    }

    public function getIdDiscussion()
    {
        return $this->idDiscussion;
    }
    public function getIdEnvoyeur()
    {
        return $this->idEnvoyeur;
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