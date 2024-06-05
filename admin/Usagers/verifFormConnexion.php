<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sae 202</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<nav>
    <ul>
        <img src="" alt="Logo">
        <div id="nav_menu">
            <li><a href="../../index.php">Accueil</a></li>
            <li><a href="../../liste_jardins.php">Jardins potagers</a></li>
            <li><a href="">Qui sommes nous ?</a></li>
        </div>
        <div id="connexion">
            <a href="../../formConnexion.php">Connexion</a>
            <a href="../../formInscription.php">Inscription</a>
            <?php
                // Connexion/Inscription
            ?>
        </div>
        <div id="profil">
            <?php
                // Profil
            ?>
        </div>
        <div id="languages">
            <!-- Langues -->
        </div>
    </ul>
</nav>

<?php
require('../conf.php');

if(isset($_POST['user_email']) && isset($_POST['user_password'])){

    $email = $_POST['user_mail'];
    $password = $_POST['user_passwd'];

    filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);

    if (empty($email) || empty($password)) {
        $messageErreur = "Veuillez remplir tous les champs.";
    }
    
}   
else{
    echo 'erreur de connexion les champs ne sont pas remplis';
}

require('../../footer.php');
?>