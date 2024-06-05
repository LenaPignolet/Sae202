<?php
session_start();

require("../connexion_sql.php");

if (isset($_POST["email"])) {
    $sql = "INSERT INTO User (user_nom, user_mail, user_passwd, user_pp, user_prenom) VALUES (:user_nom, :user_mail,:user_passwd, :user_pp, :user_prenom)";
    $query = $mabd->prepare($sql);
    $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
    $password = $_POST["password"];
    $nom = htmlspecialchars($_POST["nom"]);
    $prenom = htmlspecialchars($_POST["prenom"]);

    // Handle the file upload
    if ($_FILES["user_pp"]["error"] === UPLOAD_ERR_OK) {
        $photo = basename($_FILES["user_pp"]["name"]);
        $target_dir = "../images/pp/";
        $target_file = $target_dir . $photo;

        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES["user_pp"]["tmp_name"], $target_file)) {
            // File uploaded successfully
        } else {
            // Handle the error
            echo "Erreur lors du téléchargement de l'image.";
            exit();
        }
    } else {
        // Handle the error
        echo "Erreur lors du téléchargement de l'image.";
        exit();
    }

    $hashPassword = password_hash($password, PASSWORD_DEFAULT);

    $query->bindValue(":user_mail", $email);
    $query->bindValue(":user_passwd", $hashPassword);
    $query->bindValue(":user_nom", $nom);
    $query->bindValue(":user_prenom", $prenom);
    $query->bindValue(":user_pp", $photo);

    $res = $query->execute();
    if ($res) {
        $_SESSION["email"] = $email;
        $_SESSION["nom"] = $nom;
        $_SESSION["prenom"] = $prenom;
        $_SESSION["user_pp"] = $photo;
        header("Location: ../index.php");
        exit();
    } else {
        echo "Erreur lors de l'inscription.";
    }
}
?>