<?php
require_once "modeles/modele.php";

use PHPUnit\Framework\TestCase;

class UtilisateurTest extends TestCase
{
    public function testGetIdUtilisateur() {
        $Utilisateur = new Utilisateur();
        $Utilisateur->__set('idUtilisateur', 1);
        $this->assertEquals(1, $Utilisateur->getIdUtilisateur());
    }
    public function testGetIdentifiant() {
        $Utilisateur = new Utilisateur();
        $Utilisateur->__set('identifiant', 'John');
        $this->assertEquals('John', $Utilisateur->getIdentifiant());
    }
    public function testRecupererUtilisateurs()
    {
        $objetUtilisateur = new Utilisateur();
        $this->assertIsArray($objetUtilisateur->recupererUtilisateurs());
    }
    public function testRecupererInfosConnexion()
    {
        $identifiant = "john.doe";
        $objetUtilisateur = new Utilisateur();
        $this->assertNotNull($objetUtilisateur->recupererInfosConnexion($identifiant));
    }
    public function testRecupererIdentifiantsUtilisateurs()
    {
        $objetUtilisateur = new Utilisateur();
        $this->assertIsArray($objetUtilisateur->recupererIdentifiantsUtilisateurs());
    }
    public function testModifierAvatar()
    {
        $idUtilisateur = -1;
        $avatar = "../images/avatar/default_avatar.png";
        $objetUtilisateur = new Utilisateur();
        $this->assertTrue($objetUtilisateur->modifierAvatar($avatar, $idUtilisateur));
    }
    public function testValiderUtilisateur()
    {
        $idUtilisateur = -1;
        $mdp = "M0TdePa$\$e";
        $objetUtilisateur = new Utilisateur();
        $this->assertTrue($objetUtilisateur->validerUtilisateur($idUtilisateur, $mdp));
    }
    public function testRecupererUtilisateursRolesCompositionsViaEquipe()
    {
        $idEquipe = 1;
        $objetUtilisateur = new Utilisateur();
        $this->assertIsArray($objetUtilisateur->recupererUtilisateursRolesCompositionViaEquipe($idEquipe));
    }
    public function testRecupererInterlocuteurProcedure()
    {
        $idDiscussion = 1;
        $objetUtilisateur = new Utilisateur();
        $this->assertIsArray($objetUtilisateur->recupererInterlocuteurProcedure($idDiscussion));
    }
    public function testRecupererEquipesViaIdUtilisateur()
    {
        $idUtilisateur = 1;
        $objetUtilisateur = new Utilisateur();
        $this->assertIsArray($objetUtilisateur->recupererEquipesViaIdUtilisateur($idUtilisateur));
    }
    public function testRecupererNomRoleViaIdRole()
    {
        $idRole = 1;
        $objetUtilisateur = new Utilisateur();
        $this->assertIsArray($objetUtilisateur->recupererNomRoleViaIdRole($idRole));
    }
    public function testRecupererIdUtilisateurViaIdentifiant()
    {
        $identifiant = "john.doe";
        $objetUtilisateur = new Utilisateur();
        $this->assertIsArray($objetUtilisateur->recupererIdUtilisateurViaIdentifiant($identifiant));
    }
    public function testRecupererParticipantsViaIdEvenement()
    {
        $idEvenement = 1;
        $objetUtilisateur = new Utilisateur();
        $this->assertIsArray($objetUtilisateur->recupererParticipantsViaIdEvenement($idEvenement));
    }
    public function testRecupererToken()
    {
        $identifiant = "john.doe";
        $objetUtilisateur = new Utilisateur();
        $this->assertIsArray($objetUtilisateur->recupererToken($identifiant));
    }
    public function testVerifierToken()
    {
        $identifiant = "john.doe";
        $objetUtilisateur = new Utilisateur();
        $this->assertNotNull($objetUtilisateur->verifierToken($identifiant));
    }
    public function testVerifierAssociationToken()
    {
        $idUtilisateur = 1;
        $token = "8hYF14OF5GV8wjT";
        $objetUtilisateur = new Utilisateur();
        $this->assertNotNull($objetUtilisateur->verifierAssociationToken($idUtilisateur, $token));
    }
    public function testCreerToken()
    {
        $token = "8hYF14OF5GV8wjT";
        $identifiant = "john.doe";
        $objetUtilisateur = new Utilisateur();
        $this->assertTrue($objetUtilisateur->creerToken($token, $identifiant));
    }
}