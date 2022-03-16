<?php
require_once "modeles/modele.php";

use PHPUnit\Framework\TestCase;

class DiscussionTest extends TestCase
{
    protected function setUp(): void
    {
        $_SESSION['idUtilisateur'] = 1;
        $this->discussion = array(
            "idEnvoyeur" => 2,
            "idDestinataire" => 4
        );
    }
    public function testCreerDiscussion()
    {
        $idEnvoyeur = $this->discussion['idEnvoyeur'];
        $idDestinataire = $this->discussion['idDestinataire'];
        $objetDiscussion = new Discussion();
        $this->assertTrue($objetDiscussion->creerDiscussion($idEnvoyeur, $idDestinataire));
    }
    public function testRecupererDiscussionViaEnvoyeurDestinataire()
    {
        $idEnvoyeur = $this->discussion['idEnvoyeur'];
        $idDestinataire = $this->discussion['idDestinataire'];
        $objetDiscussion = new Discussion();
        $this->assertGreaterThanOrEqual(1, count($objetDiscussion->recupererDiscussionViaEnvoyeurDestinataire($idEnvoyeur, $idDestinataire)));
    }
    public function testRecupererDerniereDiscussion()
    {
        $objetDiscussion = new Discussion();
        $this->assertIsArray($objetDiscussion->recupererDerniereDiscussion());
    }
    public function testSupprimerDiscussion()
    {
        $objetDiscussion = new Discussion();
        $resultat = $objetDiscussion->recupererDerniereDiscussion();
        $idDiscussion = $resultat['idDiscussion'];
        $this->assertTrue($objetDiscussion->supprimerDiscussion($idDiscussion));
    }
    // public function testInitialiserDiscussion()
    // {
    //     $idEnvoyeur = $this->discussion['idEnvoyeur'];
    //     $idDestinataire = $this->discussion['idDestinataire'];
    //     $objetDiscussion = new Discussion();
    //     $resultat = $objetDiscussion->recupererDerniereDiscussion();
    //     $idDiscussion = $resultat['idDiscussion'];
    //     $this->assertTrue($objetDiscussion->supprimerDiscussion($idDiscussion));
    // }
}