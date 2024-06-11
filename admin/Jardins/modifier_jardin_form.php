<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification d'un jardin</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link rel="icon" type="image/png" href="../images/icon.jpg">
</head>
<body>

<?php require('menu.php'); ?>

<a href="gestion_jardin.php">Retour au tableau de bord</a>
<hr>
<h1>Gestion de nos jardins</h1>
<p>Modification d'un jardin</p>
<hr>
<?php
if(isset($_GET['num'])) {
    $allJardinId = $_GET['num'];

    try {
        $mabd = new PDO('mysql:host=localhost;dbname=sae202;charset=UTF8;', 'Usersae202', '123');
        $mabd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        $req = "SELECT * FROM Jardin WHERE jardin_id = :allJardinId";
        $stmt = $mabd->prepare($req);
        $stmt->execute(['allJardinId' => $allJardinId]);

        if($stmt->rowCount() > 0) {
            $allJardin = $stmt->fetch(PDO::FETCH_ASSOC);
            $req_parcelle = "SELECT * FROM Parcelle";
            $resultat_parcelle = $mabd->query($req_parcelle);

            echo '<form method="POST" action="modifier_jardin_valid.php" enctype="multipart/form-data">';
            // Champ caché pour stocker l'ancien nom de fichier photo
            echo '<input type="hidden" name="nouvelle_photo_old" value="' . htmlspecialchars($allJardin['jardin_photo']) . '">';
            // Champ hidden pour l'ID du jardin
            echo '<input type="hidden" name="num" value="' . htmlspecialchars($allJardin['jardin_id']) . '">';
            // Champ pour la nouvelle photo
            echo 'Nouvelle Photo : <input type="file" name="nouvelle_photo"><br>';
            echo 'Jardin : <input type="text" name="nom" value="' . htmlspecialchars($allJardin['jardin_nom']) . '"><br>';
            echo 'Adresse : <input type="text" name="adresse" value="' . htmlspecialchars($allJardin['jardin_coord']) . '"><br>';
            echo 'Surface : <input type="text" name="surface" value="' . htmlspecialchars($allJardin['jardin_surface']) . '"><br>';
            echo 'Surface : <input type="text" name="jardin_n_parcelle" value="' . htmlspecialchars($allJardin['jardin_n_parcelle']) . '"><br>';

            foreach ($resultat_parcelle as $value) {
                $selection = "";
                if($allJardin['parcelle_id'] == $value['parcelle_id']) {  // Correction ici
                    $selection = "selected";
                }
                echo '<option ' . $selection . ' value="' . htmlspecialchars($value['parcelle_id']) . '">' . htmlspecialchars($value['parcelle_nom']) . '</option>';
            }

            echo '</select><br>';
            echo '<input type="submit" value="Modifier">';
            echo '</form>';
        } else {
            echo '<p>Le jardin avec l\'ID ' . htmlspecialchars($allJardinId) . ' n\'existe pas.</p>';
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
} else {
    echo '<p>Aucun ID du jardin fourni.</p>';
}
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
<footer>
    <p>© PAGEC - Tous droits réservés</p>
    <a href="../mentions.php">Mentions légales</a>
</footer>
</html>
