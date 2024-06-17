<?php
session_start();
include '../connexion_sql.php';

// Vérification de la présence des données nécessaires dans la session
if (!isset($_SESSION['jardin_id']) || !isset($_SESSION['reservation_date']) || !isset($_SESSION['parcelles_reservees'])) {
    die("Erreur: Données de session manquantes.");
}

$jardin_id = $_SESSION['jardin_id'];
$reservation_date = $_SESSION['reservation_date'];
$parcelles_reservees = $_SESSION['parcelles_reservees'];

$sql_types_plantation = "SELECT plantation_id, nom_type_plantation FROM type_plantation";
$stmt_types_plantation = $mabd->query($sql_types_plantation);
$types_plantation = $stmt_types_plantation->fetchAll(PDO::FETCH_ASSOC);
$stmt_types_plantation->closeCursor();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sélection du type de plantation</title>
</head>
<body>
    <h1>Sélection du type de plantation pour les parcelles réservées</h1>
    
    <form action="save_plants.php" method="post">
        <?php foreach ($parcelles_reservees as $parcelle): ?>
            <input type="hidden" name="parcelles[]" value="<?php echo htmlspecialchars($parcelle['parcelle_id']); ?>">
            
            <label for="plantation_<?php echo $parcelle['parcelle_id']; ?>">Sélectionnez le type de plantation pour la parcelle <?php echo $parcelle['parcelle_id']; ?>:</label>
            <select id="plantation_<?php echo $parcelle['parcelle_id']; ?>" name="plantation_<?php echo $parcelle['parcelle_id']; ?>" required>
                <option value="">Sélectionnez un type de plantation</option>
                <?php foreach ($types_plantation as $type): ?>
                    <option value="<?php echo $type['plantation_id']; ?>"><?php echo htmlspecialchars($type['nom_type_plantation']); ?></option>
                <?php endforeach; ?>
            </select><br><br>
        <?php endforeach; ?>
        
        <input type="submit" value="Valider la sélection">
    </form>
</body>
</html>
