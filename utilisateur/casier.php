<?php
use Dompdf\Dompdf;
use Dompdf\Options;

require_once "../dompdf/autoload.inc.php";
require_once "../modeles/modele.php";

$utilisateurs=new Utilisateur();
$users =$utilisateurs->recupererUtilisateurs();
ob_start();
require_once 'test.php';
$html=ob_get_contents();
ob_end_clean();

$options= new Options();
$options->set("default", "Courier");

$dompdf= new Dompdf();

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

$fichier="mes_tache.pdf";

$dompdf->stream($fichier);
