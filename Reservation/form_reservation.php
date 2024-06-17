<?php
include '../connexion_sql.php';

session_start();

// Vérification de l'ID du jardin dans l'URL
if (!isset($_GET['num'])) {
    die("Erreur: 'jardin_id' non spécifié.");
}

$jardin_id = $_GET['num'];

// Récupération des informations sur le jardin
$sql = "SELECT jardin_nom FROM Jardin WHERE jardin_id = :jardin_id";
$stmt = $mabd->prepare($sql);
$stmt->execute(['jardin_id' => $jardin_id]);
$jardin = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$jardin) {
    die("Erreur: Jardin non trouvé.");
}

// Récupération du nombre de parcelles disponibles dans le jardin
$sql = "SELECT COUNT(*) AS parcelles_disponibles FROM Parcelle WHERE jardin_id = :jardin_id AND disponible = 1";
$stmt = $mabd->prepare($sql);
$stmt->execute(['jardin_id' => $jardin_id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$parcelles_disponibles = $row['parcelles_disponibles'] ?? 0;

$stmt->closeCursor();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Réserver des parcelles</title>
</head>
<body>
    <h1>Réserver des parcelles dans le <?php echo htmlspecialchars($jardin['jardin_nom']); ?></h1>
    <p>Il reste <?php echo $parcelles_disponibles; ?> parcelles disponibles dans ce jardin.</p>
    
    <form action="request_reservation.php" method="post">
        <input type="hidden" name="jardin_id" value="<?php echo htmlspecialchars($jardin_id); ?>">
        
        <label for="reservation_date">Date de Réservation:</label>
        <input type="date" id="reservation_date" name="reservation_date" required><br><br>
        
        <label for="nombre_parcelles">Nombre de Parcelles à Réserver:</label>
        <input type="number" id="nombre_parcelles" name="nombre_parcelles" min="1" max="<?php echo $parcelles_disponibles; ?>" required><br><br>
        
        <?php if ($parcelles_disponibles > 0): ?>
            <button type="submit">Continuer</button>
        <?php else: ?>
            <p>Aucune parcelle disponible pour réservation.</p>
        <?php endif; ?>
    </form>
</body>
</html>
