<?php
//load.php
include_once '../config/Database.php';
$database = new Database();
$db = $database->getConnection();

if (file_exists("../../../../services/fonctions.php")) {
    require_once "../../../../services/fonctions.php";
} else if (file_exists("../../../../../services/fonctions.php")) {
    require_once "../../../../../services/fonctions.php";
}
$service = new Service();
$service->myRequireOnce("modeles/modele.php");

$objetUtilisateur = new Utilisateur();
session_start();

$data = array();
$query = "SELECT e.id, e.title, e.description, e.start, e.end, e.url, e.nom_url, e.backgroundColor, e.borderColor, e.textColor, u.idUtilisateur, u.identifiant, e.idCreateur
FROM evenements e LEFT JOIN utilisateurs u ON e.idCreateur = u.idUtilisateur ORDER BY e.start ASC";

$statement = $db->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$arrayParticipants = [];
$i = 0;
// $participants = [];
foreach ($result as $row) {

    // Si l'événement est la deadline d'un projet
    if(strpos($row['title'], 'Deadline') !== false)
    {
        $objetProjet = new Projet();
        $nomProjet = str_replace('Deadline ', '', $row['title']);
        $projet = $objetProjet->recupererProjetViaTitre($nomProjet);

        $data[] = array(
            'id' => $row["id"],
            'title' => $row["title"],
            'description' => $row["description"],
            'start' => $row["start"],
            'end' => $row["end"],
            'backgroundColor' => $row["backgroundColor"],
            'borderColor' => $row["borderColor"],
            'textColor' => $row["textColor"],
            'url' => $row["url"],
            'nom_url' => $row["nom_url"],
            'idCreateur' => $row["idCreateur"],
            'createur' => $row["identifiant"],
        );
        $idEvenement = $data[$i]['id'];
        $objetEquipe = new Equipe($projet['idEquipe']);
        $membresEquipe = $objetEquipe->getMembres();

        // Tout les membres du projet en question sont participants
        if (!empty($membresEquipe)) {
            $m = 0;
            foreach ($membresEquipe as $membreEquipe) {
                $arrayParticipants[$m] = $membreEquipe['identifiant'];
                $m++;
            }
            $data[$i] += array(
                'participants' => $arrayParticipants,
            );
            $arrayParticipants = [];

            $i++;
        }
        
    }
    if (verifAssociationUtilisateurEvenement($row["id"])) {
        $data[] = array(
            'id' => $row["id"],
            'title' => $row["title"],
            'description' => $row["description"],
            'start' => $row["start"],
            'end' => $row["end"],
            'backgroundColor' => $row["backgroundColor"],
            'borderColor' => $row["borderColor"],
            'textColor' => $row["textColor"],
            'url' => $row["url"],
            'nom_url' => $row["nom_url"],
            'idCreateur' => $row["idCreateur"],
            'createur' => $row["identifiant"],
        );
        $idEvenement = $data[$i]['id'];

        $participants = $objetUtilisateur->recupererParticipantsViaIdEvenement($idEvenement);
        if (!empty($participants)) {
            $n = 1;
            foreach ($participants as $participant) {
                $arrayParticipants[$n] = $participant['identifiant'];
                $n++;
            }
            $data[$i] += array(
                'participants' => $arrayParticipants,
            );
            $arrayParticipants = [];
        }
        $i++;
    }
}
echo json_encode($data);

/* ------------------ FONCTION VERFIF SI UTILISATEUR AFFECTES A EVENEMENT ------------------ */

function verifAssociationUtilisateurEvenement($idEvenement)
{
    $idUtilisateur = $_SESSION["idUtilisateur"];
    $database = new Database();
    $db = $database->getConnection();

    $query = "SELECT idEvenement, idUtilisateur FROM participants_evenements WHERE idEvenement = :idEvenement AND idUtilisateur = :idUtilisateur";
    $statement = $db->prepare($query);
    $statement->execute(
        array(
            ':idUtilisateur' => $idUtilisateur,
            ':idEvenement' => $idEvenement
        )
    );
    $result = $statement->fetch();

    if (!empty($result)) {
        return true;
    } else {
        return false;
    }
}
