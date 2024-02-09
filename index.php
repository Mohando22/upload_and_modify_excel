<?php
include 'db.php'; // Inclure le fichier de connexion à la base de données

try {
    $sql = "SELECT id, nom_fichier, mime_type, taille_fichier, date_ajout FROM fichiers_excel WHERE mime_type LIKE '%excel%' OR mime_type = 'application/vnd.ms-excel' OR mime_type = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $fichiers = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des fichiers Excel</title>
</head>
<body>
    <h2>Liste des fichiers Excel stockés dans la base de données</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom du fichier</th>
                <th>Type MIME</th>
                <th>Taille (octets)</th>
                <th>Date d'ajout</th>
                <th>telecharge</th>
                <th> charger le fichier modifié </th>

            </tr>
        </thead>
        <tbody>
            <?php if (!empty($fichiers)): ?>
                <?php foreach ($fichiers as $fichier): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($fichier['id']); ?></td>
                        <td><?php echo htmlspecialchars($fichier['nom_fichier']); ?></td>
                        <td><?php echo htmlspecialchars($fichier['mime_type']); ?></td>
                        <td><?php echo htmlspecialchars($fichier['taille_fichier']); ?></td>
                        <td><?php echo htmlspecialchars($fichier['date_ajout']); ?></td>
                        <td>
                        <a href="download.php?id=<?php echo $fichier['id']; ?>">Télécharger</a>
                        </td>
                        <td>
                        <a href="interface_uploading.html?id=<?php echo $fichier['id']; ?>">Modifier</a> <!-- Lien ajouté ici -->
                        </td>                        

                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">Aucun fichier trouvé</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
