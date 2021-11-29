<?php
session_start();

if (empty($_SESSION["identifiant"])) {
    header("location:../../index.php");
}
?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Azur - EDT</title>
    <link rel="shortcut icon" href="../../images/design/logo.png" type="image/x-icon">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="fullcalendar/daygrid/main.css">
    <link rel="stylesheet" href="fullcalendar/timegrid/main.css">
    <link rel="stylesheet" href="fullcalendar/list/main.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css" rel="stylesheet" media="all"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <link rel="stylesheet" href="../../style/fontawesome/css/all.css">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

    <link href="css/fullcalendar.css" rel="stylesheet" />
    <link href="css/fullcalendar.print.css" rel="stylesheet" media="print" />
    <link rel="stylesheet" href="css/styleCalendrier.css" />
    <script src="js/moment.min.js"></script>
    <script src="js/fullcalendar.js"></script>

    <!-- <script src='fullcalendar/core/locales/fr.js'></script> -->
    <script src='fullcalendar/core/locales-fr.js'></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/locale/fr.js"></script> -->
