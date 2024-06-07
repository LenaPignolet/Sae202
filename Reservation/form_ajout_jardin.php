<!DOCTYPE html>
<html>
<head>
    <title>Ajouter un jardin</title>
</head>
<body>
<a href="table1_gestion.php">Retour au tableau de bord</a>    
<hr>
<h1>Gestion de nos jardins</h1>
<p>Ajouter ici un nouveau jardin</p>
<hr>
<form method="POST" action="new_ajout_jardin.php" enctype="multipart/form-data">
    Nom du jardin: <input type="text" name="jardin_nom" required><br>
    Coordonnées: <input type="text" name="jardin_coord" required><br>
    Image: <input type="file" name="jardin_photo" accept="image/png, image/jpeg" required><br>
    Surface: <input type="text" name="jardin_surface" required><br>
    Nombre de parcelles: <input type="number" name="nombre_parcelles" min="1" required><br>
    <input type="submit" value="Ajouter">
</form>
</body>
</html>
