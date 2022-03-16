<?php
require_once "modeles/modele.php";

use PHPUnit\Framework\TestCase;

class ProjetTest extends TestCase
{
    public function testRecupererProjet()
    {
        $objetProjet = new Projet();
        $this->assertIsArray($objetProjet->recupererProjets());
    }
    public function testRecupererEtapesProjet()
    {
        $idProjet = 1;
        $objetProjet = new Projet();
        $this->assertIsArray($objetProjet->recupererEtapesProjet($idProjet));
    }
    public function testRecupererEtapesProjetNonFini()
    {
        $idProjet = 1;
        $objetProjet = new Projet();
        $this->assertIsArray($objetProjet->recupererEtapesProjetNonFini($idProjet));
    }
    public function testRecupererProjetsEquipe()
    {
        $idEquipe = 1;
        $objetProjet = new Projet();
        $this->assertIsArray($objetProjet->recupererProjetsEquipe($idEquipe));
    }
    public function testRecupererEquipeViaProjet()
    {
        $idProjet = 1;
        $objetProjet = new Projet();
        $this->assertIsArray($objetProjet->recupererEquipeViaProjet($idProjet));
    }
}