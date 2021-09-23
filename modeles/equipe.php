<?php
class Equipe extends Modele{
    private $idEquipe;
    private $idSecteur;
    private $nom_equipe;

    public function __construct($idE = null)
    {
        if ($idE != null) {
            $requete = $this->getBdd()->prepare("SELECT * FROM equipe");
            $requete->execute();
            $equipe = $requete->fetchAll(PDO::FETCH_ASSOC);

            $this->idEquipe = $idE;
            $this->idSecteur = $equipe["idSecteur"];
            $this->nom_equipe = $equipe["nom_equipe"];
            }
    }
    public function recupererEquipes()
    {
        $requete = $this->getBDD()->prepare("SELECT * FROM equipe");
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function recupererSecteur($idSecteur)
    {
        $requete = $this->getBDD()->prepare("SELECT * FROM equipe INNER JOIN secteur USING(idSecteur)  WHERE idEquipe = ?");
        $requete->execute([$idSecteur]);
        return $requete->fetch(PDO::FETCH_ASSOC);
    }
    public function getIdSecteur()
    {
        return $this->idSecteur;
    }
    public function getNomEquipe()
    {
        return $this->nom_equipe;
    }
    public function recupererProjets(){
        $requete = $this->getBDD()->prepare("SELECT * FROM equipe INNER JOIN projet USING(idEquipe)");
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getIdE()
    {
        return $this->idEquipe;
    }

}