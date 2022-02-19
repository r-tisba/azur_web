<?php
if (!empty($_SESSION["role"]) && $_SESSION["role"] == "Admin" || $_SESSION["role"] == "SuperAdmin")
{
    header("location:vues/utilisateur/index.php");
} else if (!empty($_SESSION["role"]) && $_SESSION["role"] == "Utilisateur")
{
    header("location:vues/utilisateur/index.php");
} else
{
    header("location:vues/visiteur/index.php");
}
