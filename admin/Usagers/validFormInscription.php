<?php

try{
    require('../conf.php');
    $mabd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    echo "Erreur : ".$e->getMessage();
}

if(isset($_POST['ok'])){
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];

    $req = $mabd->prepare("INSERT INTO user VALUES (0, :nom, :prenom, :mail, :passwd)");
    $req->execute(
        array(
            "nom" => $nom,
            "prenom" => $prenom,
            "email" => $email,
            "mdp" => $mdp,

        )
        );
        $reponse = $req->fetchAll(PDO::FETCH_ASSOC);
        var_dump($reponse);
}





?>
