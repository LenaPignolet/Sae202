<?php
include '../connexion_sql.php';

// Vérifiez que les données POST sont définies
if (!isset($_POST['user_id']) || !isset($_POST['parcelle_id']) || !isset($_POST['jardin_id'])) {
    die("Erreur: Données manquantes.");
}

// Récupérer les données du formulaire
$user_id = $_POST['user_id'];
$parcelle_id = $_POST['parcelle_id'];
$jardin_id = $_POST['jardin_id'];

// Vérifier la disponibilité de la parcelle
$sql = "SELECT disponible FROM Parcelle WHERE parcelle_id = :parcelle_id AND jardin_id = :jardin_id";
$stmt = $mabd->prepare($sql);
$stmt->execute(['parcelle_id' => $parcelle_id, 'jardin_id' => $jardin_id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row) {
    if ($row['disponible'] == 1) {
        // Parcelle disponible, effectuer la réservation
        $sql = "UPDATE Parcelle SET user_id = :user_id, disponible = 0 WHERE parcelle_id = :parcelle_id";
        $stmt = $mabd->prepare($sql);
        
        if ($stmt->execute(['user_id' => $user_id, 'parcelle_id' => $parcelle_id])) {
            header('location: parcelle_reservation.php');

        } else {
            echo "Erreur lors de la réservation.";
        }
    } else {
        echo "Cette parcelle est déjà réservée.";
    }
} else {
    echo "Parcelle non trouvée.";
}

$stmt->closeCursor();
?>
