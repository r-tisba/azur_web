<?php
require_once "modeles/modele.php";

use PHPUnit\Framework\TestCase;

class EquipeTest extends TestCase
{
    public function testRecupererEquipes()
    {
        $objetEquipe = new Equipe();
        $this->assertIsArray($objetEquipe->recupererEquipes());
    }
    public function testVerifierPresenceUtilisateurEquipe()
    {
        $idUtilisateur = 1;
        $idEquipe = 3;
        $objetEquipe = new Equipe();
        $this->assertTrue($objetEquipe->verifierPresenceUtilisateurEquipe($idUtilisateur, $idEquipe));
    }
}