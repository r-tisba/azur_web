<?php
class Equipe extends Modele
{
    private $idEquipe;
    private $idSecteur;
    private $nomEquipe;

    public function __construct($idE = null)
    {
        if ($idE != null) {
            $requete = $this->getBdd()->prepare("SELECT * FROM equipe");
            $requete->execute();
            $equipe = $requete->fetch(PDO::FETCH_ASSOC);
            $this->idEquipe = $idE;
            $this->idSecteur = $equipe["idSecteur"];
            $this->nomEquipe = $equipe["nomEquipe"];
            }
    }
    public function recupererEquipes()
    {
        $requete = $this->getBDD()->prepare("SELECT * FROM equipe");
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }
    public function recupererEquipe($idEquipe)
    {
        $requete = $this->getBDD()->prepare("SELECT * FROM equipe INNER JOIN projet USING(idEquipe) WHERE idEquipe = ?");
        $requete->execute([$idEquipe]);
        return $requete->fetch(PDO::FETCH_ASSOC);
    }
    public function recupererNomEquipeViaId($idEquipe)
    {
        $requete = $this->getBDD()->prepare("SELECT nomEquipe FROM equipe WHERE idEquipe = ?");
        $requete->execute([$idEquipe]);
        return $requete->fetch(PDO::FETCH_ASSOC);
    }
    public function getIdSecteur()
    {
        return $this->idSecteur;
    }
    public function getNomEquipe()
    {
        return $this->nomEquipe;
    }
    public function getIdE()
    {
        return $this->idEquipe;
    }
}