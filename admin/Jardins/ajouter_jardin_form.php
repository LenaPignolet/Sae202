<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un jardin</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link rel="icon" type="image/png" href="../images/icon.jpg">
</head>
<body>

<?php require('menu.php'); ?>

    <a href="gestion_jardin.php">Retour au tableau de bord</a>
    <hr>
    <h1>Gestion de nos jardins</h1>
    <p>Ajouter un nouveau jardin</p>
    <hr>
    <form method="POST" action="ajouter_jardin_valid.php" enctype="multipart/form-data">
        Photo : <input type="file" name="photo"><br>
        Nom : <input type="text" name="nom"><br>
        Adresse : <input type="text" name="adresse"><br>
        Surface : <input type="text" name="surface"><br>
        Parcelle : 
        <select name="numparcelle">
            <?php
            try {
                $mabd = new PDO('mysql:host=localhost;dbname=sae202;charset=UTF8;', 'Usersae202', '123');
                $mabd->query('SET NAMES utf8;');
                $req = "SELECT * FROM Parcelle";
                $resultat = $mabd->query($req);

                foreach ($resultat as $value) {
                    echo '<option value="' . htmlspecialchars($value['parcelle_id']) . '">' . htmlspecialchars($value['parcelle_nom']) . '</option>';
                }
            } catch (PDOException $e) {
                echo "Erreur de connexion : " . $e->getMessage();
            }
            ?>
        </select>
        <br>
        <input type="submit" value="Ajouter">
    </form>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
<footer>
    <p>© PAGEC - Tous droits réservés</p>
    <a href="../mentions.php">Mentions légales</a>
</footer>
</html>
