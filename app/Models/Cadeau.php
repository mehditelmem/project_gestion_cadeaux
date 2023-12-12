<?php

class Cadeau {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAllCadeaux() {
        $query = "SELECT * FROM cadeaux";
        $stmt = $this->pdo->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCadeauById($cadeauId) {
        $query = "SELECT * FROM cadeaux WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['id' => $cadeauId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    // Méthode pour récupérer les détails d'un cadeau par son identifiant
    public function getCadeauDetails($cadeauId) {
        $query = "SELECT * FROM cadeaux WHERE id = :id";
        $statement = $this->pdo->prepare($query); // Remplacez $this->db par $this->pdo
        $statement->bindParam(':id', $cadeauId);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
    

    // Ajoutez d'autres méthodes pour insérer, mettre à jour et supprimer des cadeaux
    // par exemple :
    /*
    public function addCadeau($nom, $resume, $prix, $image, $auteur) {
        $query = "INSERT INTO cadeaux (nom, resume, prix, image, auteur) VALUES (:nom, :resume, :prix, :image, :auteur)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['nom' => $nom, 'resume' => $resume, 'prix' => $prix, 'image' => $image, 'auteur' => $auteur]);
        // Retourner l'ID du nouvel enregistrement inséré si nécessaire
        return $this->pdo->lastInsertId();
    }
    */
}
