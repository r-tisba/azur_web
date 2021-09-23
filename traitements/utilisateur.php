<?php
function verifConnexion()
{
    if (isset($_SESSION["identifiant"]) && !empty($_SESSION["identifiant"]))
    {
        return true;
    } else { 
        return false; 
    }

}