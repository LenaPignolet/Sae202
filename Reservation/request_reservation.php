<?php
session_start();
include '../connexion_sql.php';

// Vérification que les données POST sont définies
if (!isset($_POST['jardin_id']) || !isset($_POST['reservation_date']) || !isset($_POST['nombre_parcelles'])) {
    die("Erreur: Données manquantes.");
}

$jardin_id = $_POST['jardin_id'];
$reservation_date = $_POST['reservation_date'];
$nombre_parcelles = (int)$_POST['nombre_parcelles'];

// Vérification du nombre de parcelles à réserver
if ($nombre_parcelles <= 0) {
    die("Erreur: Nombre de parcelles invalide.");
}

// Vérification de la disponibilité des parcelles dans le jardin
$sql = "SELECT parcelle_id FROM Parcelle WHERE jardin_id = :jardin_id AND disponible = 1 LIMIT :nombre_parcelles";
$stmt = $mabd->prepare($sql);
$stmt->bindValue(':jardin_id', $jardin_id, PDO::PARAM_INT);
$stmt->bindValue(':nombre_parcelles', $nombre_parcelles, PDO::PARAM_INT);
$stmt->execute();
$parcelles_disponibles = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($parcelles_disponibles) < $nombre_parcelles) {
    die("Erreur: Il n'y a pas assez de parcelles disponibles.");
}

// Commencer une transaction pour assurer l'intégrité des données
$mabd->beginTransaction();

try {
    // Réserver les parcelles sélectionnées
    $reservation_successful = true;
    foreach ($parcelles_disponibles as $parcelle) {
        $parcelle_id = $parcelle['parcelle_id'];

        // Insertion de la réservation dans la table Parcelle
        $sql = "UPDATE Parcelle SET user_id = :user_id, reservation_date = :reservation_date, disponible = 0 WHERE parcelle_id = :parcelle_id";
        $stmt = $mabd->prepare($sql);
        $stmt->execute([
            'user_id' => $_SESSION['user_id'], // Supposant que user_id est stocké en session
            'reservation_date' => $reservation_date,
            'parcelle_id' => $parcelle_id
        ]);

        if (!$stmt->rowCount()) {
            $reservation_successful = false;
            break;
        }
    }

    if ($reservation_successful) {
        // Commit de la transaction si toutes les mises à jour sont réussies
        $mabd->commit();

        // Stocker les informations nécessaires dans la session pour la page suivante
        $_SESSION['jardin_id'] = $jardin_id;
        $_SESSION['reservation_date'] = $reservation_date;
        $_SESSION['parcelles_reservees'] = $parcelles_disponibles;

        header('Location: select_plants.php');
        exit;
    } else {
        // Rollback de la transaction en cas d'échec
        $mabd->rollBack();
        echo "Erreur lors de la réservation des parcelles.";
    }
} catch (PDOException $e) {
    // Rollback de la transaction en cas d'exception
    $mabd->rollBack();
    echo "Erreur PDO: " . $e->getMessage();
}
?>
