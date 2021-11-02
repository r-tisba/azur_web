<?php

class Etape extends Modele
{
    private $idEtape;
    private $idProjet;
    private $dateDebut;
    private $dateFin;
    private $fini;
    private $nomEtape;

    public function __construct($idE = null)
    {
        if($idE != null)
        {
            $requete = $this->getBdd()->prepare("SELECT * FROM etape");
            $requete->execute();
            $etape = $requete->fetchAll(PDO::FETCH_ASSOC);

            $this->idEtape = $idE;
            $this->idProjet = $etape["idProjet"];
            $this->dateDebut = $etape["dateDebut"];
            $this->dateFin = $etape["dateFin"];
            $this->fini = $etape["fini"];
            $this->nomEtape = $etape["nomEtape"];
        }
    }

    public function creerEtape($idProjet, $dateDebut, $dateFin, $nomEtape){
        $requete= $this->getBdd()->prepare("INSERT INTO etape(idProjet, dateDebut, dateFin, nomEtape) VALUES(?,?,?,?)");
        $requete->execute([$idProjet, $dateDebut, $dateFin, $nomEtape]);
        return true;
    }

    public function validerEtape($idEtape){
        $requete = $this->getBdd()->prepare("UPDATE etape SET fini=1 WHERE idEtape=?");
        $requete->execute([$idEtape]);
        return true;
    }
    public function invaliderEtape($idEtape){
        $requete = $this->getBdd()->prepare("ALTER TABLE etape SET fini=0 WHERE idEtape=?");
        $requete->execute([$idEtape]);
        return true;
    }
    public function barreProgression($idProjet){
        $requete = $this->getBdd()->prepare("SELECT COUNT(*) FROM etape WHERE idProjet=?");
        $requete->execute([$idProjet]);
        $barreProgression=$requete->fetch(PDO::FETCH_ASSOC);
        return $barreProgression;
    }
    public function progression($idProjet){
        $requete = $this->getBdd()->prepare("SELECT COUNT(*) FROM etape WHERE idProjet=? AND fini=1");
        $requete->execute([$idProjet]);
        $progression=$requete->fetch(PDO::FETCH_ASSOC);
        return $progression;
    }
    public function etapeProjet($idProjet){
        $requete = $this->getBdd()->prepare("SELECT * FROM etape WHERE idProjet=? AND fini=0");
        $requete->execute([$idProjet]);
        $etape=$requete->fetchAll(PDO::FETCH_ASSOC);
        return $etape;
    }


}