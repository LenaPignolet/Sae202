<?php
session_start();
include '../connexion_sql.php';

// Vérification de la présence des données nécessaires dans la session
if (!isset($_SESSION['id'])) {
    die("Erreur: Utilisateur non connecté.");
}

// Vérification que les données POST sont définies
if (!isset($_POST['parcelles']) || empty($_POST['parcelles'])) {
    die("Erreur: Données manquantes.");
}

$user_id = $_SESSION['user_id'];
$parcelles = $_POST['parcelles'];

$mabd->beginTransaction();

try {
    foreach ($parcelles as $parcelle_id) {
        if (!isset($_POST['plantation_' . $parcelle_id])) {
            throw new Exception("Erreur: Type de plantation manquant pour la parcelle $parcelle_id.");
        }

        $plantation_id = $_POST['plantation_' . $parcelle_id];

        // Enregistrement du type de plantation pour la parcelle
        $sql = "UPDATE Parcelle SET plantation_id = :plantation_id WHERE parcelle_id = :parcelle_id";
        $stmt = $mabd->prepare($sql);
        $stmt->execute([
            'plantation_id' => $plantation_id,
            'parcelle_id' => $parcelle_id
        ]);

        if (!$stmt->rowCount()) {
            throw new Exception("Erreur: Échec de la mise à jour de la parcelle $parcelle_id.");
        }
    }

    $mabd->commit();
    header('Location: /profil/profil.php');
    exit;
} catch (Exception $e) {
    $mabd->rollBack();
    die("Erreur: " . $e->getMessage());
}
?>
