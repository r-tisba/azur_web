<?php
//update.php
include_once '../config/Database.php';
$database = new Database();
$db = $database->getConnection();

if(isset($_POST["id"]))
{
 $query = "
 UPDATE evenements
 SET title=:title, description=:description, start=:start, end=:end
 WHERE id=:id
 ";
 $statement = $db->prepare($query);
 $statement->execute(
  array(
   ':title'  => $_POST['title'],
   ':description'  => $_POST['description'],
   ':start' => $_POST['start'],
   ':end' => $_POST['end'],
   ':id'   => $_POST['id']
  )
 );
}

?>