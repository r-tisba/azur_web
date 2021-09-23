<?php

class Depense extends Modele
{
    private $idDepense;
    private $nomDepense;
    private $depense;
    private $date;

    public function __construct($idD = null)
    {
        if ($idD != null)
            $requete = getBdd()->prepare("SELECT * FROM depenses");
        $requete->execute([$idD]);
        $depense = $requete->fetch(PDO::FETCH_ASSOC);
        $this->idDepense = $idD;
        $this->nomDepense = $depense["nomDepense"];
        $this->depense = $depense["depense"];
        $this->date = $depense["date"];
    }
    public function getIdD()
    {
        return $this->idDepense;
    }
    public function getND()
    {
        return $this->nomDepense;
    }
    public function getD()
    {
        return $this->depense;
    }
    public function getDate()
    {
        return $this->date;
    }

    function recupererDepenses()
    {
        $requete = getBDD()->prepare("SELECT * FROM depenses");
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    function recupererDepense($idDepense)
    {
        $requete = getBDD()->prepare("SELECT * FROM depenses WHERE idDepense = ?");
        $requete->execute([$idDepense]);
        return $requete->fetch(PDO::FETCH_ASSOC);
    }

    function creerDepense($nomDepense, $depense, $date)
    {
        $requete = getBDD()->prepare("INSERT INTO depenses(nomDepense, depense, date) VALUES(?, ?, ?)");
        $requete->execute([$nomDepense, $depense, $date]);
        return true;
    }

    function supprimerDepense($idDepense)
    {
        $requete = getBDD()->prepare("DELETE FROM depenses WHERE idDepense = ?");
        $requete->execute([$idDepense]);
        return true;
    }

    function modifierDepense($nomDepense, $depense, $date, $idDepense)
    {
        $requete = getBDD()->prepare("UPDATE depenses SET nomDepense=?, depense=?, date=?
    WHERE idDepense = ?");
        $requete->execute([$nomDepense, $depense, $date, $idDepense]);
        return true;
    }
}
