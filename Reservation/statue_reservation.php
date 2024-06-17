<?php
require('connexion_sql.php');

if (!isset($_GET['reservation_id'])) {
    die("Erreur: 'reservation_id' non spécifié.");
}

$reservation_id = $_GET['reservation_id'];

$sql = "SELECT statut FROM Reservation WHERE reservation_id = :reservation_id";
$stmt = $mabd->prepare($sql);
$stmt->execute(['reservation_id' => $reservation_id]);
$reservation = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$reservation) {
    die("Erreur: Réservation non trouvée.");
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Statut de la réservation</title>
</head>
<body>
    <h1>Statut de votre réservation</h1>
    <p>Votre demande de réservation est : <?php echo htmlspecialchars($reservation['statut']); ?></p>
</body>
</html>
