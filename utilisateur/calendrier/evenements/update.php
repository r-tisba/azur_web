<?php

//update.php

$connect = new PDO('mysql:host=localhost;dbname=gestion', 'root', '');

if(isset($_POST["id"]))
{
 $query = "
 UPDATE evenements
 SET title=:title, description=:description, start=:start, end=:end
 WHERE id=:id
 ";
 $statement = $connect->prepare($query);
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