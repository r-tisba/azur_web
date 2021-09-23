<?php
require_once "entete.php";

if(!isset($_SESSION["identifiant"]))
{
  header("location:../visiteur/index.php");
}

?>



<?php
require_once "pied.php";