<?php

require_once __DIR__ . '/../Models/Cadeau.php'; // Inclure le modèle Cadeau

class CadeauController {
    private $pdo;
    private $cadeauModel;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->cadeauModel = new Cadeau($pdo);
    }

    public function getAllCadeaux() {
        return $this->cadeauModel->getAllCadeaux();
    }

    public function getCadeauById($cadeauId) {
        return $this->cadeauModel->getCadeauById($cadeauId);
    }
    
    public function getCadeauDetails($cadeauId) {
        // Appeler la méthode du modèle pour obtenir les détails du cadeau
        return $this->cadeauModel->getCadeauDetails($cadeauId);
    }

    // Ajoutez d'autres méthodes pour d'autres actions liées aux cadeaux
    // Par exemple :
    /*
    public function addCadeau($nom, $resume, $prix, $image, $auteur) {
        return $this->cadeauModel->addCadeau($nom, $resume, $prix, $image, $auteur);
    }
    */
}
