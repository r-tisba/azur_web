<?php

class Utilisateur extends Modele
{
   private $idUtilisateur;
   private $nom;
   private $prenom;
   private $poste;
   private $identifiant;
   private $mdp;
   private $role;
   private $avatar;
   private $token;
   private $validation;

   public function __construct($idUtilisateur = null)
   {
      if ($idUtilisateur !== null) {
         $requete = $this->getBdd()->prepare("SELECT * FROM utilisateurs WHERE idUtilisateur = ?");
         $requete->execute([$idUtilisateur]);
         $infos = $requete->fetch(PDO::FETCH_ASSOC);

         $this->idUtilisateur = $idUtilisateur;
         $this->nom = $infos["nom"];
         $this->prenom = $infos["prenom"];
         $this->poste = $infos["poste"];
         $this->identifiant = $infos["identifiant"];
         $this->mdp = $infos["mdp"];
         $this->role = $infos["role"];
         $this->avatar = $infos["avatar"];
         $this->token = $infos["token"];
         $this->validation = $infos["validation"];
      }
   }

   public function recupererUtilisateurs()
   {
      $requete = $this->getBDD()->prepare("SELECT * FROM utilisateurs");
      $requete->execute();
      return $requete->fetchAll(PDO::FETCH_ASSOC);
   }
   // public function recupererUtilisateur($idUtilisateur)
   // {
   //    $requete = $this->getBDD()->prepare("SELECT * FROM utilisateurs WHERE idUtilisateur = ?");
   //    $requete->execute([$idUtilisateur]);
   //    return $requete->fetch(PDO::FETCH_ASSOC);
   // }
   public function recupererInfosConnexion($identifiant)
   {
      $requete = $this->getBDD()->prepare("SELECT idUtilisateur, identifiant, mdp, role FROM utilisateurs WHERE identifiant = ?");
      $requete->execute([$identifiant]);
      return $requete;
   }
   public function recupererIdentifiantsUtilisateurs()
   {
      $requete = $this->getBDD()->prepare("SELECT identifiant FROM utilisateurs");
      $requete->execute();
      return $requete->fetchAll(PDO::FETCH_ASSOC);
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
   public function validerUtilisateur($idUtilisateur, $mdp)
   {
      $validation = 1;
      $requete = $this->getBDD()->prepare("UPDATE utilisateurs SET mdp = ?, validation = ? WHERE idUtilisateur = ?");
      $requete->execute([$mdp, $validation, $idUtilisateur]);
      return true;
   }
   public function supprimerUtilisateur($idUtilisateur)
   {
      $requete = $this->getBDD()->prepare("DELETE FROM utilisateurs WHERE idUtilisateur = ?");
      $requete->execute([$idUtilisateur]);
      return true;
   }
   public function recupererUtilisateursRolesCompositionViaEquipe($idEquipe)
   {
      $requete = $this->getBDD()->prepare("SELECT * FROM equipes INNER JOIN composition_equipes USING(idEquipe) INNER JOIN utilisateurs USING(idUtilisateur) INNER JOIN roles ON utilisateurs.role = roles.nomRole WHERE idEquipe=?");
      $requete->execute([$idEquipe]);
      return $requete->fetchAll(PDO::FETCH_ASSOC);
   }
   public function recupererInterlocuteurProcedure($idDiscussion)
   {
      $idUtilisateur = $_SESSION["idUtilisateur"];
      $requete = $this->getBDD()->prepare("CALL recupererInterlocuteur(?, ?)");
      $requete->execute([$idDiscussion, $idUtilisateur]);
      return $requete->fetch(PDO::FETCH_ASSOC);
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
   public function recupererIdUtilisateurViaIdentifiant($identifiant)
   {
      $requete = $this->getBDD()->prepare("SELECT idUtilisateur FROM utilisateurs WHERE identifiant = ?");
      $requete->execute([$identifiant]);
      $idUtilisateur = $requete->fetch(PDO::FETCH_ASSOC);
      return $idUtilisateur;
   }
   public function recupererParticipantsViaIdEvenement($idEvenement)
   {
      $requete = $this->getBDD()->prepare("SELECT idUtilisateur, identifiant FROM utilisateurs LEFT JOIN participants_evenements USING(idUtilisateur) WHERE idEvenement = ?");
      $requete->execute([$idEvenement]);
      $utilisateur = $requete->fetchAll(PDO::FETCH_ASSOC);
      return $utilisateur;
   }
   public function recupererValidation($idUtilisateur)
   {
      $requete = $this->getBDD()->prepare("SELECT validation FROM utilisateurs WHERE idUtilisateur = ?");
      $requete->execute([$idUtilisateur]);
      return $requete->fetch(PDO::FETCH_ASSOC);
   }

   /* ------------------------------------- TOKEN ------------------------------------- */
   public function recupererToken($identifiant)
   {
      $requete = $this->getBDD()->prepare("SELECT token FROM utilisateurs WHERE identifiant = ?");
      $requete->execute([$identifiant]);
      return $requete->fetch(PDO::FETCH_ASSOC);
   }
   // Vérifie l'existance du token
   public function verifierToken($identifiant)
   {
      $requete = $this->getBDD()->prepare("SELECT token FROM utilisateurs WHERE identifiant = ?");
      $requete->execute([$identifiant]);
      // fetchColumn() est comme rowCount() mais il fonctionne
      $rows = $requete->fetchColumn();
      if($rows > 0) { // Token trouvé
         return true; }
      else {  // Token non trouvé
         return false; }
   }
   // Vérifie si l'association id-token existe
   public function verifierAssociationToken($idUtilisateur, $token)
   {
      $requete = $this->getBDD()->prepare("SELECT * FROM utilisateurs WHERE idUtilisateur = ? AND token = ?");
      $requete->execute([$idUtilisateur, $token]);
      // fetchColumn() est comme rowCount() mais il fonctionne
      $rows = $requete->fetchColumn();
      if($rows > 0) { // Association trouvé
         return true; }
      else {  // Association non trouvé
         return false; }
   }
   public function creerToken($token, $identifiant)
   {
      $requete = $this->getBDD()->prepare("UPDATE utilisateurs SET token = ? WHERE identifiant = ?");
      $requete->execute([$token, $identifiant]);
      return true;
   }

   public function getIdUtilisateur()
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
   public function getAvatar()
   {
      return $this->avatar;
   }
   public function getToken()
   {
      return $this->token;
   }
   public function getValidation()
   {
      return $this->validation;
   }
}