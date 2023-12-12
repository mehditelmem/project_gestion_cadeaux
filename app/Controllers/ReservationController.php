<?php

require_once __DIR__ . '/../Models/Reservation.php'; // Inclure le modèle Reservation

class ReservationController {
    private $pdo;
    private $reservationModel;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->reservationModel = new Reservation($pdo);
    }

    // public function getAllReservations() {
    //     return $this->reservationModel->getAllReservations();
    // }

    public function getReservationById($reservationId) {
        return $this->reservationModel->getReservationById($reservationId);
    }

    public function addReservation($cadeauId, $personneReservant, $prixReel, $dateReservation) {
        // Construire la requête SQL pour insérer la réservation
        $query = "INSERT INTO reservations (cadeau_id, personne_reservant, prix_reel, date_reservation) VALUES (:cadeau_id, :personne_reservant, :prix_reel, :date_reservation)";
    
        // Préparer la requête SQL
        $stmt = $this->pdo->prepare($query);
    
        // Lier les valeurs aux paramètres
        $stmt->bindParam(':cadeau_id', $cadeauId);
        $stmt->bindParam(':personne_reservant', $personneReservant);
        $stmt->bindParam(':prix_reel', $prixReel);
        $stmt->bindParam(':date_reservation', $dateReservation);
    
        // Exécuter la requête
        $stmt->execute();
    
        // Retourner l'ID de la réservation insérée
        return $this->pdo->lastInsertId();
    }

    public function getAllReservations() {
        $stmt = $this->pdo->query("SELECT * FROM reservations");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ajoutez d'autres méthodes pour d'autres actions liées aux réservations
    // Par exemple :
    /*
    public function addReservation($cadeauId, $personneReservant, $prixReel, $dateDebutReservation, $dateFinReservation) {
        return $this->reservationModel->addReservation($cadeauId, $personneReservant, $prixReel, $dateDebutReservation, $dateFinReservation);
    }
    */
}
