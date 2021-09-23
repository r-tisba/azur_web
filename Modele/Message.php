<?php 

class Message extends Modele 
{
    private $idMessage;
    private $contenu;
    private $date;
    private $idEmploye;

    public function __construct($idM = null)
    {
        if($idM !== null)
        {
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