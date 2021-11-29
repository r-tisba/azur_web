<?php

/* PAS ENCORE IMPLEMENTE */


// class Secteur extends Modele
// {
//     private $idSecteur;
//     private $nomSecteur;
//     private $budget;

//     public function __construct($idS = null)
//     {
//         if($idS != null)
//         {
//         if ($idS != null) {
//             $requete = $this->getBdd()->prepare("SELECT * FROM secteurs");
//             $requete->execute();
//             $secteur = $requete->fetchAll(PDO::FETCH_ASSOC);

//             $this->idSecteur = $idS;
//             $this->nomSecteur = $secteur["nomSecteur"];
//             $this->budget = $secteur["budget"];
//         }
//     }
// }

//     public function recupererSecteurs()
//     {
//         $requete = $this->getBDD()->prepare("SELECT * FROM secteurs");
//         $requete->execute();
//         return $requete->fetchAll(PDO::FETCH_ASSOC);
//     }

//     public function recupererSecteur($idSecteur)
//     {
//         $requete = $this->getBDD()->prepare("SELECT * FROM secteurs WHERE idSecteur = ?");
//         $requete->execute([$idSecteur]);
//         return $requete->fetch(PDO::FETCH_ASSOC);
//     }

//     public function creerSecteur($nomSecteur, $budget)
//     {
//         $requete = $this->getBDD()->prepare("INSERT INTO secteurs(nomSecteur, budget) VALUES(?, ?)");
//         $requete->execute([$nomSecteur, $budget]);
//         return true;
//     }

//     public function modifierSecteur($idSecteur, $nomSecteur, $budget)
//     {
//         $requete = $this->getBDD()->prepare("UPDATE secteurs SET nomSecteur = ?, budget = ? WHERE idSecteur = ?");
//         $requete->execute([$nomSecteur, $budget, $idSecteur]);
//         return true;
//     }

//     public function supprimerSecteur($idSecteur)
//     {
//         $requete = $this->getBDD()->prepare("DELETE FROM secteurs WHERE idSecteur = ?");
//         $requete->execute([$idSecteur]);
//         return true;
//     }


//     public function getIdSecteur()
//     {
//         return $this->idSecteur;
//     }
//     public function getNomSecteur()
//     {
//         return $this->nomSecteur;
//     }
//     public function getBudget()
//     {
//         return $this->budget;
//     }
// }
