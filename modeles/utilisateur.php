<?php

class Utilisateur extends Modele
{
   private $idUtilisateur;
   private $nom;
   private $prenom;
   private $poste;
   private $idEquipe;
   private $identifiant;
   private $mdp;
   private $role;
   private $salaire;
   private $avatar;

   private $messages = [];

   public function __construct($idE = null)
   {
      if ($idE !== null) {
         $requete = $this->getBdd()->prepare("SELECT * FROM utilisateurs WHERE idUtilisateur = ?");
         $requete->execute([$idE]);
         $infos = $requete->fetch(PDO::FETCH_ASSOC);

         $this->idUtilisateur = $idE;
         $this->nom = $infos["nom"];
         $this->prenom = $infos["prenom"];
         $this->poste = $infos["poste"];
         $this->identifiant = $infos["identifiant"];
         $this->mdp = $infos["mdp"];
         $this->role = $infos["role"];
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
   public function recupererUtilisateur($idUtilisateur)
   {
      $requete = $this->getBDD()->prepare("SELECT * FROM utilisateurs WHERE idUtilisateur = ?");
      $requete->execute([$idUtilisateur]);
      return $requete->fetch(PDO::FETCH_ASSOC);
   }

   public function recupererInfosConnexion($identifiant)
   {
      $requete = $this->getBDD()->prepare("SELECT idUtilisateur, identifiant, mdp, role FROM utilisateurs WHERE identifiant = ?");
      $requete->execute([$identifiant]);
      return $requete;
   }

   public function creerUtilisateur($nom, $prenom, $poste, $mdp)
   {
      $role = "Utilisateur";
      $identifiant = strtolower($prenom) . "." . strtolower($nom);

      $requete = $this->getBDD()->prepare("INSERT INTO utilisateurs(nom, prenom, poste, identifiant, mdp, role) VALUES(?, ?, ?, ?, ?, ?)");
      $requete->execute([$nom, $prenom, $poste, $identifiant, $mdp, $role]);
      return true;
   }
   public function modifierUtilisateur($idUtilisateur, $nom, $prenom, $poste, $idEquipe, $role)
   {
      $identifiant = strtolower($prenom) . "." . strtolower($nom);
      $requete = $this->getBDD()->prepare("UPDATE utilisateurs SET nom = ?, prenom = ?, poste = ?, idEquipe = ?, identifiant=?, role=? WHERE idUtilisateur = ?");
      $requete->execute([$nom, $prenom, $poste, $idEquipe, $identifiant, $role, $idUtilisateur]);
      return true;
   }
   public function modifierAvatar($avatar, $idUtilisateur)
   {
      $requete = $this->getBDD()->prepare("UPDATE utilisateurs SET avatar = ? WHERE idUtilisateur = ?");
      $requete->execute([$avatar, $idUtilisateur]);
      return true;

      $this->avatar = $avatar;
      $this->idUtilisateur = $idUtilisateur;
   }
   public function supprimerUtilisateur($idUtilisateur)
   {
      $requete = $this->getBDD()->prepare("DELETE FROM utilisateurs WHERE idUtilisateur = ?");
      $requete->execute([$idUtilisateur]);
      return true;
   }
   public function recupererInterlocuteurProcedure($idDiscussion)
   {
      $idUtilisateur = $_SESSION["idUtilisateur"];
      $requete = $this->getBDD()->prepare("CALL recupererInterlocuteur(?, ?)");
      $requete->execute([$idDiscussion, $idUtilisateur]);
      $result = $requete->fetch(PDO::FETCH_ASSOC);
   }
   // public function recupererInterlocuteur($idDiscussion)
   // {
   //    $requete = $this->getBDD()->prepare("SELECT idEnvoyeur, idDestinataire FROM discussions WHERE idDiscussion = ?");
   //    $requete->execute([$idDiscussion]);
   //    $result = $requete->fetch(PDO::FETCH_ASSOC);
   //    if ($_SESSION["idUtilisateur"] == $result["idEnvoyeur"]) {
   //       $identifiant = $this->recupererUtilisateur($result["idDestinataire"]);
   //       return $identifiant["identifiant"];
   //    } else {
   //       $identifiant = $this->recupererUtilisateur($result["idEnvoyeur"]);
   //       return $identifiant["identifiant"];
   //    }
   // }
   public function recupererEquipesViaIdUtilisateur($idUtilisateur)
   {
      $requete = $this->getBDD()->prepare("SELECT * FROM utilisateurs LEFT JOIN composition_equipes USING(idUtilisateur) LEFT JOIN equipes USING(idEquipe) WHERE idUtilisateur = ?");
      $requete->execute([$idUtilisateur]);
      $equipe = $requete->fetchAll(PDO::FETCH_ASSOC);
      return $equipe;
   }
   public function recupererNomRoleViaIdRole($idRole)
   {
      $requete = $this->getBDD()->prepare("SELECT nomRole FROM roles WHERE idRole = ?");
      $requete->execute([$idRole]);
      return $requete->fetch(PDO::FETCH_ASSOC);
   }

   public function getidUtilisateur()
   {
      return $this->idUtilisateur;
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
   public function getRole()
   {
      return $this->role;
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
