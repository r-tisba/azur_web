<?php
if (!empty($_SESSION["idRole"]) && $_SESSION["idRole"] == 2) 
{
    header("location:admin/index.php");
} else if (!empty($_SESSION["idRole"]) && $_SESSION["idRole"] == 1) 
{
    header("location:membre/index.php");
} else
{
    header("location:visiteur/index.php");
}
