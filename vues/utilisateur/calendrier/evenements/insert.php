<?php

//insert.php
session_start();
$connect = new PDO('mysql:host=localhost;dbname=gestion', 'root', '');
$idCreateur = $_SESSION["idUtilisateur"];
if(isset($_POST["title"]))
{
 $query = "
 INSERT INTO evenements
 (title, description, start, end, idCreateur)
 VALUES (:title, :description, :start, :end, :idCreateur)
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':title'  => $_POST['title'],
   ':description' => $_POST['description'],
   ':start' => $_POST['start'],
   ':end' => $_POST['end'],
   ':idCreateur' => $idCreateur
  )
 );
}


?>
