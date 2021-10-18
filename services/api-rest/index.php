<?php
$sql = "SELECT * FROM evenements";
$db = new PDO('mysql:host=localhost;dbname=calendrier;charset=UTF8', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
$stmt = $db->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll();

file_put_contents("output.txt", json_encode($result));
//print_r(file_put_contents("output.txt", json_encode($result)));
var_dump($result);
?>