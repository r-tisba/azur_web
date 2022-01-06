<?php

class Modele
{
    protected function getBdd()
    {
        // INITIALISATION DE LA CONNEXION A LA BDD
        // LOCAL
        return new PDO('mysql:host=localhost;dbname=gestion;charset=UTF8', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

        // WEB
        // return new PDO('mysql:host=ipssisqazur.mysql.db;dbname=ipssisqazur;charset=UTF8', 'ipssisqazur', 'Ipssi2022azur', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    }
}

require_once "../modeles/modele.php";
// require_once "../modeles/depense.php";
require_once "../modeles/discussion.php";
require_once "../modeles/message.php";
// require_once "../modeles/revenu.php";
require_once "../modeles/secteur.php";
//require_once "../modeles/solde.php";
require_once "../modeles/utilisateur.php";
require_once "../services/fonctions.php";
require_once "../modeles/equipe.php";
require_once "../modeles/projet.php";
require_once "../modeles/messageGroupe.php";
require_once "../modeles/discussionGroupe.php";
require_once "../modeles/etape.php";
