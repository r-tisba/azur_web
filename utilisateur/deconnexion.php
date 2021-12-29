<?php
require_once "entete.php";
$services = new Service();
@session_start();

// On détruit les variables de notre session
session_unset();

// On détruit la session
session_destroy();

?>
<div class="container">
    <div class="alert alert-success mt-3">
        Vous avez été déconnecté<br>
        Vous allez être redirigé vers la page d'accueil<br>
        <a href="index.php">Cliquez ici pour une redirection manuelle</a>
    </div>
</div>
<?php
$services->redirect("index.php");
?>

<?php
require_once "pied.php";
