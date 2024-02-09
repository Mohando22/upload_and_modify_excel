<?php
$host = 'localhost'; // ou votre hôte de base de données
$dbname = 'mabase'; // remplacez par le nom de votre base de données
$username = 'root'; // remplacez par votre nom d'utilisateur de la base de données
$password = ''; // remplacez par votre mot de passe

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Définir le mode d'erreur PDO sur Exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Impossible de se connecter à la base de données: " . $e->getMessage());
}
?>
