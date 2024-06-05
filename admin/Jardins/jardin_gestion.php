<!DOCTYPE html>
<html>
<?php
    require('../../header.php')
?>
<body>
	
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
    
    


</body>
</html>