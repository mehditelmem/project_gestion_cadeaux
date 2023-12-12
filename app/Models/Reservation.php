<?php

class Reservation {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAllReservations() {
        $query = "SELECT * FROM reservations";
        $stmt = $this->pdo->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getReservationById($reservationId) {
        $query = "SELECT * FROM reservations WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['id' => $reservationId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Ajoutez d'autres méthodes pour insérer, mettre à jour et supprimer des réservations
    // par exemple :
    /*
    public function addReservation($cadeauId, $personneReservant, $prixReel, $dateDebutReservation, $dateFinReservation) {
        $query = "INSERT INTO reservations (cadeau_id, personne_reservant, prix_reel, date_debut_reservation, date_fin_reservation) VALUES (:cadeau_id, :personne_reservant, :prix_reel, :date_debut_reservation, :date_fin_reservation)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['cadeau_id' => $cadeauId, 'personne_reservant' => $personneReservant, 'prix_reel' => $prixReel, 'date_debut_reservation' => $dateDebutReservation, 'date_fin_reservation' => $dateFinReservation]);
        // Retourner l'ID du nouvel enregistrement inséré si nécessaire
        return $this->pdo->lastInsertId();
    }
    */
}
