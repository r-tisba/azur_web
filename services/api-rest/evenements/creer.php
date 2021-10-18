<?php
// Headers requis
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// La bonne méthode est utilisée
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    // On inclut les fichiers de configuration et d'accès aux données
    include_once '../config/Database.php';
    include_once '../models/Evenements.php';

    // On instancie la base de données
    $database = new Database();
    $db = $database->getConnection();

    // On instancie l'objet  événement
    $evenement = new Evenements($db);

    $donnees = json_decode(file_get_contents("php://input"));

    if(!empty($donnees->title) && !empty($donnees->description) && !empty($donnees->start) && !empty($donnees->end) && !empty($donnees->idCreateur))
    {
        // On a reçu les données
        // On hydrate notre objet
        $evenement->title = $donnees->title;
        $evenement->description = $donnees->description;
        $evenement->start = $donnees->start;
        $evenement->end = $donnees->end;
        $evenement->idCreateur = $donnees->idCreateur;

        if($evenement->creer())
        {
            // On envoie un code 201 (ajout)
            http_response_code(201);
            echo json_encode(["message" => "L'ajout a été effectué"]);
        } else {
            // On envoie un code 503 (n'a pas fonctionné)
            http_response_code(503);
            echo json_encode(["message" => "L'ajout n'a pas été effectué"]);
        }
    }

// Mauvaise méthode, on gère l'erreur
} else {
    http_response_code(405);
    echo json_encode(["message" => "La méthode n'est pas autorisée"]);
}