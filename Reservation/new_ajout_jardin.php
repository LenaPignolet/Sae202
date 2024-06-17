<?php
session_start(); // Démarrer la session pour accéder aux variables de session

require('../header.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ajout de jardin</title>
</head>
<body>
<a href="../index.php">Retour au tableau de bord</a>    
<hr>
<h1>Gestion de nos jardins</h1>
<h2>Vous venez d'ajouter un jardin</h2>
<hr>
<?php
// Vérifiez que l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    die('Erreur : Vous devez être connecté pour ajouter un jardin.');
}

$nom_jardin = $_POST['jardin_nom'];
$coordonne = $_POST['jardin_coord'];
$surface = $_POST['jardin_surface'];
$nombre_parcelles = intval($_POST['nombre_parcelles']);
$user_id = $_SESSION['id']; 

$imageType = $_FILES["jardin_photo"]["type"];
if ( ($imageType != "image/png") &&
     ($imageType != "image/jpg") &&
     ($imageType != "image/jpeg") ) {
    echo '<p>Désolé, le type d\'image n\'est pas reconnu ! Seuls les formats PNG et JPEG sont autorisés.</p>';
    die();
}

$nouvelleImage = date("Y_m_d_H_i_s")."---".$_FILES["jardin_photo"]["name"];

if(is_uploaded_file($_FILES["jardin_photo"]["tmp_name"])) {
    if(!move_uploaded_file($_FILES["jardin_photo"]["tmp_name"], "../images/uploads/".$nouvelleImage)) {
        echo '<p>Problème avec la sauvegarde de l\'image, désolé...</p>';
        die();
    }
} else {
    echo '<p>Problème : image non chargée...</p>';
    die();
}

try {
    $mabd = new PDO('mysql:host=localhost;dbname=sae202;charset=UTF8;', 'sae202User', '123');
    $mabd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $mabd->query('SET NAMES utf8;');

    $req = 'INSERT INTO Jardin (jardin_nom, jardin_coord, jardin_photo, jardin_surface, user_id) VALUES (:nom_jardin, :coordonne, :image_jardin, :surface, :user_id)';
    $stmt = $mabd->prepare($req);
    $stmt->bindParam(':nom_jardin', $nom_jardin);
    $stmt->bindParam(':coordonne', $coordonne);
    $stmt->bindParam(':image_jardin', $nouvelleImage);
    $stmt->bindParam(':surface', $surface);
    $stmt->bindParam(':user_id', $user_id); 
    $stmt->execute();

    $jardin_id = $mabd->lastInsertId();

    // Insertion des parcelles
    $req_parcelle = 'INSERT INTO Parcelle (parcelle_nom, jardin_id, disponible) VALUES (:parcelle_nom, :jardin_id, 1)';
    $stmt_parcelle = $mabd->prepare($req_parcelle);

    for ($i = 1; $i <= $nombre_parcelles; $i++) {
        $parcelle_nom = 'Parcelle ' . $i;
        $stmt_parcelle->bindParam(':parcelle_nom', $parcelle_nom);
        $stmt_parcelle->bindParam(':jardin_id', $jardin_id);
        $stmt_parcelle->execute();
    }

    echo '<p>Le jardin et ses parcelles ont été ajoutés avec succès.</p>';
} catch (PDOException $e) {
    echo '<p>Erreur : ' . $e->getMessage() . '</p>';
}
?>
</body>
</html>
