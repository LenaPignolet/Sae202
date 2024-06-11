<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validation de la modification d'un jardin</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link rel="icon" type="image/png" href="../images/icon.jpg">
</head>
<body>

<?php require('menu.php'); ?>

<p>Vous venez de modifier un jardin</p>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $allJardin = $_POST['num'];
    $nom = $_POST['nom'];
    $coord = $_POST['adresse'];
    $surface = $_POST['surface'];
    $parcelle = $_POST['jardin_n_parcelle'];

    // Vérifier si un nouveau fichier a été téléchargé
    if(isset($_FILES['nouvelle_photo']) && $_FILES['nouvelle_photo']['error'] === 0) {
        $nouvelle_photo = $_FILES['nouvelle_photo']['name'];
        $target_dir = "../images/uploads/"; // dossier où sauvegarder les photos
        $target_file = $target_dir . basename($nouvelle_photo);

        // Déplacer le fichier téléchargé vers le dossier 'uploads'
        if (move_uploaded_file($_FILES['nouvelle_photo']['tmp_name'], $target_file)) {
            // Le fichier a été téléchargé avec succès, maintenant mettre à jour la base de données
            try {
                $mabd = new PDO('mysql:host=localhost;dbname=sae202;charset=UTF8;', 'Usersae202', '123');
                $mabd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $req = "UPDATE Jardin SET jardin_photo = :nouvelle_photo, jardin_nom = :nom, jardin_coord = :adresse, jardin_surface = :surface, parcelle_id = :parcelle WHERE jardin_id = :allJardin"; // Correction ici
                $stmt = $mabd->prepare($req);
                $stmt->execute([
                    'nouvelle_photo' => $nouvelle_photo,
                    'nom' => $nom,
                    'adresse' => $coord,
                    'surface' => $surface,
                    'parcelle' => $parcelle,
                    'allJardin' => $allJardin
                ]);

                echo "<p>Modification du jardin réussie !</p>";
                echo '<a href="modifier_jardin_form.php">Retour au tableau de bord</a>';
            } catch (PDOException $e) {
                echo "Erreur : " . $e->getMessage();
            }
        } else {
            echo "Une erreur s'est produite lors du téléchargement du fichier.";
        }
    } else {
        // Utiliser l'ancienne photo si aucun nouveau fichier n'a été téléchargé
        $nouvelle_photo = $_POST['nouvelle_photo_old']; // Assurez-vous d'ajouter un champ caché pour stocker l'ancien nom de fichier
        try {
            $mabd = new PDO('mysql:host=localhost;dbname=sae202;charset=UTF8;', 'Usersae202', '123');
            $mabd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $req = "UPDATE Jardin SET jardin_photo = :nouvelle_photo, jardin_nom = :nom, jardin_coord = :adresse, jardin_surface = :surface, parcelle_id = :parcelle WHERE jardin_id = :allJardin"; // Correction ici
            $stmt = $mabd->prepare($req);
            $stmt->execute([
                'nouvelle_photo' => $nouvelle_photo,
                'nom' => $nom,
                'adresse' => $coord,
                'surface' => $surface,
                'parcelle' => $parcelle,
                'allJardin' => $allJardin
            ]);

            echo "<p>Modification du jardin réussie !</p>";
            echo '<a href="modifier_jardin_form.php">Retour au tableau de bord</a>';
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }
} else {
    echo "<p>Méthode non autorisée.</p>";
}
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
<footer>
    <p>© PAGEC - Tous droits réservés</p>
    <a href="../mentions.php">Mentions légales</a>
</footer>
</html>
