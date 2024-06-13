<!DOCTYPE html>
<html>
<head><title></title></head>
<body>
<a href="user_gestion.php">retour
</a>
<hr> <h1>gestion des usagers </h1> <hr>

<?php
// récupérer dans l'url l'id de l'album à supprimer
$num = $_GET['num'];

require('../../connexion_sql.php'); 
$mabd->query('SET NAMES utf8;');

// tapez ici la requete de suppression de l'album dont l'id est passé dans l'url
$req = 'DELETE FROM user WHERE user_id=' . $num;

// cette ligne sert juste pour le debug. à supprimer quand tout marche correctement
echo $req;

$resultat = $mabd->query($req);

echo '<h2>Vous venez de supprimer le user numéro ' . $num . '</h2>';
?>

</body>
</html>
