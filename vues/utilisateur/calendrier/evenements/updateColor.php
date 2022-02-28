<?php
//update.php
include_once '../config/Database.php';
$database = new Database();
$db = $database->getConnection();

if(isset($_POST["id"]))
{
 $query = "
 UPDATE evenements
 SET backgroundColor=:backgroundColor, borderColor=:borderColor
 WHERE id=:id
 ";
 $statement = $db->prepare($query);
 $statement->execute(
  array(
   ':backgroundColor'  => $_POST['backgroundColor'],
   ':borderColor'  => $_POST['backgroundColor'],
   ':id'   => $_POST['id']
  )
 );
}

?>