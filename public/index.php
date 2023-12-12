<?php
header('Content-Type: application/json');

// Inclure les fichiers des contrôleurs et du modèle de connexion à la base de données
require_once '../config/database.php'; // Assurez-vous d'avoir configuré votre connexion à la base de données dans ce fichier
require_once '../app/Controllers/CadeauController.php';
require_once '../app/Controllers/ReservationController.php';

// Créer une instance de PDO pour la connexion à la base de données
$pdo = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Créer des instances des contrôleurs en leur passant l'objet PDO
$cadeauController = new CadeauController($pdo);
$reservationController = new ReservationController($pdo);

// Gérer les requêtes HTTP pour récupérer la liste des cadeaux ou des réservations
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Récupérer la liste des cadeaux
    if (isset($_GET['action']) && $_GET['action'] === 'get_cadeaux') {
        $cadeaux = $cadeauController->getAllCadeaux();
        echo json_encode($cadeaux);
        exit();
    }

    // Récupérer la liste des réservations
    if (isset($_GET['action']) && $_GET['action'] === 'get_reservations') {
        $reservations = $reservationController->getAllReservations();
        echo json_encode($reservations);
    }
}

// Gérer la requête HTTP pour récupérer les détails d'un cadeau par son identifiant
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Récupérer les détails d'un cadeau par son identifiant
    if (isset($_GET['action']) && $_GET['action'] === 'get_cadeau' && isset($_GET['id'])) {
        $cadeauId = $_GET['id'];

        // Récupérer les détails du cadeau depuis le contrôleur
        $cadeauDetails = $cadeauController->getCadeauDetails($cadeauId);

        // Vérifier si le cadeau existe
        if ($cadeauDetails) {
            // Renvoyer les détails du cadeau au format JSON
            header('Content-Type: application/json');
            echo json_encode($cadeauDetails);
            exit(); // Arrêter l'exécution du script après avoir renvoyé les données
        } else {
            // Cadeau non trouvé
            http_response_code(404); // Envoyer un code HTTP 404 - Not Found
            echo json_encode(array("message" => "Cadeau non trouvé."));
            exit();
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['action']) && $_GET['action'] === 'get_all_reservations') {
        $reservations = $reservationController->getAllReservations();
        echo json_encode($reservations);
        exit();
    }

    // ... autres conditions GET ...
}

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Assurez-vous que le contenu des variables POST est correctement extrait.
        $cadeauId = $_POST['cadeau_id'] ?? null;
        $personneReservant = $_POST['personne_reservant'] ?? null;
        $prixReel = $_POST['prix_reel'] ?? null;
        $dateReservation = $_POST['date_reservation'] ?? null;

        // Vous pourriez vouloir valider ces données ici.

        // Enregistrer la réservation
        $result = $reservationController->addReservation($cadeauId, $personneReservant, $prixReel, $dateReservation);

        // Renvoyer une réponse
        echo json_encode(['result' => $result]);
        exit();
    }

    // Votre logique existante pour les requêtes GET
    // ...

} catch (Exception $e) {
    http_response_code(500); // Code d'erreur serveur
    echo json_encode(['error' => $e->getMessage()]);
    exit();
}

// Vérifier si c'est une requête POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cadeauId = $_POST['cadeau_id'] ?? null;
    $personneReservant = $_POST['personne_reservant'] ?? null;
    $prixReel = $_POST['prix_reel'] ?? null;
    $dateReservation = $_POST['date_reservation'] ?? null;

    // Validation des données
    if ($cadeauId && $personneReservant && $prixReel && $dateReservation) {
        // Les données sont présentes, continuez avec l'insertion...

        $result = $reservationController->addReservation($cadeauId, $personneReservant, $prixReel, $dateReservation);

        if ($result) {
            echo json_encode(['success' => 'Réservation ajoutée avec succès', 'reservationId' => $result]);
        } else {
            // Gérez l'échec de l'insertion ici
            echo json_encode(['error' => 'Erreur lors de l\'ajout de la réservation']);
        }
    } else {
        // Données manquantes ou invalides, renvoyez une erreur
        echo json_encode(['error' => 'Données manquantes ou invalides']);
        exit;
    }
}
