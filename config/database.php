<?php

// Paramètres de connexion à la base de données
$host = 'localhost'; // Remplacez par l'hôte de votre base de données
$db_name = 'gestion_cadeau'; // Remplacez par le nom de votre base de données
$username = 'mehdi'; // Remplacez par votre nom d'utilisateur MySQL
$password = ''; // Remplacez par votre mot de passe MySQL

try {
    // Création de la connexion à la base de données avec PDO
    $pdo = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);

    // Configurer PDO pour qu'il rapporte les erreurs SQL
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Utilisez $pdo pour exécuter des requêtes SQL
    // Par exemple :
    // $pdo->query("SELECT * FROM votre_table");

} catch (PDOException $e) {
    // En cas d'erreur de connexion, afficher l'erreur
    echo "Erreur de connexion : " . $e->getMessage();
}
