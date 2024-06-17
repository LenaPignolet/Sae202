<?php
include '../connexion_sql.php';

// Vérifiez que les données POST sont définies
if (!isset($_POST['jardin_id']) || !isset($_POST['nombre_parcelles']) || !isset($_POST['plants'])) {
    die("Erreur: Données manquantes.");
}

// Récupérer les données du formulaire
$jardin_id = $_POST['jardin_id'];
$nombre_parcelles = $_POST['nombre_parcelles'];
$plants = $_POST['plants'];

// Afficher les `plantation_id` pour le débogage
echo "<pre>";
print_r($plants);
echo "</pre>";

// Vérifier le nombre de parcelles réservées (déjà marquées comme indisponibles)
$sql = "SELECT parcelle_id FROM Parcelle WHERE jardin_id = :jardin_id AND disponible = 0 LIMIT :nombre_parcelles";
$stmt = $mabd->prepare($sql);
$stmt->bindParam(":jardin_id", $jardin_id, PDO::PARAM_INT);
$stmt->bindParam(":nombre_parcelles", $nombre_parcelles, PDO::PARAM_INT);
$stmt->execute();
$parcelleIDs = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Si moins de parcelles sont réservées que demandées, afficher une erreur
if (count($parcelleIDs) < $nombre_parcelles) {
    die("Erreur: Nombre de parcelles réservées insuffisant.");
}

// Vérifier si les plantation_id existent dans la table type_plantation
$placeholders = implode(',', array_fill(0, count($plants), '?'));
$sql = "SELECT plantation_id FROM type_plantation WHERE plantation_id IN ($placeholders)";
$stmt = $mabd->prepare($sql);
$stmt->execute($plants);
$existingPlants = $stmt->fetchAll(PDO::FETCH_COLUMN);

// Afficher les `plantation_id` existants pour le débogage
echo "<pre>";
print_r($existingPlants);
echo "</pre>";

// Si certains plantation_id n'existent pas, afficher une erreur
if (count($existingPlants) < count($plants)) {
    die("Erreur: Certains plantation_id ne sont pas valides.");
}

// Enregistrement des types de plantes pour chaque parcelle réservée
try {
    $mabd->beginTransaction();
    
    for ($i = 0; $i < $nombre_parcelles; $i++) {
        $plantation_id = $plants[$i];
        $parcelle_id = $parcelleIDs[$i]['parcelle_id'];

        $sql = "UPDATE Parcelle SET plantation_id = :plantation_id WHERE parcelle_id = :parcelle_id";
        $stmt = $mabd->prepare($sql);
        $stmt->bindParam(":plantation_id", $plantation_id, PDO::PARAM_INT);
        $stmt->bindParam(":parcelle_id", $parcelle_id, PDO::PARAM_INT);
        $stmt->execute();
    }

    $mabd->commit();
    echo "Les plantes ont été enregistrées avec succès pour les parcelles réservées.";
} catch (Exception $e) {
    $mabd->rollBack();
    die("Erreur: " . $e->getMessage());
}

$stmt->closeCursor();
?>
