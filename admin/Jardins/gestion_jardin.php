<!DOCTYPE html>
<html lang="fr">
<head>
<title>Gestion Jardins</title>
<link rel="icon" type="image/png" href="../images/icon.jpg">
<meta charset="utf-8">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<link rel="stylesheet" type ="text/css" href="../css/styles.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Meuilleurs films science fiction">
<link rel="icon" type="image/png" href="images/icon.jpg">
</head>
<body>
<a id="retour" href="../gestion.php" class="btn btn-primary">Retour</a>
<h1>Gestion de nos jardins</h1>
<hr>
<a href="ajouter_jardin_form.php">Ajouter un jardin</a>
<style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
            vertical-align: top;
        }
        th {
            background-color: #f2f2f2;
        }
        img.photo_gestion {
            max-width: 200px;
            height: auto;
        }
    </style>
</head>
<body>

<table>
    <thead>
        <tr>
            <th>Photo</th>
            <th>Nom</th>
            <th>Adresse</th>
            <th>Surface</th>
            <th>N° de parcelle</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $mabd = new PDO('mysql:host=localhost;dbname=sae202Base;charset=UTF8;', 'Usersae202', '123');
        $mabd->query('SET NAMES utf8;');
        $req = "SELECT * FROM Jardin";
        $resultat = $mabd->query($req);
        foreach ($resultat as $value) {
            echo '<tr>';
            echo '<td><img class="photo_gestion" src="/images/uploads/'.$value['jardin_photo'].'"></td>';
            echo '<td>' . htmlspecialchars($value['jardin_nom']) . '</td>'; 
            echo '<td>' . htmlspecialchars($value['jardin_coord']) . '</td>';
            echo '<td>' . htmlspecialchars($value['jardin_surface']) . '</td>';
            echo '<td>' . htmlspecialchars($value['jardin_n_parcelle']) . '</td>';
            echo '<td><a href="modifier_jardin_form.php?num='. $value['jardin_id'] .'">Modifier</a></td>';
            echo '<td><a href="supprimer_jardin.php?num='. $value['jardin_id'] .'">Supprimer</a></td>';
            echo '</tr>';
        }
        ?>
    </tbody>
</table>

</body>
</html>
