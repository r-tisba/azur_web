<?php

class Modele
{
    // -------------------------------- LOCAL --------------------------------
    // Propriétés de la base de données
    private $host = "localhost";
    private $db_name = "gestion";
    private $username = "root";
    private $password = "";
    protected function getBdd()
    {
        try {
            return new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=UTF8",
                $this->username,
                $this->password,
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
            );
        }
        // On gère les erreurs éventuelles
        catch (PDOException $exception) {
            echo "Erreur de connexion : " . $exception->getMessage();
        }
    }

    // // -------------------------------- WEB --------------------------------
    // protected function getBdd()
    // {
    //     // Propriétés de la base de données
    //     $host = "ipssisqazur.mysql.db";
    //     $db_name = "ipssisqazur";
    //     $username = "ipssisqazur";
    //     $password = "Ipssi2022azur";

    //     try {
    //         return new PDO(
    //             "mysql:host=" . $host . ";dbname=" . $db_name . ";charset=UTF8",
    //                 $username, $password,
    //                 array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    //         );
    //     }
    //     // On gère les erreurs éventuelles
    //     catch (PDOException $exception) {
    //         echo "Erreur de connexion : " . $exception->getMessage();
    //     }
    // }


    // protected function getBdd()
    // {
    //     // INITIALISATION DE LA CONNEXION A LA BDD
    //     // LOCAL
    //     // return new PDO('mysql:host=localhost;dbname=gestion;charset=UTF8', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    //     // WEB
    //     // return new PDO('mysql:host=ipssisqazur.mysql.db;dbname=ipssisqazur;charset=UTF8', 'ipssisqazur', 'Ipssi2022azur', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    // }
}



if (file_exists("../services/fonctions.php")) {
    require_once "../services/fonctions.php";
} else if (file_exists("../../services/fonctions.php")) {
    require_once "../../services/fonctions.php";
}
$service = new Service();

$service->myRequireOnce("modeles/discussion.php");
$service->myRequireOnce("modeles/message.php");
$service->myRequireOnce("modeles/utilisateur.php");
$service->myRequireOnce("modeles/equipe.php");
$service->myRequireOnce("modeles/projet.php");
$service->myRequireOnce("modeles/messageGroupe.php");
$service->myRequireOnce("modeles/discussionGroupe.php");
$service->myRequireOnce("modeles/etape.php");
