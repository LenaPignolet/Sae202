<?php
session_start();
require("../connexion_sql.php");

// Vérification de l'appel via le formulaire
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Location: ../contact.php');
    exit();
}

// Vérification des données du formulaire
$erreurs = 0;
$affichage_retour = '';

// Vérification de l'adresse mail
if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $affichage_retour .= 'Adresse mail incorrecte<br>';
    $erreurs++;
} else {
    $email = htmlspecialchars($_POST['email']);
}

// Vérification du sujet
if (empty($_POST['subject'])) {
    $affichage_retour .= 'Le champ SUBJECT est obligatoire<br>';
    $erreurs++;
} else {
    $subject = htmlspecialchars($_POST['subject']);
}

// Vérification du message
if (empty($_POST['message'])) {
    $affichage_retour .= 'Le champ MESSAGE est obligatoire<br>';
    $erreurs++;
} else {
    $message = htmlspecialchars($_POST['message']);
}

// Affichage des erreurs et arrêt du script si des erreurs sont détectées
if ($erreurs > 0) {
    echo $affichage_retour;
    exit();
}

// Préparation des variables pour l'envoi du mail de contact
$headers = "From: $email\r\n";
$headers .= "Reply-to: $email\r\n";
$headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=utf-8\r\n";

// Adresse du destinataire
$email_dest = "mmi23h07@mmi-troyes.fr";

// Envoi du mail de contact
if (mail($email_dest, $subject, $message, $headers)) {
    // Préparation et envoi du mail de confirmation à l'utilisateur
    $subject_confirmation = 'Mail de confirmation';
    $message_confirmation = '
    <html>
    <head>
        <title>Confirmation d\'envoi</title>
    </head>
    <body>
        <p>Merci de nous avoir contactés !</p>
        <p>Votre message a bien été reçu.</p>
        <p>Nous vous répondrons dans les plus brefs délais.</p>
        <p>Cordialement,</p>
        <p>EcoPulse</p>
    </body>
    </html>';

    // Headers pour le mail de confirmation
    $headers_confirmation = "From: no-reply@yourdomain.com\r\n";
    $headers_confirmation .= "Reply-to: no-reply@yourdomain.com\r\n";
    $headers_confirmation .= "X-Mailer: PHP/" . phpversion() . "\r\n";
    $headers_confirmation .= "MIME-Version: 1.0\r\n";
    $headers_confirmation .= "Content-type: text/html; charset=utf-8\r\n";

    if (mail($email, $subject_confirmation, $message_confirmation, $headers_confirmation)) {
        // Envoi réussi du mail de confirmation à l'utilisateur
        header('Location: ../contact.php?message=success');
    } else {
        // Envoi échoué du mail de confirmation à l'utilisateur
        header('Location: ../contact.php?message=error');
    }
} else {
    // Envoi échoué du mail de contact
    header('Location: ../contact.php?message=error');
}
?>
