<?php

//update.php

$connect = new PDO('mysql:host=localhost;dbname=gestion', 'root', '');
if(isset($_POST["id"]))
{
 $query = "
 UPDATE evenements
 SET backgroundColor=:backgroundColor, borderColor=:borderColor
 WHERE id=:id
 ";
 $statement = $connect->prepare($query);
 print_r($_POST);
 $statement->execute(
  array(
   ':backgroundColor'  => $_POST['backgroundColor'],
   ':borderColor'  => $_POST['backgroundColor'],
   ':id'   => $_POST['id']
  )
 );
}

?>