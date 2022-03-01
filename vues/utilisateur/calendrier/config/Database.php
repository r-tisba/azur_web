<?php
class Database
{
    // -------------------------------- LOCAL --------------------------------
    private $host = "localhost";
    private $db_name = "gestion";
    private $username = "root";
    private $password = "";
    public $connexion;

    // -------------------------------- WEB --------------------------------
    // private $host = "ipssisqazur.mysql.db";
    // private $db_name = "ipssisqazur";
    // private $username = "ipssisqazur";
    // private $password = "Ipssi2022azur";
    // public $connexion;

    // getter pour la connexion
    public function getConnection(){
        // On commence par fermer la connexion si elle existait
        $this->connexion = null;

        // On essaie de se connecter
        try{
            $this->connexion = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->connexion->exec("set names utf8"); // On force les transactions en UTF-8
        }catch(PDOException $exception){ // On gère les erreurs éventuelles
            echo "Erreur de connexion : " . $exception->getMessage();
        }

        // On retourne la connexion
        return $this->connexion;
    }
}