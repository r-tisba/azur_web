<?php

class Revenu extends Modele
{
    private $idRevenu ;
    private $nomRevenu;
    private $gains;
    private $date;

    public function __construct($idR=null)
    {
        if($idR!=null){
            $requete = getBDD()->prepare("SELECT * FROM revenus");
            $requete->execute([$idR]);
            $revenu=$requete->fetch(PDO::FETCH_ASSOC);
                        
            $this->idRevenu=$idR;
            $this->nomRevenu=$revenu["nomRevenu"];
            $this->gains=$revenu["gains"];
            $this->date=$revenu["date"];
        }
    }
    public function getIdR(){
        return $this->idRevenu;
    }
    public function getNR(){
        return $this->nomRevenu;
    }
    public function getGains(){
        return $this->gains;
    }
    public function getDate(){
        return $this->date;
    }
}