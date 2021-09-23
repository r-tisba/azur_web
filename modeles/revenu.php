<?php

class Revenu extends Modele
{
    private $idRevenu;
    private $nomRevenu;
    private $gains;
    private $date;

    public function __construct($idR = null)
    {
        if ($idR != null) {
            $requete = getBDD()->prepare("SELECT * FROM revenus");
            $requete->execute([$idR]);
            $revenu = $requete->fetch(PDO::FETCH_ASSOC);

            $this->idRevenu = $idR;
            $this->nomRevenu = $revenu["nomRevenu"];
            $this->gains = $revenu["gains"];
            $this->date = $revenu["date"];
        }
    }
    public function getIdRevenu()
    {
        return $this->idRevenu;
    }
    public function getNomRevenu()
    {
        return $this->nomRevenu;
    }
    public function getGains()
    {
        return $this->gains;
    }
    public function getDate()
    {
        return $this->date;
    }

    function recupererRevenus()
    {
        $requete = getBDD()->prepare("SELECT * FROM revenus");
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    function recupererRevenu($idRevenu)
    {
        $requete = getBDD()->prepare("SELECT * FROM revenus WHERE idRevenu = ?");
        $requete->execute([$idRevenu]);
        return $requete->fetch(PDO::FETCH_ASSOC);
    }

    function creerRevenu($nomRevenu, $gains, $date)
    {
        $requete = getBDD()->prepare("INSERT INTO revenus(nomRevenu, gains, date) VALUES(?, ?, ?)");
        $requete->execute([$nomRevenu, $gains, $date]);
        return true;
    }

    function supprimerRevenu($idRevenu)
    {
        $requete = getBDD()->prepare("DELETE FROM revenus WHERE idRevenu = ?");
        $requete->execute([$idRevenu]);
        return true;
    }

    function modifierRevenu($nomRevenu, $gains, $date, $idRevenu)
    {
        $requete = getBDD()->prepare("UPDATE revenus SET nomRevenu=?, gains=?, date=?
    WHERE idRevenu = ?");
        $requete->execute([$nomRevenu, $gains, $date, $idRevenu]);
        return true;
    }
}
