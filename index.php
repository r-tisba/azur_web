<?php
if (!empty($_SESSION["role"]) && $_SESSION["role"] == "Admin" || $_SESSION["role"] == "SuperAdmin")
{
    header("location:utilisateur/index.php");
} else if (!empty($_SESSION["role"]) && $_SESSION["role"] == "Utilisateur")
{
    header("location:utilisateur/index.php");
} else
{
    header("location:visiteur/index.php");
}
