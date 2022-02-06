<?php

class Projet extends Modele
{
    private $idProjet;
    private $idEquipe;
    private $dateDebut;
    private $dateFin;
    private $etatProjet;
    private $nomProjet;
    private $importance;
    private $illustration;

    public function __construct($idP = null)
    {
        if ($idP != null) {
            $requete = $this->getBdd()->prepare("SELECT * FROM projets");
            $requete->execute();
            $projet = $requete->fetchAll(PDO::FETCH_ASSOC);

            $this->idProjet = $idP;
            $this->idEquipe = $projet["idEquipe"];
            $this->dateDebut = $projet["dateDebut"];
            $this->dateFin = $projet["dateFin"];
            $this->etatProjet = $projet["etatProjet"];
            $this->nomProjet = $projet["nomProjet"];
            $this->importance = $projet["importance"];
            $this->illustration = $projet["illustration"];
        }
    }
    public function recupererProjets()
    {
        $requete = $this->getBDD()->prepare("SELECT * FROM projets");
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }
    public function recupererProjet($idProjet)
    {
        $requete = $this->getBDD()->prepare("SELECT * FROM projets WHERE idProjet = ?");
        $requete->execute([$idProjet]);
        return $requete->fetch(PDO::FETCH_ASSOC);
    }

    public function ajoutProjet($idEquipe, $nomProjet, $dateDebut, $dateFin, $importance)
    {
        $etatProjet = 0;
        $requete = $this->getBDD()->prepare("INSERT INTO projets(idEquipe, nomProjet, dateDebut, dateFin, importance, etatProjet) VALUES(?,?,?,?,?,?)");
        $requete->execute([$idEquipe, $nomProjet, $dateDebut, $dateFin, $importance, $etatProjet]);
        return true;
    }

    public function recupererProjetsEquipe($idEquipe)
    {
        $requete = $this->getBDD()->prepare("SELECT * FROM projets LEFT JOIN equipes USING(idEquipe) WHERE idEquipe = ?");
        $requete->execute([$idEquipe]);
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }
    public function recupererEquipeViaProjet($idProjet)
    {
        $requete = $this->getBDD()->prepare("SELECT idProjet, idEquipe, nomEquipe FROM projets LEFT JOIN equipes USING(idEquipe) WHERE idProjet = ?");
        $requete->execute([$idProjet]);
        return $requete->fetch(PDO::FETCH_ASSOC);
    }

    public function getIdProjet()
    {
        return $this->idProjet;
    }
    public function getIdEquipe()
    {
        return $this->idEquipe;
    }
    public function getDateDebut()
    {
        return $this->dateDebut;
    }
    public function getDateFin()
    {
        return $this->dateFin;
    }
    public function getEtatProjet()
    {
        return $this->etatProjet;
    }
    public function getNomProjet()
    {
        return $this->nomProjet;
    }
}