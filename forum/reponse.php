<?php
require('../connexion_sql.php');
session_start();

if (!isset($_SESSION['id'])) {
    header('Location: login.php'); // Redirige vers la page de connexion si l'utilisateur n'est pas connecté
    exit();
}

$question_id = $_GET['id']; // Assurez-vous que l'ID de la question est passé en paramètre d'URL

// Récupération des informations de la question
try {
    $getQuestion = $mabd->prepare('SELECT * FROM questions WHERE id = ?');
    $getQuestion->execute(array($question_id));
    $question = $getQuestion->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Erreur lors de la récupération de la question : ' . $e->getMessage();
    exit();
}

// Récupération des réponses de la question
try {
    $getReponses = $mabd->prepare('SELECT r.*, u.user_nom, u.user_prenom FROM reponses r JOIN User u ON r.user_id = u.user_id WHERE question_id = ? ORDER BY date_publication DESC');
    $getReponses->execute(array($question_id));
} catch (PDOException $e) {
    echo 'Erreur lors de la récupération des réponses : ' . $e->getMessage();
    exit();
}

// Traitement du formulaire de réponse
if (isset($_POST['submit_reponse'])) {
    if (!empty($_POST['contenu'])) {
        $reponse_contenu = nl2br(htmlspecialchars($_POST['contenu']));
        $reponse_date = date('Y-m-d H:i:s');
        $user_id = $_SESSION['id'];

        try {
            $insertReponse = $mabd->prepare('INSERT INTO reponses (question_id, user_id, contenu, date_publication) VALUES (?, ?, ?, ?)');
            $insertReponse->execute(array($question_id, $user_id, $reponse_contenu, $reponse_date));
            header('Location: reponse.php?id=' . $question_id); // Redirige vers la même page pour voir la nouvelle réponse
            exit();
        } catch (PDOException $e) {
            echo 'Erreur lors de la publication de la réponse : ' . $e->getMessage();
        }
    } else {
        echo 'Veuillez compléter le champ de réponse...';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Répondre à la question</title>
</head>
<body>
    <h1><?php echo htmlspecialchars($question['titre']); ?></h1>
    <p><?php echo nl2br(htmlspecialchars($question['description'])); ?></p>
    <p><?php echo nl2br(htmlspecialchars($question['contenu'])); ?></p>
    <p class="date">Publié le <?php echo htmlspecialchars($question['date_publication']); ?></p>

    <h2>Réponses</h2>
    <?php
    while ($reponse = $getReponses->fetch(PDO::FETCH_ASSOC)) {
        echo '<div class="reponse">';
        echo '<p><strong>' . htmlspecialchars($reponse['user_nom']) . ' ' . htmlspecialchars($reponse['user_prenom']) . ':</strong> ' . nl2br(htmlspecialchars($reponse['contenu'])) . '</p>';
        echo '<p class="date">Publié le ' . htmlspecialchars($reponse['date_publication']) . '</p>';
        echo '</div>';
    }
    ?>

    <h2>Poster une réponse</h2>
    <form action="reponse.php?id=<?php echo $question_id; ?>" method="POST">
        <textarea name="contenu"></textarea>
        <button type="submit" name="submit_reponse">Voir les réponses</button>
    </form>
</body>
</html>
