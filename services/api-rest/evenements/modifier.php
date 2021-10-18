<?php
// Headers requis
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// La bonne méthode est utilisée
if ($_SERVER['REQUEST_METHOD'] == 'PUT')
{
    // On inclut les fichiers de configuration et d'accès aux données
    include_once '../config/Database.php';
    include_once '../models/Evenements.php';

    // On instancie la base de données
    $database = new Database();
    $db = $database->getConnection();

    // On instancie l'objet événement
    $evenement = new Evenements($db);

    $donnees = json_decode(file_get_contents("php://input"));
    print_r($donnees);

    if(!empty($donnees->id) && !empty($donnees->title) && !empty($donnees->description) && !empty($donnees->start) && !empty($donnees->end))
    {
        // On a reçu les données
        // On hydrate notre objet
        $evenement->id = $donnees->id;
        $evenement->title = $donnees->title;
        $evenement->description = $donnees->description;
        $evenement->start = $donnees->start;
        $evenement->end = $donnees->end;

        if($evenement->modifier())
        {
            // On envoie un code 200
            http_response_code(200);
            echo json_encode(["message" => "La modification a été effectué"]);
        } else {
            // On envoie un code 503 (n'a pas fonctionné)
            http_response_code(503);
            echo json_encode(["message" => "La modification n'a pas été effectué"]);
        }
    }
} else {
    http_response_code(405);
    echo json_encode(["message" => "La méthode n'est pas autorisée"]);
}