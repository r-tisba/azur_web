<?php
class Secteur extends Modele
{
    private $idSecteur;
    private $nomSecteur;
    private $budget;

    public function __construct($idS=null)
    {
        if($idS!=null)
        {
            $requete = getBDD()->prepare("SELECT * FROM secteurs");
            $requete->execute();
            $secteur=$requete->fetchAll(PDO::FETCH_ASSOC);

            $this->idSecteur=$idS;
            $this->nomSecteur=$secteur["nomSecteur"];
            $this->budget=$secteur["budget"];

        }

       

    } 
    public function getIdS(){
            return $this->idSecteur;
        }
    public function getNS(){
            return $this->nomSecteur;
        }
    public function getB(){
            return $this->budget;
        }

}