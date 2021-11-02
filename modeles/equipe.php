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
            $equipe = $requete->fetch(PDO::FETCH_ASSOC);
            $this->idEquipe = $idE;
            $this->idSecteur = $equipe["idSecteur"];
            $this->nom_equipe = $equipe["nomEquipe"];
            }
    }
    public function recupererEquipes()
    {
        $requete = $this->getBDD()->prepare("SELECT * FROM equipe");
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }
    public function recupererEquipeRolesUtilisateurs($idEquipe)
   {
      $requete = $this->getBDD()->prepare("SELECT * FROM equipe INNER JOIN equipe_employe USING(idEquipe) INNER JOIN utilisateurs USING(idEmploye) INNER JOIN roles USING(idRole) WHERE idEquipe=?");
      $requete->execute([$idEquipe]);
      return $requete->fetchAll(PDO::FETCH_ASSOC);
   }

    public function recupererSecteur($idSecteur)
    {
        $requete = $this->getBDD()->prepare("SELECT * FROM equipe INNER JOIN secteur USING(idSecteur) WHERE idEquipe = ?");
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
    
    public function getIdE()
    {
        return $this->idEquipe;
    }
    public function recupererProjetEquipe($idEquipe){
        $requete = $this->getBDD()->prepare("SELECT * FROM equipe INNER JOIN projet USING(idEquipe) WHERE idEquipe = ?");
        $requete->execute([$idEquipe]);
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }
    

}