<?php
include 'db.php'; // Assurez-vous que ce chemin est correct

if (isset($_POST["submit"])) {
    $fileId = $_POST["file_id"]; // Assurez-vous de valider et nettoyer cet ID
    $fileName = $_FILES["modified_excel"]["name"];
    $fileTmpName = $_FILES["modified_excel"]["tmp_name"];
    $fileType = $_FILES["modified_excel"]["type"];
    $fileSize = $_FILES["modified_excel"]["size"];
    $fileContent = file_get_contents($fileTmpName); // Lit le contenu du fichier

    try {
        // Préparez la requête pour mettre à jour le fichier dans la base de données
        $sql = "UPDATE fichiers_excel SET nom_fichier=?, mime_type=?, taille_fichier=?, contenu=? WHERE id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$fileName, $fileType, $fileSize, $fileContent, $fileId]);

        echo "Le fichier a été mis à jour avec succès.";
    } catch (PDOException $e) {
        echo "Erreur lors de la mise à jour du fichier : " . $e->getMessage();
    }
}
?>
