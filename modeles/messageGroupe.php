<?php

class MessageGroupe extends Modele
{
    private $idMessageGroupe;
    private $idEquipe;
    private $idUtilisateur;
    private $contenu;
    private $date;
    private $dateModif;
    private $messages = [];

    public function __construct($idEquipe = null)
    {
        if ($idEquipe !== null) {
            $requete = $this->getBdd()->prepare("SELECT * FROM messages_groupes WHERE idEquipe = ?");
            $requete->execute([$idEquipe]);
            $message = $requete->fetch(PDO::FETCH_ASSOC);

            $this->idMessageGroupe = $message["idMessageGroupe"];
            $this->idEquipe = $idEquipe;
            $this->idUtilisateur = $message["idUtilisateur"];
            $this->contenu = $message["contenu"];
            $this->date = $message["date"];
            $this->dateModif = $message["dateModif"];

            $requete = $this->getBdd()->prepare("SELECT * FROM messages_groupes LEFT JOIN composition_equipes USING(idEquipe, idUtilisateur) LEFT JOIN equipes USING(idEquipe) LEFT JOIN utilisateurs USING(idUtilisateur) WHERE idEquipe = ? ORDER BY date ASC");
            $requete->execute([$this->idEquipe]);
            $messages = $requete->fetchAll(PDO::FETCH_ASSOC);

            foreach ($messages as $message) {
                $this->messages[] = $message;
            }
        }
    }
    public function recupererMessage($idMessageGroupe)
    {
        $requete = $this->getBDD()->prepare("SELECT * FROM messages_groupes LEFT JOIN utilisateurs USING(idUtilisateur)  WHERE idMessageGroupe = ?");
        $requete->execute([$idMessageGroupe]);
        $message = $requete->fetch(PDO::FETCH_ASSOC);
        return $message;
    }
    public function recupereridEquipeViaMessage($idMessageGroupe)
    {
        $requete = $this->getBDD()->prepare("SELECT idEquipe FROM messages_groupes WHERE idMessageGroupe = ?");
        $requete->execute([$idMessageGroupe]);
        $idEquipe = $requete->fetch(PDO::FETCH_ASSOC);
        return $idEquipe;
    }
    public function recupererDernierMessageGroupeAjoute()
    {
        $requete = $this->getBDD()->prepare("SELECT idMessageGroupe FROM messages_groupes ORDER BY idMessageGroupe DESC LIMIT 1");
        $requete->execute();
        $messages = $requete->fetch(PDO::FETCH_ASSOC);
        return $messages;
    }
    public function ajoutMessage($idEquipe, $idUtilisateur, $contenu)
    {
        $requete = $this->getBDD()->prepare("INSERT INTO messages_groupes(idEquipe, idUtilisateur, contenu, date) VALUES(?, ?, ?, ?)");
        $requete->execute([$idEquipe, $idUtilisateur, $contenu, date("Y-m-d H:i:s")]);
        return true;
    }
    public function modifierMessage($contenu, $idMessageGroupe)
    {
        $requete = $this->getBDD()->prepare("UPDATE messages_groupes SET contenu = ?, dateModif = ? WHERE idMessageGroupe = ?");
        $requete->execute([$contenu, date("Y-m-d H:i:s"), $idMessageGroupe]);
        return true;

        $this->idMessageGroupe=$idMessageGroupe;
    }
    public function supprimerMessage($idMessageGroupe)
    {
        $requete = $this->getBDD()->prepare("DELETE FROM messages_groupes WHERE idMessageGroupe = ?");
        $requete->execute([$idMessageGroupe]);
        return true;

        $this->idCategorie=$idMessageGroupe;
    }

    public function getIdMessageGroupe()
    {
        return $this->idMessageGroupe;
    }
    public function getIdEquipe()
    {
        return $this->idEquipe;
    }
    public function getidUtilisateur()
    {
        return $this->idUtilisateur;
    }
    public function getContenu()
    {
        return $this->contenu;
    }
    public function getDate()
    {
        return $this->date;
    }
    public function getDateModif()
    {
        return $this->dateModif;
    }
    public function getMessages()
    {
        return $this->messages;
    }

    public function __set($propriete, $valeur) 
    {
       if (property_exists($this, $propriete)) 
       {
         $this->$propriete = $valeur;
       }
       return $this;
    }
}