<?php

//load.php
include_once '../config/Database.php';
$database = new Database();
$db = $database->getConnection();

$data = array();

$query = "SELECT e.id, e.title, e.description, e.start, e.end, e.url, e.nom_url, e.backgroundColor, e.borderColor, e.textColor, u.idUtilisateur, u.identifiant, e.idCreateur
FROM evenements e LEFT JOIN utilisateurs u ON e.idCreateur = u.idUtilisateur ORDER BY e.start ASC";

$statement = $db->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach ($result as $row)
{
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
    );
}

echo json_encode($data);

/* ------------------ FONCTION VERFIF SI UTILISATEURS AFFECTES A EVENEMENTS ------------------ */

function verifAssociationUtilisateurEvenement($idEvenement)
{
    $database = new Database();
    $db = $database->getConnection();

    $idUtilisateur = $_SESSION["idUtilisateur"];

    $verif = "SELECT idEvenement, idUtilisateur FROM affectation_evenement WHERE idEvenement = $idEvenement AND idUtilisateur = $idUtilisateur";
    $statement = $db->prepare($verif);
    $statement->execute();
    $result = $statement->fetch();

    if (!empty($result))
    {
        return true;
    } else
    {
        return false;
    }
}

?>

