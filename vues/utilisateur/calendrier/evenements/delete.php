<?php
//delete.php
include_once '../config/Database.php';
$database = new Database();
$db = $database->getConnection();

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