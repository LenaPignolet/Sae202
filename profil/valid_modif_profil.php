<!DOCTYPE html>
<html>
<head>
    <title>Modifier un utilisateur</title>
</head>
<body>
<a href="../index.php">Retour</a>
<hr>
<h1>Gestion des usagers</h1>
<p>Vous venez de modifier un utilisateur</p>
<hr>
<?php
    $num = $_POST['num'];
    $nom = $_POST['user_nom'];
    $prenom = $_POST['user_prenom'];
    $mail = $_POST['user_mail'];
    
    $mabd = new PDO('mysql:host=localhost;dbname=sae202;charset=UTF8;', 'sae202User', '123');
    $mabd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

    // Vérification du format de l'image téléchargée
    if (isset($_FILES['user_pp']) && $_FILES['user_pp']['error'] === UPLOAD_ERR_OK) {
        $imageType = $_FILES["user_pp"]["type"];
        if (($imageType != "image/png") && ($imageType != "image/jpg") && ($imageType != "image/jpeg")) {
            echo '<p>Désolé, le type d\'image n\'est pas reconnu ! Seuls les formats PNG et JPEG sont autorisés.</p>'."\n";
            die();
        }

        // Création d'un nouveau nom pour cette image téléchargée pour éviter d'avoir 2 fichiers avec le même nom
        $nouvelleImage = date("Y_m_d_H_i_s")."---".$_FILES["user_pp"]["name"];
        $nouvelleImage = str_replace(" ", "_", $nouvelleImage); // Remplacer les espaces par des underscores

        // Dépôt du fichier téléchargé dans le dossier ../images/pp/
        $target_dir = "../images/pp/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }
        $target_file = $target_dir . $nouvelleImage;

        if (is_uploaded_file($_FILES["user_pp"]["tmp_name"])) {
            if (!move_uploaded_file($_FILES["user_pp"]["tmp_name"], $target_file)) {
                echo '<p>Problème avec la sauvegarde de l\'image, désolé...</p>'."\n";
                die();
            }
        } else {
            echo '<p>Problème : image non chargée...</p>'."\n";
            die();
        }
    } else {
        echo '<p>Problème : image non téléchargée ou erreur inconnue.</p>'."\n";
        die();
    }

    $req = 'UPDATE User SET user_nom=?, user_prenom=?, user_mail=?, user_pp=? WHERE user_id=?';
    $stat = $mabd->prepare($req);
    $stat->execute([$nom, $prenom, $mail, $nouvelleImage, $num]);
?>
</body>
</html>
