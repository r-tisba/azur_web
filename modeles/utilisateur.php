<?php

class Utilisateur extends Modele
{
   private $idEmploye;
   private $nom;
   private $prenom;
   private $poste;
   private $idEquipe;
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
         $this->identifiant = $infos["identifiant"];
         $this->mdp = $infos["mdp"];
         $this->idRole = $infos["idRole"];
         $this->avatar = $infos["avatar"];

         $requete = $this->getBdd()->prepare("SELECT * FROM discussions WHERE idEnvoyeur = ? OR idDestinataire = ?");
         $requete->execute([$idE, $idE]);

         $discussions = $requete->fetchAll(PDO::FETCH_ASSOC);

         // foreach ($discussions as $discussion) {
         //    $objetDiscussion = new Discussion();
         //    $objetDiscussion->initialiserDiscussion($discussion["idDiscussion"], $discussion["idEnvoyeur"], $discussion["idDestinataire"]);
         //    $this->discussions[] = $objetDiscussion;
         // }
      }
   }

   public function recupererUtilisateurs()
   {
      $requete = $this->getBDD()->prepare("SELECT * FROM utilisateurs");
      $requete->execute();
      return $requete->fetchAll(PDO::FETCH_ASSOC);
   }

   public function recupererUtilisateur($idEmploye)
   {
      $requete = $this->getBDD()->prepare("SELECT * FROM utilisateurs WHERE idEmploye = ?");
      $requete->execute([$idEmploye]);
      return $requete->fetch(PDO::FETCH_ASSOC);
   }

   public function recupererInfosConnexion($identifiant)
   {
      $requete = $this->getBDD()->prepare("SELECT idEmploye, identifiant, mdp, idRole, idEquipe FROM utilisateurs WHERE identifiant = ?");
      $requete->execute([$identifiant]);
      return $requete;
   }

   public function recupererEquipeRolesUtilisateurs()
   {
      $requete = $this->getBDD()->prepare("SELECT * FROM utilisateurs INNER JOIN equipe USING(idEquipe) INNER JOIN roles USING(idRole)");
      $requete->execute();
      return $requete->fetchAll(PDO::FETCH_ASSOC);
   }

   public function mailUnique($email)
   {
      $requete = $this->getBDD()->prepare("SELECT email FROM utilisateurs WHERE email = ?");
      $requete->execute([$email]);
      return $requete;
   }

   public function creerUtilisateur($nom, $prenom, $poste, $mdp)
   {
      $idRole = 1;
      $idEquipe = 1;
      $identifiant = strtolower($prenom) . "." . strtolower($nom);

      $requete = $this->getBDD()->prepare("INSERT INTO utilisateurs(nom, prenom, poste, idEquipe, identifiant, mdp, idRole) VALUES(?, ?, ?, ?, ?, ?, ?)");
      $requete->execute([$nom, $prenom, $poste, $idEquipe, $identifiant, $mdp, $idRole]);
      return true;
   }

   public function modifierUtilisateur($idEmploye, $nom, $prenom, $poste, $idEquipe, $idRole)
   {
      $identifiant = strtolower($prenom) . "." . strtolower($nom);
      $requete = $this->getBDD()->prepare("UPDATE utilisateurs SET nom = ?, prenom = ?, poste = ?, idEquipe = ?, identifiant=?, idRole=? WHERE idEmploye = ?");
      $requete->execute([$nom, $prenom, $poste, $idEquipe, $identifiant, $idRole, $idEmploye]);
      return true;
   }
   public function modifierAvatar($avatar, $idUtilisateur)
   {
       $requete = $this->getBDD()->prepare("UPDATE utilisateurs SET avatar = ? WHERE idEmploye = ?");
       $requete->execute([$avatar, $idUtilisateur]);
       return true;

       $this->avatar=$avatar;
       $this->idUtilisateur=$idUtilisateur;
   }
   public function supprimerUtilisateur($idUtilisateur)
   {
      $requete = $this->getBDD()->prepare("DELETE FROM utilisateurs WHERE idUtilisateur = ?");
      $requete->execute([$idUtilisateur]);
      return true;
   }
   public function recupererInterlocuteur($idDiscussion)
   {
      $requete = $this->getBDD()->prepare("SELECT idEnvoyeur, idDestinataire FROM discussions WHERE idDiscussion = ?");
      $requete->execute([$idDiscussion]);
      $result = $requete->fetch(PDO::FETCH_ASSOC);
      if ($_SESSION["idUtilisateur"] == $result["idEnvoyeur"]) {
         $identifiant = $this->recupererUtilisateur($result["idDestinataire"]);
         return $identifiant["identifiant"];
      } else {
         $identifiant = $this->recupererUtilisateur($result["idEnvoyeur"]);
         return $identifiant["identifiant"];
      }
   }
   public function recupererGroupe($idEquipe)
   {
      $requete = $this->getBDD()->prepare("SELECT nom_equipe FROM equipe WHERE idEquipe = ?");
      $requete->execute([$idEquipe]);
      $equipe = $requete->fetch(PDO::FETCH_ASSOC);
      return $equipe["nom_equipe"];
      
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
   public function getidEquipe()
   {
      return $this->idEquipe;
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
}
