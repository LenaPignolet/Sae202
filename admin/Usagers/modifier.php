<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un utilisateur</title>
</head>
<body>
<a href="user_gestion.php">Retour au tableau de bord</a>
<hr>

<p>Modification d'un utilisateur</p>

<?php
require('../../header.php');

try {
    // Connexion à la base de données
    $mabd = new PDO('mysql:host=localhost;dbname=sae202;charset=UTF8;', 'sae202User', '123');
    $mabd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $mabd->query('SET NAMES utf8;');

    // Vérification de l'existence du paramètre 'num' dans l'URL
    if (isset($_GET['num'])) {
        $num = intval($_GET['num']);

        // Requête pour récupérer les informations de l'utilisateur
        $req = "SELECT * FROM User WHERE user_id = :num";
        $stmt = $mabd->prepare($req);
        $stmt->bindParam(':num', $num, PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérification que l'utilisateur existe
        if ($user) {
?>
<hr>
<form method="POST" action="modifier_valid.php" enctype="multipart/form-data">
    <input type="hidden" name="num" value="<?php echo htmlspecialchars($user['user_id']); ?>"><br>
    Prénom: <input type="text" name="user_name" value="<?php echo htmlspecialchars($user['user_nom']); ?>"><br>
    Nom: <input type="text" name="user_prenom" value="<?php echo htmlspecialchars($user['user_prenom']); ?>"><br>
    Mail: <input type="text" name="user_mail" value="<?php echo htmlspecialchars($user['user_mail']); ?>"><br>
    Photo de profil: <input type="file" name="user_pp"><br>

    Jardin:
    <select name="jardin">
        <?php
        // Requête pour récupérer la liste des jardins
        $req = "SELECT * FROM Jardin";
        $resultat = $mabd->query($req);

        foreach ($resultat as $value) {
            $selection = ($value['jardin_id'] == $user['jardin_id']) ? "selected" : "";
            echo '<option ' . $selection . ' value="' . htmlspecialchars($value['jardin_id']) . '"> ' . htmlspecialchars($value['jardin_nom']) . '</option>';
        }
        ?>
    </select>
    <br>
    <input type="submit" name="submit" value="Modifier">
</form>

<?php
        } else {
            echo "Utilisateur non trouvé.";
        }
    } else {
        echo "Aucun utilisateur spécifié.";
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
</body>
</html>
    