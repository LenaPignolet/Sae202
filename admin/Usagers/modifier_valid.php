<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<tbody>
<a href="user_gestion.php">retour</a>
<hr>
<h1>gestion des usagers</h1>
<p>vous venez de modifier une voiture</p>
<hr>
<?php
    $num = $_POST['num'];
    $nom = $_POST['user_nom'];
    $prenom = $_FILES['user_prenom'];
    $mail = $_POST['user_mail'];
    $pp = $_POST['user_pp'];

    $mabd = new PDO('mysql:host=localhost;dbname=sae202;charset=UTF8;', 'sae202User', '123');
    $mabd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    
    // Vérification du format de l'image téléchargée
    $imageType = $_FILES["user_pp"]["type"];
    if ( ($imageType != "image/png") && ($imageType != "image/jpg") && ($imageType != "image/jpeg") ) {
        echo '<p>Désolé, le type d\'image n\'est pas reconnu !';
        echo 'Seuls les formats PNG et JPEG sont autorisés.</p>'."\n";
        die();
    }
    
    // Création d'un nouveau nom pour cette image téléchargée pour éviter d'avoir 2 fichiers avec le même nom
    $nouvelleImage = date("Y_m_d_H_i_s")."---".$_FILES["pp_user"]["name"];
    
    // Dépôt du fichier téléchargé dans le dossier /var/www/r214/images/uploads
    if(is_uploaded_file($_FILES["user_pp"]["tmp_name"])) {
        if(!move_uploaded_file($_FILES["user_pp"]["tmp_name"], "../images/pp/".$nouvelleImage)) {
            echo '<p>Problème avec la sauvegarde de l\'image, désolé...</p>'."\n";
            die();
        }
    } else {
        echo '<p>Problème : image non chargée...</p>'."\n";
        die();
    }
    if ($nouvelleImage != "") {
        $req = 'UPDATE user SET user_nom=?, user_prenom=?, user_mail=?, pp_user=? WHERE user_id=?';
        $stat = $mabd->prepare($req);
        $stat->execute([$nom, $nouvelleImage, $prenom, $mail, $pp, $num]);

    }else {
        $req = 'UPDATE user SET user_nom=?, user_prenom=?, user_mail=?, user_pp=? WHERE user_id=?';
        $stat = $mabd->prepare($req);
        $stat->execute([$nom, $prenom, $mail, $pp, $num]);

    }


?>
</tbody>
</table>
</body>
</html>