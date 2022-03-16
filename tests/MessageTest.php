<?php
require_once "modeles/modele.php";

use PHPUnit\Framework\TestCase;

class MessageTest extends TestCase
{
    protected function setUp(): void
    {
        $this->message = array(
            "idDiscussion" => 1,
            "contenu" => "Message test unitaire",
            "date" => "2021-03-16 11:21:00",
            "idUtilisateur" => 1
        );
    }
    public function testRecupererMessage()
    {
        $idMessage = 1;
        $objetMessage = new Message();
        $this->assertIsArray($objetMessage->recupererMessage($idMessage));
    }
    public function testRecupererMessages()
    {
        $idDiscussion = 1;
        $objetMessage = new Message();
        $this->assertIsArray($objetMessage->recupererMessages($idDiscussion));
    }
    public function testRecupererIdDiscussionViaMessage()
    {
        $idMessage = 1;
        $objetMessage = new Message();
        $this->assertIsArray($objetMessage->recupererIdDiscussionViaMessage($idMessage));
    }
    public function testRecupererDernierMessage()
    {
        $idDiscussion = 1;
        $objetMessage = new Message();
        $this->assertIsArray($objetMessage->recupererDernierMessage($idDiscussion));
    }
    public function testRecupererDernierMessageFull()
    {
        $idDiscussion = 1;
        $objetMessage = new Message();
        $this->assertIsArray($objetMessage->recupererDernierMessageFull($idDiscussion));
    }
    public function testAjoutMessage()
    {
        $idDiscussion = $this->message['idDiscussion'];
        $contenu = $this->message['contenu'];
        $idUtilisateur = $this->message['idUtilisateur'];
        $objetMessage = new Message();
        $this->assertTrue($objetMessage->ajoutMessage($idDiscussion, $contenu, $idUtilisateur));
    }
    public function testModifierMessage()
    {
        $objetMessage = new Message();
        $resultat = $objetMessage->recupererDernierMessageAjoute();
        $idMessage = $resultat['idMessage'];
        $contenu = $this->message['contenu'];
        $this->assertTrue($objetMessage->modifierMessage($contenu, $idMessage));
    }
    public function testSupprimertMessage()
    {
        $objetMessage = new Message();
        $resultat = $objetMessage->recupererDernierMessageAjoute();
        $idMessage = $resultat['idMessage'];
        $this->assertTrue($objetMessage->supprimerMessage($idMessage));
    }
    public function testSupprimertMessageDiscussion()
    {
        $idDiscussion = -1;
        $objetMessage = new Message();
        $this->assertTrue($objetMessage->supprimerMessagesDiscussion($idDiscussion));
    }
}