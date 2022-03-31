<?php
//insert.php
include_once '../config/Database.php';
$database = new Database();
$db = $database->getConnection();

if(file_exists("../../../../services/fonctions.php")) { require_once "../../../../services/fonctions.php"; }
else if(file_exists("../../../../../services/fonctions.php")) { require_once "../../../../../services/fonctions.php"; }
$service = new Service();
$service->myRequireOnce("modeles/modele.php");

// Vérifie si l'utilisateur tente d'accéder à cette page via l'url
if(!isset($_SERVER['HTTP_REFERER'])){
    $service->redirectNow('../calendrier.php');
    exit;
}

session_start();
$idCreateur = $_SESSION["idUtilisateur"];
$objetUtilisateur = new Utilisateur();

if (isset($_POST["title"])) 
{
    $query = "
    INSERT INTO evenements
    (title, description, start, end, idCreateur)
    VALUES (:title, :description, :start, :end, :idCreateur)
    ";
    $statement = $db->prepare($query);
    $statement->execute(
        array(
            ':title' => $_POST['title'],
            ':description' => $_POST['description'],
            ':start' => $_POST['start'],
            ':end' => $_POST['end'],
            ':idCreateur' => $idCreateur
        )
    );

    $query = "SELECT id FROM evenements WHERE title=:title";
    $statement = $db->prepare($query);
    $statement->execute(
        array(
            ':title' => $_POST['title']
        )
    );
    $result = $statement->fetch();
    $idEvenement = $result['id'];

    $participants = $_POST['participants'];
    foreach ($participants as $participant) {
        $requete = $objetUtilisateur->recupererIdUtilisateurViaIdentifiant($participant);
        $idParticipant = $requete['idUtilisateur'];
        $query = " INSERT INTO participants_evenements (idUtilisateur, idEvenement) VALUES (:idUtilisateur, :idEvenement)";
        $statement = $db->prepare($query);
        $statement->execute(
            array(
                ':idUtilisateur' => $idParticipant,
                ':idEvenement' => $idEvenement
            )
        );
    }
}