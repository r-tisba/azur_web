<?php
require_once "modeles/modele.php";

use PHPUnit\Framework\TestCase;

class MessageGroupeTest extends TestCase
{
    protected function setUp(): void
    {
        $this->messageGroupe = array(
            "idEquipe" => 1,
            "idUtilisateur" => 1,
            "contenu" => "Message test unitaire",
            "date" => "2021-03-16 11:21:00"
        );
    }
    public function testRecupererMessage()
    {
        $idMessageGroupe = 1;
        $objetMessageGroupe = new MessageGroupe();
        $this->assertIsArray($objetMessageGroupe->recupererMessage($idMessageGroupe));
    }
    public function testRecupererIdEquipeViaMessage()
    {
        $idMessageGroupe = 1;
        $objetMessageGroupe = new MessageGroupe();
        $this->assertIsArray($objetMessageGroupe->recupereridEquipeViaMessage($idMessageGroupe));
    }
    public function testRecupererIdDiscussionViaMessage()
    {
        $idMessage = 1;
        $objetMessageGroupe = new MessageGroupe();
        $this->assertIsArray($objetMessageGroupe->recupereridEquipeViaMessage($idMessage));
    }
    public function testAjoutMessage()
    {
        $idEquipe = $this->messageGroupe['idEquipe'];
        $idUtilisateur = $this->messageGroupe['idUtilisateur'];
        $contenu = $this->messageGroupe['contenu'];
        $objetMessage = new MessageGroupe();
        $this->assertTrue($objetMessage->ajoutMessage($idEquipe, $idUtilisateur, $contenu));
    }
    public function testModifierMessage()
    {
        $objetMessage = new MessageGroupe();
        $resultat = $objetMessage->recupererDernierMessageGroupeAjoute();
        $idMessageGroupe = $resultat['idMessageGroupe'];
        $contenu = $this->messageGroupe['contenu'];
        $this->assertTrue($objetMessage->modifierMessage($contenu, $idMessageGroupe));
    }
    public function testSupprimertMessage()
    {
        $objetMessage = new MessageGroupe();
        $resultat = $objetMessage->recupererDernierMessageGroupeAjoute();
        $idMessageGroupe = $resultat['idMessageGroupe'];
        $this->assertTrue($objetMessage->supprimerMessage($idMessageGroupe));
    }
}