<?php

class Projet extends Modele
{
    private $idProjet;
    private $idEquipe;
    private $dateDebut;
    private $dateFin;
    private $fini;
    private $nom;
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
            $this->fini = $projet["fini"];
            $this->nom = $projet["nom"];
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
    public function ajoutProjet($idEquipe, $nom, $dateDebut, $dateFin, $importance)
    {
        $fini = 0;
        $requete = $this->getBDD()->prepare("INSERT INTO projets(idEquipe, nom, dateDebut, dateFin, importance, fini) VALUES(?,?,?,?,?,?)");
        $requete->execute([$idEquipe, $nom, $dateDebut, $dateFin, $importance, $fini]);
        return true;
    }

    public function recupererProjetEquipe($idProjet)
    {
        $requete = $this->getBDD()->prepare("SELECT * FROM projets INNER JOIN equipes USING(idProjet)  WHERE idProjet = ?");
        $requete->execute([$idProjet]);
        return $requete->fetch(PDO::FETCH_ASSOC);
    }

    public function getIdEquipe()
    {
        return $this->idEquipe;
    }
    public function getNomProjet()
    {
        return $this->nom;
    }
}