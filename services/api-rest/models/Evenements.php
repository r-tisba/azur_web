<?php
class Evenements
{
    // Connexion
    private $connexion;
    private $table = "evenements"; // Table dans la base de données

    // Propriétés
    public $id;
    public $start;
    public $end;
    public $title;
    public $description;
    public $backgroundColor;
    public $borderColor;
    public $textColor;
    public $url;
    public $nom_url;

    /**
     * Constructeur avec $db pour la connexion à la base de données
     *
     * @param $db
     */
    public function __construct($db)
    {
        $this->connexion = $db;
    }

    /**
     * Créer un événement
     *
     * @return void
     */
    public function creer()
    {
        // Ecriture de la requête SQL en y insérant le nom de la table
        $sql = "INSERT INTO " . $this->table . " SET title=:title, description=:description, start=:start, end=:end, idCreateur=:idCreateur";

        // Préparation de la requête
        $query = $this->connexion->prepare($sql);

        // Protection contre les injections
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->start = htmlspecialchars(strip_tags($this->start));
        $this->end = htmlspecialchars(strip_tags($this->end));
        $this->idCreateur = htmlspecialchars(strip_tags($this->idCreateur));

        // Ajout des données protégées
        $query->bindParam(":title", $this->title);
        $query->bindParam(":description", $this->description);
        $query->bindParam(":start", $this->start);
        $query->bindParam(":end", $this->end);
        $query->bindParam(":idCreateur", $this->idCreateur);


        // Exécution de la requête
        if ($query->execute()) {
            return true;
        }
        return false;
    }

    public function lire()
    {
        // On écrit la requête
        $sql = "SELECT e.id, e.title, e.description, e.start, e.end, e.url, e.nom_url, e.backgroundColor, e.borderColor, e.textColor, u.idEmploye, u.identifiant FROM " . $this->table . " e LEFT JOIN utilisateurs u ON e.idCreateur = u.idEmploye ORDER BY e.start ASC";
        // On prépare la requête
        $query = $this->connexion->prepare($sql);

        // On exécute la requête
        $query->execute();

        // On retourne le résultat
        return $query;
    }
    /**
     * Lire un événement
     *
     * @return void
     */
    public function lireUn()
    {
        // On écrit la requête
        $sql = "SELECT e.id, e.title, e.description, e.start, e.end, e.url, e.nom_url, e.backgroundColor, e.borderColor, e.textColor, u.idEmploye, u.identifiant FROM " . $this->table . " e LEFT JOIN utilisateurs u ON e.idCreateur = u.idEmploye WHERE u.id = ? LIMIT 0,1";

        // On prépare la requête
        $query = $this->connexion->prepare($sql);

        // On attache l'id
        $query->bindParam(1, $this->id);

        // On exécute la requête
        $query->execute();

        // On récupère la ligne
        $row = $query->fetch(PDO::FETCH_ASSOC);

        // On hydrate l'objet
        $this->id = $row['id'];
        $this->title = $row['title'];
        $this->description = $row['description'];
        $this->start = $row['start'];
        $this->end = $row['end'];
        $this->url = $row['url'];
        $this->nom_url = $row['nom_url'];
        $this->backgroundColor = $row['backgroundColor'];
        $this->borderColor = $row['borderColor'];
        $this->textColor = $row['textColor'];
        $this->idEmploye = $row['idEmploye'];
        $this->identifiant = $row['identifiant'];
    }
    /**
     * Mettre à jour un événement
     *
     * @return void
     */
    public function modifier()
    {
        // On écrit la requête
        $sql = "UPDATE " . $this->table . " SET title=:title, description=:description, start=:start, end=:end WHERE id=:id";
        // , backgroundColor=:backgroundColor, borderColor=:borderColor, textColor=:textColor

        // On prépare la requête
        $query = $this->connexion->prepare($sql);

        // On sécurise les données
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->start = htmlspecialchars(strip_tags($this->start));
        $this->end = htmlspecialchars(strip_tags($this->end));
        // $this->backgroundColor=htmlspecialchars(strip_tags($this->backgroundColor));
        // $this->borderColor=htmlspecialchars(strip_tags($this->borderColor));
        // $this->textColor=htmlspecialchars(strip_tags($this->textColor));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // On attache les variables
        $query->bindParam(":title", $this->title);
        $query->bindParam(":description", $this->description);
        $query->bindParam(":start", $this->start);
        $query->bindParam(":end", $this->end);
        // $query->bindParam(":backgroundColor", $this->backgroundColor);
        // $query->bindParam(":borderColor", $this->borderColor);
        // $query->bindParam(":textColor", $this->textColor);
        $query->bindParam(":id", $this->id);

        // On exécute
        if ($query->execute()) {
            return true;
        }
        return false;
    }
    /**
     * Supprimer un produit
     *
     * @return void
     */
    public function supprimer()
    {
        // On écrit la requête
        $sql = "DELETE FROM " . $this->table . " WHERE id = ?";

        // On prépare la requête
        $query = $this->connexion->prepare($sql);

        // On sécurise les données
        $this->id = htmlspecialchars(strip_tags($this->id));

        // On attache l'id
        $query->bindParam(1, $this->id);

        // On exécute la requête
        if ($query->execute()) {
            return true;
        }
        return false;
    }
}
