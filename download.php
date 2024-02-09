<?php
include 'db.php'; // Inclure le fichier de connexion à la base de données

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Préparation de la requête pour récupérer le fichier spécifique par son ID
    $sql = "SELECT nom_fichier, mime_type, taille_fichier, contenu FROM fichiers_excel WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    
    $stmt->execute([$id]);
    $fichier = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if($fichier) {
        // Correction: Ajout du header pour la longueur du contenu
        $length = strlen($fichier['contenu']); // Supposant que 'contenu' est correctement lu comme une chaîne
        
        // En-têtes pour forcer le téléchargement
        header('Content-Description: File Transfer');
        header('Content-Type: ' . $fichier['mime_type']);
        header('Content-Disposition: attachment; filename="' . basename($fichier['nom_fichier']) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . $length);
        ob_clean();
        flush();
        // Écriture du contenu du fichier
        echo $fichier['contenu'];
        exit;
    } else {
        echo "Fichier non trouvé.";
    }
} else {
    echo "Aucun identifiant de fichier spécifié.";
}
?>
