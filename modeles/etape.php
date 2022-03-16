<?php

class Etape extends Modele
{
    private $idEtape;
    private $idProjet;
    private $nomEtape;
    private $dateDebut;
    private $dateFin;
    private $etatEtape;

    public function __construct($idEtape = null)
    {
        if($idEtape != null)
        {
            $requete = $this->getBdd()->prepare("SELECT * FROM etapes WHERE idEtape = ?");
            $requete->execute([$idEtape]);
            $etape = $requete->fetchAll(PDO::FETCH_ASSOC);

            $this->idEtape = $idEtape;
            $this->idProjet = $etape["idProjet"];
            $this->nomEtape = $etape["nomEtape"];
            $this->dateDebut = $etape["dateDebut"];
            $this->dateFin = $etape["dateFin"];
            $this->etatEtape = $etape["etatEtape"];
        }
    }
    public function recupererProjetViaEtape($idEtape)
    {
        $requete= $this->getBdd()->prepare("SELECT * FROM etapes INNER JOIN projets USING(idProjet) WHERE idEtape = ?");
        $requete->execute([$idEtape]);
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }
    public function recupererDerniereEtape()
    {
        $requete = $this->getBDD()->prepare("SELECT idEtape FROM etapes ORDER BY idEtape DESC LIMIT 1");
        $requete->execute();
        return $requete->fetch(PDO::FETCH_ASSOC);
    }
    // public function creerEtape($idProjet, $dateDebut, $dateFin, $nomEtape)
    // {
    //     $requete= $this->getBdd()->prepare("INSERT INTO etapes(idProjet, dateDebut, dateFin, nomEtape) VALUES(?, ?, ?, ?)");
    //     $requete->execute([$idProjet, $dateDebut, $dateFin, $nomEtape]);
    //     return true;
    // }
    public function validerEtape($idEtape)
    {
        $requete = $this->getBdd()->prepare("UPDATE etapes SET etatEtape=1 WHERE idEtape=?");
        $requete->execute([$idEtape]);
        return true;
    }
    public function invaliderEtape($idEtape)
    {
        $requete = $this->getBdd()->prepare("UPDATE etapes SET etatEtape=0 WHERE idEtape=?");
        $requete->execute([$idEtape]);
        return true;
    }

    // Compte toutes les étapes du projet
    public function barreProgression($idProjet)
    {
        $requete = $this->getBdd()->prepare("SELECT COUNT(*) FROM etapes WHERE idProjet=?");
        $requete->execute([$idProjet]);
        $barreProgression=$requete->fetch(PDO::FETCH_ASSOC);
        return $barreProgression;
    }
    // Compte toutes les étapes terminées du projet
    public function progression($idProjet)
    {
        $requete = $this->getBdd()->prepare("SELECT COUNT(*) FROM etapes WHERE idProjet=? AND etatEtape=1");
        $requete->execute([$idProjet]);
        $progression=$requete->fetch(PDO::FETCH_ASSOC);
        return $progression;
    }
    // Vérifie que l'étape soit non-terminée et que la date actuelle est postérieur à celle de début mais antérieure à celle de fin (si cette dernière existe)
    public function etapeEnCours($idEtape)
    {
        $requete = $this->getBdd()->prepare("SELECT * FROM etapes
        WHERE idEtape = ? AND etatEtape = 0 AND ((NOW() >= dateDebut AND NOW() <= dateFin) OR NOW() >= dateDebut AND ISNULL(dateFin))");
        $requete->execute([$idEtape]);
        $etape = $requete->fetch(PDO::FETCH_ASSOC);
        if(empty($etape)) { return false; }
        else { return true; }
    }
    public function getIdEtape()
    {
        return $this->idEtape;
    }
    public function getIdProjet()
    {
        return $this->idProjet;
    }
    public function getNomEtape()
    {
        return $this->nomEtape;
    }
    public function getDateDebut()
    {
        return $this->dateDebut;
    }
    public function getDateFin()
    {
        return $this->dateFin;
    }
    public function getEtatEtape()
    {
        return $this->etatEtape;
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