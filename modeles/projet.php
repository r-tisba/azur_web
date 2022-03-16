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
    private $intitule;
    private $contexte;
    private $etapes = [];

    public function __construct($idProjet = null)
    {
        if ($idProjet != null) {
            $requete = $this->getBdd()->prepare("SELECT * FROM projets WHERE idProjet = ?");
            $requete->execute([$idProjet]);
            $projet = $requete->fetch(PDO::FETCH_ASSOC);

            $this->idProjet = $idProjet;
            $this->idEquipe = $projet["idEquipe"];
            $this->dateDebut = $projet["dateDebut"];
            $this->dateFin = $projet["dateFin"];
            $this->etatProjet = $projet["etatProjet"];
            $this->nomProjet = $projet["nomProjet"];
            $this->importance = $projet["importance"];
            $this->illustration = $projet["illustration"];

            $requete= $this->getBdd()->prepare("SELECT idProjet, idEtape, nomEtape, e.dateDebut, e.dateFin, etatEtape, nomProjet, contexte FROM etapes e INNER JOIN projets p USING(idProjet) WHERE idProjet = ?");
            $requete->execute([$this->idProjet]);
            $etapesArray = $requete->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($etapesArray as $etape) {
                $this->etapes[] = $etape;
            }
        }
    }
    public function recupererProjets()
    {
        $requete = $this->getBDD()->prepare("SELECT * FROM projets");
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }
    // public function  ($idProjet)
    // {
    //     $requete = $this->getBDD()->prepare("SELECT * FROM projets WHERE idProjet = ?");
    //     $requete->execute([$idProjet]);
    //     return $requete->fetch(PDO::FETCH_ASSOC);
    // }
    public function recupererEtapesProjet($idProjet)
    {
        $requete= $this->getBdd()->prepare("SELECT idProjet, idEtape, nomEtape, e.dateDebut, e.dateFin, etatEtape, nomProjet, contexte FROM etapes e INNER JOIN projets p USING(idProjet) WHERE idProjet = ?");
        $requete->execute([$idProjet]);
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }
    public function recupererEtapesProjetNonFini($idProjet)
    {
        $requete= $this->getBdd()->prepare("SELECT idProjet, idEtape, nomEtape, e.dateDebut, e.dateFin, etatEtape, nomProjet, contexte FROM etapes e INNER JOIN projets p USING(idProjet) WHERE idProjet = ? AND etatEtape = 0");
        $requete->execute([$idProjet]);
        return $requete->fetchAll(PDO::FETCH_ASSOC);
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
    public function getIntitule()
    {
        return $this->intitule;
    }
    public function getContexte()
    {
        return $this->contexte;
    }
    public function getEtapes()
    {
        return $this->etapes;
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