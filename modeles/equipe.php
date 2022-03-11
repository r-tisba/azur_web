<?php
class Equipe extends Modele
{
    private $idEquipe;
    private $nomEquipe;
    private $image;
    private $membres = [];

    public function __construct($idEquipe = null)
    {
        if ($idEquipe != null) {
            $requete = $this->getBdd()->prepare("SELECT * FROM equipes WHERE idEquipe = ?");
            $requete->execute([$idEquipe]);
            $equipe = $requete->fetch(PDO::FETCH_ASSOC);
            $this->idEquipe = $idEquipe;
            $this->nomEquipe = $equipe["nomEquipe"];
            $this->image = $equipe["image"];

            $requete = $this->getBdd()->prepare("SELECT u.idUtilisateur, u.identifiant FROM composition_equipes LEFT JOIN utilisateurs u USING(idUtilisateur) WHERE idEquipe = ?");
            $requete->execute([$idEquipe]);
            $membres = $requete->fetchAll(PDO::FETCH_ASSOC);
            
            $this->membres = $membres;
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
    public function getMembres()
    {
        return $this->membres;
    }
}