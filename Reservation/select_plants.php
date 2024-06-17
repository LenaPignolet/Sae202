<?php
include '../connexion_sql.php';

// Vérifiez que les données GET sont définies
if (!isset($_GET['jardin_id']) || !isset($_GET['nombre_parcelles'])) {
    die("Erreur: Données manquantes.");
}

$jardin_id = $_GET['jardin_id'];
$nombre_parcelles = $_GET['nombre_parcelles'];

$sql = "SELECT plantation_id, nom_type_plantation FROM type_plantation";
$stmt = $mabd->prepare($sql);
$stmt->execute();
$types_plantations = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt->closeCursor();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Choisir les plantes</title>
</head>
<body>
    <h1>Choisir les plantes pour les parcelles réservées</h1>
    <form action="save_plants.php" method="post">
        <input type="hidden" name="jardin_id" value="<?php echo htmlspecialchars($jardin_id); ?>">
        <input type="hidden" name="nombre_parcelles" value="<?php echo htmlspecialchars($nombre_parcelles); ?>">

        <?php for ($i = 1; $i <= $nombre_parcelles; $i++): ?>
            <label for="plant_<?php echo $i; ?>">Type de plant pour la parcelle <?php echo $i; ?>:</label>
            <select id="plant_<?php echo $i; ?>" name="plants[]">
                <?php foreach ($types_plantations as $type): ?>
                    <option value="<?php echo $type['plantation_id']; ?>"><?php echo htmlspecialchars($type['nom_type_plantation']); ?></option>
                <?php endforeach; ?>
            </select><br><br>
        <?php endfor; ?>

        <input type="submit" value="Enregistrer les plantes">
    </form>
</body>
</html>