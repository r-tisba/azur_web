<?php
// Headers requis
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// La bonne méthode est utilisée
if ($_SERVER['REQUEST_METHOD'] == 'DELETE')
{
    // On inclut les fichiers de configuration et d'accès aux données
    include_once '../config/Database.php';
    include_once '../models/Evenements.php';

    // On instancie la base de données
    $database = new Database();
    $db = $database->getConnection();

    // On instancie l'objet événement
    $evenement = new Evenements($db);

    // On recupère l'id de l'événement
    $donnees = json_decode(file_get_contents("php://input"));

    if(!empty($donnees->id))
    {
        $evenement->id = $donnees->id;
        if($evenement->supprimer())
        {
            // On envoie un code 200
            http_response_code(200);
            echo json_encode(["message" => "La suppression a été effectué"]);
        } else {
            // On envoie un code 503 (n'a pas fonctionné)
            http_response_code(503);
            echo json_encode(["message" => "La suppression n'a pas été effectué"]);
        }
    }

} else {
    http_response_code(405);
    echo json_encode(["message" => "La méthode n'est pas autorisée"]);
}