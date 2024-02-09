<?php
// Connexion à la base de données
// Utilisez vos propres paramètres de connexion
$pdo = new PDO('mysql:host=localhost;dbname=nom_de_votre_base_de_donnees', 'username', 'password');

// Récupérer tous les fichiers
$stmt = $pdo->query('SELECT id, nom_fichier, date_ajout FROM fichiers_excel');
$fichiers = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Liste des fichiers Excel</title>
</head>
<body>
    <h1>Liste des fichiers Excel</h1>
    <a href="upload.php">Ajouter un fichier</a>
    <table>
        <thead>
            <tr>
                <th>Nom du fichier</th>
                <th>Date d'ajout</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($fichiers as $fichier): ?>
            <tr>
                <td><?= htmlspecialchars($fichier['nom_fichier']) ?></td>
                <td><?= $fichier['date_ajout'] ?></td>
                <td>
                    <a href="download.php?id=<?= $fichier['id'] ?>">Télécharger</a>
                    <form action="update.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $fichier['id'] ?>">
                        <input type="file" name="fichier">
                        <button type="submit">Mettre à jour</button>
                    </form>
                    <form action="delete.php" method="post">
                        <input type="hidden" name="id" value="<?= $fichier['id'] ?>">
                        <button type="submit">Supprimer</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>

