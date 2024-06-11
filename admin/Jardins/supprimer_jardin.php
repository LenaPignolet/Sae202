<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer un jardin</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link rel="icon" type="image/png" href="../images/icon.jpg">
</head>
<body>

<?php require('menu.php'); ?>

<a href="gestion_jardin.php">retour au tableau de bord</a> 	
<hr> <h1>Suppression</h1> <hr>

<?php
// recupérer dans l'url l'id de l'album à supprimer
$allJardinId = $_GET['num'];

$mabd = new PDO('mysql:host=localhost;dbname=sae202;charset=UTF8;', 'Usersae202', '123');
$mabd->query('SET NAMES utf8;');

// tapez ici la requete de suppression de l'album dont l'id est passé dans l'url
$req = 'DELETE FROM Jardin WHERE jardin_id = ' . $allJardinId;
 
$resultat = $mabd->query($req);

echo '<h2>Vous venez de supprimer le jardin numéro ' . $allJardinId . '</h2>';
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
<footer>
    <p>© PAGEC - Tous droits réservés</p>
    <a href="../mentions.php">Mentions légales</a>
</footer>
</html>