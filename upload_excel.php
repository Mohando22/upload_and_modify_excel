<?php
if (isset($_POST['submit']) && isset($_FILES['excelFile'])) {
    $nomFichier = $_FILES['excelFile']['name'];
    $mimeFichier = $_FILES['excelFile']['type'];
    $tailleFichier = $_FILES['excelFile']['size'];
    $tempFichier = $_FILES['excelFile']['tmp_name'];

    // Lire le contenu du fichier
    $contenuFichier = file_get_contents($tempFichier);

    // Informations de connexion à la base de données
    $dsn = 'mysql:host=localhost;dbname=mabase';
    $utilisateur = 'root';
    $motDePasse = '';

    try {
        $pdo = new PDO($dsn, $utilisateur, $motDePasse);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO fichiers_excel (nom_fichier, mime_type, taille_fichier, contenu) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $nomFichier);
        $stmt->bindParam(2, $mimeFichier);
        $stmt->bindParam(3, $tailleFichier);
        $stmt->bindParam(4, $contenuFichier, PDO::PARAM_LOB);

        $stmt->execute();

        echo "Le fichier Excel a été téléchargé et stocké avec succès.";
    } catch (PDOException $e) {
        die("Erreur lors de l'insertion du fichier : " . $e->getMessage());
    }
} else {
    echo "Veuillez sélectionner un fichier à télécharger.";
}
?>
