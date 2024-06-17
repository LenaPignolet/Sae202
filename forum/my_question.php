<?php
require('../connexion_sql.php');
session_start();

try {
    $getQuestions = $mabd->query('SELECT * FROM questions ORDER BY date_publication DESC');
} catch (PDOException $e) {
    echo 'Erreur lors de la récupération des questions : ' . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Liste des questions</title>
</head>
<body>
    <h1>Liste des questions</h1>

    <?php
    while ($question = $getQuestions->fetch(PDO::FETCH_ASSOC)) {
        echo '<div class="question">';
        echo '<h2>' . htmlspecialchars($question['titre']) . '</h2>';
        echo '<p>' . nl2br(htmlspecialchars($question['description'])) . '</p>';
        echo '<p>' . nl2br(htmlspecialchars($question['contenu'])) . '</p>';
        echo '<p class="date">Publié le ' . htmlspecialchars($question['date_publication']) . '</p>';
        echo '<a href="reponse.php?id=' . $question['id'] . '">Répondre</a>'; // Bouton "Répondre"
        echo '</div>';
    }
    ?>
</body>
</html>
