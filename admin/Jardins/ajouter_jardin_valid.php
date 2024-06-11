<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validation</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
</head>
<body>
  
<?php require('menu.php'); ?>

<a href="jardin_gestion.php">Retour au tableau de bord</a>
<hr>

<h1 class="valide">Gestion de nos jardins</h1>
<h2 class="valide">Vous venez d'ajouter un jardin</h2>
<hr>

<?php
// Vérifiez si les données POST existent
if(isset($_POST['nom'], $_POST['adresse'], $_POST['surface'], $_POST['numparcelle'])) {
    // Récupération des données passées par le formulaire
    $nom = $_POST['nom'];
    $adresse = $_POST['adresse'];
    $surface = $_POST['surface'];
    $numparcelle = $_POST['numparcelle'];

    // Traitement du téléchargement de la photo
    $photo = '';
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === 0) {
        $photo = basename($_FILES["photo"]["name"]);
        $target_dir = "../images/uploads/";
        $target_file = $target_dir . $photo;

        if (!move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            echo "Une erreur s'est produite lors du téléchargement de la photo.";
            exit;
        }
    }

    try {
        // Connexion à la base de données
        $mabd = new PDO('mysql:host=localhost;dbname=sae202;charset=UTF8;', 'Usersae202', '123');
        $mabd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Préparation de la requête SQL
        $req = $mabd->prepare('INSERT INTO Jardin (jardin_photo, jardin_nom, jardin_coord, jardin_surface, parcelle_id) VALUES (:photo, :nom, :adresse, :surface, :numparcelle)');
        
        // Exécution de la requête
        $req->bindParam(':photo', $photo);
        $req->bindParam(':nom', $nom);
        $req->bindParam(':adresse', $adresse);
        $req->bindParam(':surface', $surface);
        $req->bindParam(':numparcelle', $numparcelle);

        $req->execute();

        echo 'Le jardin a été ajouté avec succès.';
    } catch(PDOException $e) {
        echo "Erreur lors de l\'ajout du jardin: " . $e->getMessage();
    }
} else {
    echo "Tous les champs du formulaire doivent être remplis.";
}
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
<footer>
    <p>© PAGEC - Tous droits réservés</p>
    <a href="../mentions.php">Mentions légales</a>
</footer>
</html>
