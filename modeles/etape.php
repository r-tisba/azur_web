<?php

class Etape extends Modele
{
    private $idEtape;
    private $idProjet;
    private $dateDebut;
    private $dateFin;
    private $etatEtape;
    private $nomEtape;

    public function __construct($idE = null)
    {
        if($idE != null)
        {
            $requete = $this->getBdd()->prepare("SELECT * FROM etapes");
            $requete->execute();
            $etape = $requete->fetchAll(PDO::FETCH_ASSOC);

            $this->idEtape = $idE;
            $this->idProjet = $etape["idProjet"];
            $this->dateDebut = $etape["dateDebut"];
            $this->dateFin = $etape["dateFin"];
            $this->etatEtape = $etape["etatEtape"];
            $this->nomEtape = $etape["nomEtape"];
        }
    }
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
    public function recupererProjetViaEtape($idEtape)
    {
        $requete= $this->getBdd()->prepare("SELECT * FROM etapes INNER JOIN projets USING(idProjet) WHERE idEtape = ?");
        $requete->execute([$idEtape]);
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function creerEtape($idProjet, $dateDebut, $dateFin, $nomEtape)
    {
        $requete= $this->getBdd()->prepare("INSERT INTO etapes(idProjet, dateDebut, dateFin, nomEtape) VALUES(?,?,?,?)");
        $requete->execute([$idProjet, $dateDebut, $dateFin, $nomEtape]);
        return true;
    }
    public function validerEtape($idEtape)
    {
        $requete = $this->getBdd()->prepare("UPDATE etapes SET etatEtape=1 WHERE idEtape=?");
        $requete->execute([$idEtape]);
        return true;
    }
    public function invaliderEtape($idEtape)
    {
        $requete = $this->getBdd()->prepare("ALTER TABLE etapes SET etatEtape=0 WHERE idEtape=?");
        $requete->execute([$idEtape]);
        return true;
    }
    public function barreProgression($idProjet)
    {
        $requete = $this->getBdd()->prepare("SELECT COUNT(*) FROM etapes WHERE idProjet=?");
        $requete->execute([$idProjet]);
        $barreProgression=$requete->fetch(PDO::FETCH_ASSOC);
        return $barreProgression;
    }
    public function progression($idProjet)
    {
        $requete = $this->getBdd()->prepare("SELECT COUNT(*) FROM etapes WHERE idProjet=? AND etatEtape=1");
        $requete->execute([$idProjet]);
        $progression=$requete->fetch(PDO::FETCH_ASSOC);
        return $progression;
    }
    public function etapeProjet($idProjet)
    {
        $requete = $this->getBdd()->prepare("SELECT * FROM etapes WHERE idProjet=? AND etatEtape=0");
        $requete->execute([$idProjet]);
        $etape=$requete->fetchAll(PDO::FETCH_ASSOC);
        return $etape;
    }
    public function etapeEnCours($idEtape)
    {
        $requete = $this->getBdd()->prepare("SELECT * FROM etapes
        WHERE idEtape = ? AND etatEtape = 0 AND ((NOW() >= dateDebut AND NOW() <= dateFin) OR NOW() >= dateDebut AND ISNULL(dateFin))");
        $requete->execute([$idEtape]);
        $etape = $requete->fetch(PDO::FETCH_ASSOC);
        if(empty($etape))
        {
            return false;
        }
        else
        {
            return true;
        }
    }
}