<?php
require('header.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue</title>
    <link rel="stylesheet" href="/css/form_recherche.css">
    <meta name="description" content="Page de recherche">
</head>
<body>
<div class="container">
    <h1>Recherchez votre voiture de rêve !</h1>
    <form action="reponse_recherche.php" method="get">
        <p>
            <label for="modele">Modèle de la voiture :</label>
            <input type="text" name="marque" id="marque" />
        </p>
       
        <button type="button" onclick="window.location.href='index.php'">Retour</button>
    </form>
</div>

<?php
require('footer.php');
?>
</body>
</html>