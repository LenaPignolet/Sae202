<?php

include("../connexion_sql.php");

$message = '';

if (isset($_POST['user_mail']) && isset($_POST['password'])) {
    $username = $_POST['user_mail'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE user_mail = :user_mail";
    $stmt = $mabd->prepare($sql);
    $stmt->execute(['user_mail' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['user_passwd'])) {  // Assurez-vous que le mot de passe est haché
        session_start();
        $_SESSION['id'] = $user['user_id'];
        $_SESSION['nom'] = $user['user_nom'];
        header('Location: ../index.php');
        exit;
    } else {
        $message = 'Mauvais identifiants';
    }
}
?>
