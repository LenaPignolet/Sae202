<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des jardins</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
</head>
<body>
  
<?php require('menu.php'); ?>

<h1 id="gestion_h1">gestion des Jardins</h1>

    <div id="lien">
<a href="../index.php">retour au site</a>
</div>
<table border=1>
	<thead>
		<tr><td>nom</td><td>prénom</td><td>mail</td><td>supprimer</td><td>modifier</td></tr>
	</thead>
    <?php require('../../connexion_sql.php')?>
    <?php
      $sql = "SELECT * FROM Jardin";
    $query = $mabd->prepare($sql);
    $query->execute();
    $resultat = $query->fetchAll();
    foreach ($resultat as $value){
        echo '<tr>';
        $src = '../images/pp/' . $value['user_pp'];
        echo '<td>Nom:' .$value['user_nom'] .'</td>';
        echo '<td>prénom:' .$value['user_prenom'] .'</td>';
        echo '<td>mail:' .$value['user_mail'] .'</td>';
        echo '<td> <a href="supprimer.php?num=' . $value['user_id'] . '" > supprimer </a> </td>';
        echo '<td> <a href="modifier.php?num=' . $value['user_id'] . '" > modifier </a> </td>';
    }
        ?>
        </div>
      </div>
	<tbody>
    
    

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
<footer>
    <p>© PAGEC - Tous droits réservés</p>
    <a href="../mentions.php">Mentions légales</a>
</footer>
</html>