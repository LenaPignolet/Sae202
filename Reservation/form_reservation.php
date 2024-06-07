<?php
include '../connexion_sql.php';

// Vérifiez que `jardin_id` est défini dans l'URL
if (!isset($_GET['jardin_id'])) {
    die("Erreur: 'jardin_id' non spécifié.");
}

$jardin_id = $_GET['jardin_id'];

// Préparez et exécutez la requête pour obtenir le nom du jardin
$sql = "SELECT jardin_nom FROM Jardin WHERE jardin_id = :jardin_id";
$stmt = $mabd->prepare($sql);
$stmt->execute(['jardin_id' => $jardin_id]);
$jardin = $stmt->fetch(PDO::FETCH_ASSOC);

// Vérifiez que le jardin existe
if (!$jardin) {
    die("Erreur: Jardin non trouvé.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Réserver une parcelle</title>
</head>
<body>
    <h1>Réserver une parcelle dans le <?php echo htmlspecialchars($jardin['jardin_nom']); ?></h1>
    <form action="request_reservation.php" method="post">
        <input type="hidden" name="jardin_id" value="<?php echo htmlspecialchars($jardin_id); ?>">
        <label for="user_id">ID Utilisateur:</label>
        <input type="text" id="user_id" name="user_id" required><br><br>
        
        <label for="parcelle_id">no:</label>
        <input type="text" id="parcelle_id" name="parcelle_id" required><br><br>
        
        <input type="submit" value="Demander Réservation">
    </form>
</body>
</html>

<?php
$stmt->closeCursor();
?>
