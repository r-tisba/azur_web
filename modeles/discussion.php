<?php

class Discussion extends Modele
{
    private $idDiscussion;
    private $idEnvoyeur;
    private $idDestinataire;
    private $discussions = [];

    public function __construct($idDiscussion = null)
    {
        $idUtilisateur = $_SESSION["idUtilisateur"];
        if ($idDiscussion !== null) {
            $requete = $this->getBdd()->prepare("SELECT * FROM discussions WHERE idDiscussion = ?");
            $requete->execute([$idDiscussion]);
            $discussion = $requete->fetch(PDO::FETCH_ASSOC);

            $this->idDiscussion = $idDiscussion;
            $this->idEnvoyeur = $discussion["idEnvoyeur"];
            $this->idDestinataire = $discussion["idDestinataire"];

            $requete = $this->getBdd()->prepare("SELECT * FROM messages WHERE idDiscussion = ?");
            $requete->execute([$idDiscussion]);
            $messages = $requete->fetchAll(PDO::FETCH_ASSOC);

            foreach ($messages as $message) {
                $objetMessage = new Message($message["idMessage"]);
                $this->messages[] = $objetMessage;
            }

            $requete = $this->getBdd()->prepare("SELECT * FROM discussions WHERE idEnvoyeur = ? OR idDestinataire = ?");
            $requete->execute([$idUtilisateur, $idUtilisateur]);
            $discussionsUtilisateur = $requete->fetchAll(PDO::FETCH_ASSOC);
            $this->discussions = $discussionsUtilisateur;
            
            // A SUPPR ?
            // Récupère toutes les discussions auxquelles l'utilisateur participe
            // $sqlEnv = "SELECT * FROM discussions WHERE idEnvoyeur = ?";
            // $sqlDes = "SELECT * FROM discussions WHERE idDestinataire = ?";

            // $requete = $this->getBdd()->prepare($sqlEnv);
            // $requete->execute([$idDiscussion]);
            // $discussionE = $requete->fetchAll(PDO::FETCH_ASSOC);
            // if(empty($discussionE)) { $discussionE = []; }

            // $requete = $this->getBdd()->prepare($sqlDes);
            // $requete->execute([$idDiscussion]);
            // $discussionD = $requete->fetchAll(PDO::FETCH_ASSOC);
            // if(empty($discussionD)) { $discussionD = []; }

            // $discussionsUtilisateur = array_merge($discussionE, $discussionD);
            // $this->discussions = $discussionsUtilisateur;

            // if(isset($discussion["idEnvoyeur"])) { $this->idEnvoyeur = $discussion["idEnvoyeur"]; }
            // if(isset($discussion["idDestinataire"])) { $this->idDestinataire = $discussion["idDestinataire"]; }
            
        }
    }
    // public function initialiserDiscussion($idDiscussion, $idEnvoyeur, $idDestinataire)
    // {
    //     $this->idDiscussion = $idDiscussion;
    //     $this->idEnvoyeur = $idEnvoyeur;
    //     $this->idDestinataire = $idDestinataire;

    //     $requete = $this->getBdd()->prepare("SELECT idMessage, contenu, date, idUtilisateur FROM messages WHERE idDiscussion = ?");
    //     $requete->execute([$idDiscussion]);
    //     $messagesDiscussion = $requete->fetchAll(PDO::FETCH_ASSOC);

    //     foreach ($messagesDiscussion as $messageDiscussion) {
    //         $objetMessage = new Message();
    //         $objetMessage->initialiserMessage($messageDiscussion["idMessage"], $messageDiscussion["contenu"], $messageDiscussion["date"], $messageDiscussion["idUtilisateur"]);
    //         $this->messages[] = $objetMessage;
    //     }
    // }
    // public function recupererDiscussions()
    // {
    //     $requete = $this->getBDD()->prepare("SELECT * FROM discussions");
    //     $requete->execute();
    //     return $requete->fetchAll(PDO::FETCH_ASSOC);
    // }
    // public function recupererDiscussion($idDiscussion)
    // {
    //     $requete = $this->getBDD()->prepare("SELECT * FROM discussions WHERE idDiscussion = ?");
    //     $requete->execute([$idDiscussion]);
    //     return $requete->fetch(PDO::FETCH_ASSOC);
    // }

    public function creerDiscussion($idEnvoyeur, $idDestinataire)
    {
        $requete = $this->getBDD()->prepare("INSERT INTO discussions(idEnvoyeur, idDestinataire) VALUES(?, ?)");
        $requete->execute([$idEnvoyeur, $idDestinataire]);
        return true;
    }
    // public function modifierDiscussion($idEnvoyeur, $idDestinataire, $idDiscussion)
    // {
    //     $requete = $this->getBDD()->prepare("UPDATE discussions SET idEnvoyeur=?, idDestinataire=? WHERE idDiscussion = ?");
    //     $requete->execute([$idEnvoyeur, $idDestinataire, $idDiscussion]);
    //     return true;
    // }
    public function supprimerDiscussion($idDiscussion)
    {
        $requete = $this->getBDD()->prepare("DELETE FROM discussions WHERE idDiscussion = ?");
        $requete->execute([$idDiscussion]);
        return true;
    }
    public function verifierDiscussion($idEnvoyeur, $idDestinataire)
    {
        $requete = $this->getBDD()->prepare("SELECT idDiscussion FROM discussions WHERE idEnvoyeur = ? AND idDestinataire = ?");
        $requete->execute([$idEnvoyeur, $idDestinataire]);
        $n=$requete->rowCount();
        if($n == 0)
        {
            $requete = $this->getBDD()->prepare("SELECT idDiscussion FROM discussions WHERE idEnvoyeur = ? AND idDestinataire = ?");
            $requete->execute([$idDestinataire, $idEnvoyeur]);
            $n=$requete->rowCount();
            if($n == 0)
            {
                // Discussion non trouvé
                return false;
            } else
            {
                return $requete->fetch(PDO::FETCH_ASSOC);;
            }
        } else {
            return $requete->fetch(PDO::FETCH_ASSOC);;
        }
    }
    public function recupererDiscussionViaEnvoyeurDestinataire($idEnvoyeur, $idDestinataire)
    {
        $requete = $this->getBDD()->prepare("SELECT idDiscussion FROM discussions WHERE idEnvoyeur = ? AND idDestinataire = ?");
        $requete->execute([$idEnvoyeur, $idDestinataire]);
        return $requete->fetch(PDO::FETCH_ASSOC);
    }
    public function recupererDerniereDiscussion()
    {
        $requete = $this->getBDD()->prepare("SELECT idDiscussion FROM discussions ORDER BY idDiscussion DESC LIMIT 1");
        $requete->execute();
        return $requete->fetch(PDO::FETCH_ASSOC);
    }

        
    // -------------------------------------------------- PAGINATION --------------------------------------------------
    public function recupererNbDiscussions($idUtilisateur)
    {
        // On détermine le nombre total d'articles
        $sql = "SELECT COUNT(*) AS nb_discussions FROM discussions WHERE idEnvoyeur = ? OR idDestinataire = ?";
        // On prépare la requête
        $requete = $this->getBdd()->prepare($sql);
        // On exécute
        $requete->execute([$idUtilisateur, $idUtilisateur]);
        // On récupère le nombre d'articles
        return $requete->fetch(PDO::FETCH_ASSOC);
    }


    public function getIdDiscussion()
    {
        return $this->idDiscussion;
    }
    public function getIdEnvoyeur()
    {
        return $this->idEnvoyeur;
    }
    public function getIdDestinataire()
    {
        return $this->idDestinataire;
    }
    public function getDiscussions()
    {
        return $this->discussions;
    }

    public function __set($propriete, $valeur) 
    {
       if (property_exists($this, $propriete)) 
       {
         $this->$propriete = $valeur;
       }
       return $this;
    }
}
