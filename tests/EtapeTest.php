<?php
require_once "modeles/modele.php";

use PHPUnit\Framework\TestCase;

class EtapeTest extends TestCase
{
    protected function setUp(): void
    {
        $objetEtape = new Etape();
        $resultat = $objetEtape->recupererDerniereEtape();
        $this->etape = array("idEtape" => $resultat['idEtape']);
    }
    public function testRecupererProjetViaEtape()
    {
        $idEtape = 5;
        $objetEtape = new Etape();
        $this->assertIsArray($objetEtape->recupererProjetViaEtape($idEtape));
    }
    public function testRecupererDerniereEtape()
    {
        $objetEtape = new Etape();
        $this->assertIsArray($objetEtape->recupererDerniereEtape());
    }
    public function testValiderEtape()
    {
        $idEtape = $this->etape['idEtape'];
        $objetEtape = new Etape();
        $this->assertTrue($objetEtape->validerEtape($idEtape));
    }
    public function testInvaliderEtape()
    {
        $idEtape = $this->etape['idEtape'];
        $objetEtape = new Etape();
        $this->assertTrue($objetEtape->invaliderEtape($idEtape));
    }
    public function testEtapeEnCours()
    {
        $idEtape = $this->etape['idEtape'];
        $objetEtape = new Etape();
        $this->assertNotNull($objetEtape->etapeEnCours($idEtape));
    }
}