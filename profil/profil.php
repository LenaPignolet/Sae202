<?php
require('../menu.php');
require('../connexion_sql.php');

// Vérifiez si l'utilisateur est connecté
require('../connexion_sql.php');

try {
    $stmt = $mabd->prepare("SELECT * FROM User WHERE user_id = :user_id");
    $stmt->bindParam(':user_id', $_SESSION['id']);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);


    if (!$user) {
        echo "Utilisateur non trouvé.";
        exit;
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sae 202</title>
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Archivo+Black&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Jomhuria&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <script src="js/index.js" defer></script>
</head>
<body>

<div class="profile-container">
    <div id="profil">
        <div id="profil_layout">
            <div id="pp_layout">
                <div id="pp_form">
                    <img src="../images/pp/088A0881.JPG">
                </div>
                <a href="">Changer la photo de profil</a>
                <h3>Membre depuis le : 13/06/2024</h3>
            </div>
            <div id="infos_layout">
                <div class="infos">
                    <h3>Nom complet</h3>
                    <p class="info_name"><?php echo htmlspecialchars($user['user_nom']); ?></p>
                    <p class="info_name"><?php echo htmlspecialchars($user['user_prenom']); ?></p>
                </div>
                <div class="infos">
                    <h3>Email</h3>
                    <p class="info_mail"><?php echo htmlspecialchars($user['user_mail']); ?></p>
                </div>
                <a href="">Modifier le profil</a>

            </div>
            <h3>Partager un jardin</h3>
                <p>Vous n'avez pas encore partagé de jardin.</p>
                <a href="">Partager un jardin</a>
        </div>
        <div id="reserv">
            <h3>Vos réservations</h3>
        </div>
    </div>
    
</div>

</body>
</html>

<?php
require('../footer.php');
?>
