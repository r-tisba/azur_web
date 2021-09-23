<?php

class Utilisateur extends Modele
{
   private $idEmploye;
   private $nom;
   private $prenom;
   private $poste;
   private $idSecteur;
   private $identifiant;
   private $mdp;
   private $idRole;
   private $salaire;
   private $avatar;

   private $messages = [];

   public function __construct($idE = null)
   {
      if ($idE !== null) {
         $requete = $this->getBdd()->prepare("SELECT * FROM utilisateurs WHERE idEmploye = ?");
         $requete->execute([$idE]);
         $infos = $requete->fetch(PDO::FETCH_ASSOC);

         $this->idEmploye = $idE;
         $this->nom = $infos["nom"];
         $this->prenom = $infos["prenom"];
         $this->poste = $infos["poste"];
         $this->idSecteur = $infos["idSecteur"];
         $this->identifiant = $infos["identifiant"];
         $this->mdp = $infos["mdp"];
         $this->idRole = $infos["idRole"];
         $this->salaire = $infos["salaire"];
         $this->avatar = $infos["avatar"];

         $requete = $this->getBdd()->prepare("SELECT * FROM discussions WHERE idEmploye = ?");
         $requete->execute([$idE]);
         $discussions = $requete->fetchAll(PDO::FETCH_ASSOC);

         foreach ($discussions as $discussion) {
            $objetDiscussion = new Discussion();
            $objetDiscussion->initialiserDiscussion($discussion["idDiscussion"], $discussion["idEnvoyeur"], $discussion["idDestinataire"]);
            $this->discussions[] = $objetDiscussion;
         }
      }
   }

   public function getidEmploye()
   {
      return $this->idEmploye;
   }
   public function getNom()
   {
      return $this->nom;
   }
   public function getPrenom()
   {
      return $this->prenom;
   }
   public function getPoste()
   {
      return $this->poste;
   }
   public function getidSecteur()
   {
      return $this->idSecteur;
   }
   public function getIdentifiant()
   {
      return $this->identifiant;
   }
   public function getMdp()
   {
      return $this->mdp;
   }
   public function getidRole()
   {
      return $this->idRole;
   }
   public function getSalaire()
   {
      return $this->salaire;
   }
   public function getAvatar()
   {
      return $this->avatar;
   }
   public function getMessages()
   {
      return $this->messages;
   }

   function recupererUtilisateurs()
   {
      $requete = $this->getBDD()->prepare("SELECT * FROM utilisateurs");
      $requete->execute();
      return $requete->fetchAll(PDO::FETCH_ASSOC);
   }

   function recupererUtilisateur($idEmploye)
   {
      $requete = $this->getBDD()->prepare("SELECT * FROM utilisateurs WHERE idEmploye = ?");
      $requete->execute([$idEmploye]);
      return $requete->fetch(PDO::FETCH_ASSOC);
   }

   function recupererInfosConnexion($identifiant)
   {
      $requete = $this->getBDD()->prepare("SELECT idEmploye, identifiant, mdp, idRole FROM utilisateurs WHERE identifiant = ?");
      $requete->execute([$identifiant]);
      return $requete;
   }

   function recupererSecteursRolesUtilisateurs()
   {
      $requete = $this->getBDD()->prepare("SELECT * FROM utilisateurs INNER JOIN secteurs USING(idSecteur) INNER JOIN roles USING(idRole)");
      $requete->execute();
      return $requete->fetchAll(PDO::FETCH_ASSOC);
   }

   function mailUnique($email)
   {
      $requete = $this->getBDD()->prepare("SELECT email FROM utilisateurs WHERE email = ?");
      $requete->execute([$email]);
      return $requete;
   }

   function creerUtilisateur($nom, $prenom, $poste, $idSecteur, $mdp)
   {
      $salaire = 0;
      $idRole = 1;
      $identifiant = strtolower($prenom) . "." . strtolower($nom);

      $requete = $this->getBDD()->prepare("INSERT INTO
    utilisateurs(nom, prenom, poste, salaire, idSecteur, identifiant, mdp, idRole)
    VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
      $requete->execute([$nom, $prenom, $poste, $salaire, $idSecteur, $identifiant, $mdp, $idRole]);
      return true;
   }

   function modifierUtilisateur($idEmploye, $nom, $prenom, $poste, $salaire, $idSecteur, $idRole)
   {
      $identifiant = strtolower($prenom) . "." . strtolower($nom);
      $requete = $this->getBDD()->prepare("UPDATE utilisateurs SET nom = ?, prenom = ?, poste = ?, salaire = ?, idSecteur = ?, identifiant=?, idRole=? WHERE idEmploye = ?");
      $requete->execute([$nom, $prenom, $poste, $salaire, $idSecteur, $identifiant, $idRole, $idEmploye]);
      return true;
   }

   function supprimerUtilisateur($idUtilisateur)
   {
      $requete = $this->getBDD()->prepare("DELETE FROM utilisateurs
    WHERE idUtilisateur = ?");
      $requete->execute([$idUtilisateur]);
      return true;
   }

   function dateFr($date)
   {
      if ($datetime = DateTime::createfromformat("Y-m-d H:i:s", $date)) {
         return $date = $datetime->format("d/m/Y à H:i");
      } else if ($datetime = DateTime::createfromformat("Y-m-d", $date)) {
         return $date = $datetime->format("d/m/Y");
      }
   }
}
