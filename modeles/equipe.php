<?php
class Equipe extends Modele
{
    private $idEquipe;
    private $idSecteur;
    private $nomEquipe;
    private $image;

    public function __construct($idE = null)
    {
        if ($idE != null) {
            $requete = $this->getBdd()->prepare("SELECT * FROM equipes");
            $requete->execute();
            $equipe = $requete->fetch(PDO::FETCH_ASSOC);
            $this->idEquipe = $idE;
            $this->idSecteur = $equipe["idSecteur"];
            $this->nom_equipe = $equipe["nomEquipe"];
            $this->image = $equipe["image"];
            }
    }
    public function recupererEquipes()
    {
        $requete = $this->getBDD()->prepare("SELECT * FROM equipes");
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }
    public function recupererEquipe($idEquipe)
    {
        $requete = $this->getBDD()->prepare("SELECT * FROM equipes WHERE idEquipe = ?");
        $requete->execute([$idEquipe]);
        return $requete->fetch(PDO::FETCH_ASSOC);
    }
    public function recupererEquipeRolesUtilisateurs($idEquipe)
   {
      $requete = $this->getBDD()->prepare("SELECT * FROM equipes INNER JOIN composition_equipes USING(idEquipe) INNER JOIN utilisateurs USING(idUtilisateur) INNER JOIN roles ON utilisateurs.role = roles.nomRole WHERE idEquipe=?");
      $requete->execute([$idEquipe]);
      return $requete->fetchAll(PDO::FETCH_ASSOC);
   }

    // recuperer et utiliser idSecteur alors qu'on selectionne idEquipe dans la requête ?
    public function recupererSecteur($idSecteur)
    {
        $requete = $this->getBDD()->prepare("SELECT nomEquipe FROM equipes WHERE idEquipe = ?");
        $requete->execute([$idSecteur]);
        return $requete->fetch(PDO::FETCH_ASSOC);
    }

    public function recupererImage($idEquipe)
    {
        $requete = $this->getBDD()->prepare("SELECT image FROM equipes WHERE idEquipe = ?");
        $requete->execute([$idEquipe]);
        return $requete->fetch(PDO::FETCH_ASSOC);
    }

    public function getIdE()
    {
        return $this->idEquipe;
    }
    public function getIdSecteur()
    {
        return $this->idSecteur;
    }
    public function getNomEquipe()
    {
        return $this->nomEquipe;
    }
    public function getImage()
    {
        return $this->image;
    }
}