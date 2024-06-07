<?php
$host = 'localhost';
$dbname = 'sae202';
$username = 'sae202User';
$password = '123';

try {
    $mabd = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    // Configurer PDO pour qu'il gÃ©nÃ¨re des exceptions en cas d'erreurs
    $mabd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Ã‰chec de la connexion : ' . $e->getMessage();
    exit;
}
?>
