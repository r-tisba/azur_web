<?php
class Equipe extends Modele
{
    private $idEquipe;
    private $nomEquipe;
    private $image;

    public function __construct($idEquipe = null)
    {
        if ($idEquipe != null) {
            $requete = $this->getBdd()->prepare("SELECT * FROM equipes WHERE idEquipe = ?");
            $requete->execute([$idEquipe]);
            $equipe = $requete->fetch(PDO::FETCH_ASSOC);
            $this->idEquipe = $idEquipe;
            $this->nomEquipe = $equipe["nomEquipe"];
            $this->image = $equipe["image"];
            }
    }
    public function recupererEquipes()
    {
        $requete = $this->getBDD()->prepare("SELECT * FROM equipes");
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }
    public function verifierPresenceUtilisateurEquipe($idUtilisateur, $idEquipe)
    {
        $requete = $this->getBDD()->prepare("SELECT * FROM composition_equipes WHERE idUtilisateur = ? AND idEquipe = ?");
        $requete->execute([$idUtilisateur, $idEquipe]);
        $rows = $requete->fetchColumn();
        if($rows > 0) { return true; }
        else { return false; }
    }

    public function getIdEquipe()
    {
        return $this->idEquipe;
    }
    public function getNomEquipe()
    {
        return $this->nomEquipe;
    }
    public function getImage()
    {
        return $this->image;
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