<?php
//delete.php
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

// Vérifie si l'utilisateur tente d'accéder à cette page via l'url
if(!isset($_SERVER['HTTP_REFERER'])){
    $service->redirectNow('../calendrier.php');
    exit;
}

if(isset($_POST["id"]))
{
 $query = "
 DELETE from evenements WHERE id=:id
 ";
 $statement = $db->prepare($query);
 $statement->execute(
  array(
   ':id' => $_POST['id']
  )
 );
}