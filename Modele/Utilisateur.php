<?php

class Utilisateur extends Modele
{
    private $idEmploye;
    private $nom;
    private $prenom;
    private $poste;
    private $idSecteur;
    private $identifiant;
    private $mdp;
    private $idRole;
    private $salaire;
    private $avatar;

    private $messages = [];

    public function __construct($idE = null)
    {
        if($idE !== null)
        {
            $requete = $this->getBdd()->prepare("SELECT * FROM utilisateurs WHERE idEmploye = ?");
            $requete->execute([$idE]);
            $infos = $requete->fetch(PDO::FETCH_ASSOC);

            $this->idEmploye = $idE;
            $this->nom = $infos["nom"];
            $this->prenom = $infos["prenom"];
            $this->poste = $infos["poste"];
            $this->idSecteur = $infos["idSecteur"];
            $this->identifiant = $infos["identifiant"];
            $this->mdp = $infos["mdp"];
            $this->idRole = $infos["idRole"];
            $this->salaire = $infos["salaire"];
            $this->avatar = $infos["avatar"];

            $requete = $this->getBdd()->prepare("SELECT * FROM discussions WHERE idEmploye = ?");
            $requete->execute([$idE]);
            $discussions = $requete->fetchAll(PDO::FETCH_ASSOC);

            foreach ($discussions as $discussion)
            {
                $objetDiscussion = new Discussion();
                $objetDiscussion->initialiserDiscussion($discussion["idDiscussion"], $discussion["idEnvoyeur"], $discussion["idDestinataire"]);
                $this->discussions[] = $objetDiscussion;
            }
        }
    }

    public function getidEmploye()
    {
       return $this->idEmploye;
    }
    public function getNom()
    {
       return $this->nom;
    }
    public function getPrenom()
    {
       return $this->prenom;
    }
    public function getPoste()
    {
       return $this->poste;
    }
    public function getidSecteur()
    {
       return $this->idSecteur;
    }
    public function getIdentifiant()
    {
       return $this->identifiant;
    }
    public function getMdp()
    {
       return $this->mdp;
    }
    public function getidRole()
    {
       return $this->idRole;
    }
    public function getSalaire()
    {
       return $this->salaire;
    }
    public function getAvatar()
    {
       return $this->avatar;
    }
    public function getMessages()
    {
       return $this->messages;
    }
}