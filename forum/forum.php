<?php
require('../connexion_sql.php');
session_start();

if (!isset($_SESSION['id'])) {
    header('Location: login.php'); 
    exit();
}

if (isset($_POST['validate'])) {
    if (!empty($_POST['titre']) && !empty($_POST['description']) && !empty($_POST['contenu'])) {
        $question_title = htmlspecialchars($_POST['titre']);
        $question_description = nl2br(htmlspecialchars($_POST['description']));
        $question_content = nl2br(htmlspecialchars($_POST['contenu']));
        $question_date = date('Y-m-d H:i:s');  
        $user_id = $_SESSION['user_id'];

        try {
            $insertQuestionOnWebsite = $mabd->prepare('INSERT INTO questions(titre, description, contenu, date_publication, user_id) VALUES (?, ?, ?, ?, ?)');
            $insertQuestionOnWebsite->execute(array($question_title, $question_description, $question_content, $question_date, $user_id));
            
            header('Location: my_question.php');

            exit();
        } catch (PDOException $e) {
            echo 'Erreur lors de la publication de la question : ' . $e->getMessage();
        }
    } else {
        echo 'Veuillez compléter tous les champs...';
    }
}
?>
