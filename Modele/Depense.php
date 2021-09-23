<?php

class Depense extends Modele
{
    private $idDepense;
    private $nomDepense;
    private $depense;
    private $date;

    public function __construct($idD=null)
    {
        if($idD!=null)
            $requete = getBDD()->prepare("SELECT * FROM depenses");
            $requete->execute([$idD]);
            $depense=$requete->fetch(PDO::FETCH_ASSOC);
            $this->idDepense=$idD;
            $this->nomDepense=$depense["nomDepense"];
            $this->depense=$depense["depense"];
            $this->date=$depense["date"];
         
    }
    public function getIdD(){
        return $this->idDepense;
    }
    public function getND(){
        return $this->nomDepense;
    }
    public function getD(){
        return $this->depense;
    }
    public function getDate(){
        return $this->date;
    }
    
}