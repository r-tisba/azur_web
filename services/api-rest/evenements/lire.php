<?php
// Headers requis
// Accès depuis n'importe quel site ou appareil (*)
header("Access-Control-Allow-Origin: *");

// Format des données envoyées
header("Content-Type: application/json; charset=UTF-8");

// Méthode autorisée
header("Access-Control-Allow-Methods: GET");

// Durée de vie de la requête
header("Access-Control-Max-Age: 3600");

// Entêtes autorisées
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// La bonne méthode est utilisée
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    // On inclut les fichiers de configuration et d'accès aux données
    include_once '../config/Database.php';
    include_once '../models/Evenements.php';

    // On instancie la base de données
    $database = new Database();
    $db = $database->getConnection();

    // On instancie l'objet événement
    $evenement = new Evenements($db);

    // On récupère les données
    $stmt = $evenement->lire();

    // On vérifie si on a au moins 1 événement
    if ($stmt->rowCount() > 0) {
        // On initialise un tableau associatif
        $tableauEvenements = [];

        // On parcourt les produits
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $prod = [
                "id" => $id,
                "title" => $title,
                "description" => $description,
                "start" => $start,
                "end" => $end,
                // "url" => $url,
                // "nom_url" => $nom_url,
                "backgroundColor" => $backgroundColor,
                "borderColor" => $borderColor,
                "textColor" => $textColor,
                "idEmploye" => $idEmploye,
                "identifiant" => $identifiant,
            ];

            $tableauEvenements[] = $prod;
        }
        // On envoie le code réponse 200 OK
        http_response_code(200);

        // On encode en json et on envoie
        echo json_encode($tableauEvenements);
    }
} else {
    // Mauvaise méthode, on gère l'erreur
    http_response_code(405);
    echo json_encode(["message" => "La méthode n'est pas autorisée"]);
}
