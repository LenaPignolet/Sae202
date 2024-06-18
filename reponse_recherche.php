<?php
require('header.php');
require('connexion_sql.php');

$resultat = [];

if(isset($_GET['parcelle']) && !empty($_GET['parcelle'])) {
    $nom = htmlspecialchars($_GET['parcelle']);

    $sql = "SELECT 
                j.jardin_id, 
                j.jardin_nom, 
                j.jardin_coord, 
                j.jardin_surface, 
                j.jardin_photo,
                (SELECT COUNT(*) FROM Parcelle WHERE jardin_id = j.jardin_id AND disponible = 1) AS parcelles_disponibles
            FROM 
                Jardin j
            WHERE 
                j.jardin_nom LIKE ?";
                
    $query = $mabd->prepare($sql);
    $query->execute(["%$nom%"]);
    $resultat = $query->fetchAll();
} else {
    // Si aucun nom de jardin spécifié, afficher tous les jardins
    $sql = "SELECT 
                j.jardin_id, 
                j.jardin_nom, 
                j.jardin_coord, 
                j.jardin_surface, 
                j.jardin_photo,
                (SELECT COUNT(*) FROM Parcelle WHERE jardin_id = j.jardin_id AND disponible = 1) AS parcelles_disponibles
            FROM 
                Jardin j";
    $query = $mabd->query($sql);
    $resultat = $query->fetchAll();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jardin</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<div class="main_catalogue">
    <?php
    foreach ($resultat as $value) {
        echo '<article>';
        echo '<div class="liste">';
        echo '<img alt="jardin" class="img_jardin" src="images/uploads/'.$value['jardin_photo'].'">';
        echo '<p>Jardin : '.$value['jardin_nom'] . '</p>';
        echo '<p>Adresse : ' . $value['jardin_coord'] . '</p>';
        echo '<p>Surface : ' . $value['jardin_surface'] . '</p>';
        echo '<p>N° de jardin : '.$value['jardin_id'] . '</p>';
        echo '<p>Parcelles disponibles : ' . $value['parcelles_disponibles'] . '</p>';
        echo '<td> <a href="Reservation/form_reservation.php?num=' . $value['jardin_id'] . '" > Réserver </a> </td>';
        echo '<hr>';
        echo '</div>';
        echo '</article>';
    }
    ?>
</div>
</body>
</html>
