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
if(file_exists("../services/fonctions.php")) { require_once "../services/fonctions.php"; }
else if(file_exists("../../services/fonctions.php")) { require_once "../../services/fonctions.php"; }
$service = new Service();

$service->myRequireOnce("modeles/discussion.php");
$service->myRequireOnce("modeles/message.php");
$service->myRequireOnce("modeles/utilisateur.php");
$service->myRequireOnce("modeles/equipe.php");
$service->myRequireOnce("modeles/projet.php");
$service->myRequireOnce("modeles/messageGroupe.php");
$service->myRequireOnce("modeles/discussionGroupe.php");
$service->myRequireOnce("modeles/etape.php");