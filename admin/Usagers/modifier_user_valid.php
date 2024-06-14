<!doctype html>
<!-- 
* Bootstrap Simple Admin Template
* Version: 2.1
* Author: Alexis Luna
* Website: https://github.com/alexis-luna/bootstrap-simple-admin-template
-->
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Page admin">
    <title>Dashboard</title>
    <link href="../assets/vendor/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="../assets/vendor/fontawesome/css/solid.min.css" rel="stylesheet">
    <link href="../assets/vendor/fontawesome/css/brands.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/datatables/datatables.min.css" rel="stylesheet">
    <link href="../assets/css/master.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" type="image/png" href="/images/logo.png">
</head>

<body>

    <div class="wrapper">
        <nav id="sidebar" class="active">
            <div class="sidebar-header">
                <img src="../assets/img/logo.png" alt="bootraper logo" width="40px" class="app-logo">
            </div>
            <ul class="list-unstyled components text-secondary">
                <li>
                    <a href="/admin/gestion.php"><i class="fas fa-home"></i> Dashboard</a>
                </li>

                <li>
                    <a href="../Jardins/gestion_jardin.php"><i class="fas fa-tree"></i> Gestion Jardins</a>
                </li>

                <li>
                    <a href="../Parcelle/gestion_parcelle.php"><i class="fas fa-chess-board"></i> Gestion Parcelles</a>
                </li>

                <li>
                    <a href="./user_gestion.php"><i class="fas fa-user-friends"></i> Gestion Users</a>
                </li>

                <li>
                    <a href="../Plantation/gestion_plantation.php"><i class="fas fa-spa"></i> Gestion Plantation</a>
                </li>

                <li>
                    <a href="/index.php"><i class="fas fa-arrow-left"></i> Retour</a>
                </li>

            </ul>
        </nav>
        <div id="body" class="active">
            <!-- navbar navigation component -->
            <nav class="navbar navbar-expand-lg navbar-white bg-white">
                <button title="menu" type="button" id="sidebarCollapse" class="btn btn-light">
                    <i class="fas fa-bars"></i><span></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <div class="nav-dropdown">
                                <div class="dropdown-menu dropdown-menu-end nav-link-menu" aria-labelledby="nav1">
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="content">
                <div class="container">
                    <div class="page-title">
                        <h3>Vous venez de modifier un utilisateur</h3>
                    </div>
                    <div class="box box-primary">
                        <div class="box-body">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade active show" id="general" role="tabpanel" aria-labelledby="general-tab">
                                    <div class="col-md-6">
                                        <?php
                                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                            $allJardin = $_POST['num'];
                                            $nom = $_POST['nom'];
                                            $prenom = $_POST['prenom'];
                                            $mail = $_POST['mail'];
                                            $mdp = $_POST['mdp'];

                                            // Connexion à la base de données
                                            try {
                                                $mabd = new PDO('mysql:host=localhost;dbname=sae202;charset=UTF8;', 'Usersae202', '123');
                                                $mabd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                            } catch (PDOException $e) {
                                                echo 'Connexion échouée : ' . $e->getMessage();
                                                die();
                                            }

                                            if (isset($_FILES['nouvelle_photo']) && $_FILES['nouvelle_photo']['error'] === UPLOAD_ERR_OK) {
                                                $fileTmpPath = $_FILES['nouvelle_photo']['tmp_name'];
                                                $fileName = $_FILES['nouvelle_photo']['name'];
                                                $fileSize = $_FILES['nouvelle_photo']['size'];
                                                $fileType = $_FILES['nouvelle_photo']['type'];


                                                $allowedMimeTypes = ['image/png', 'image/jpeg', 'image/jpg'];
                                                if (!in_array($fileType, $allowedMimeTypes)) {
                                                    echo "Seuls les formats PNG et JPEG sont autorisés.";
                                                    die();
                                                }


                                                $nouvelle_photo = date("Y_m_d_H_i_s") . "---" . basename($fileName);
                                                $target_dir = "/var/www/sae202/images/pp/";
                                                $target_file = $target_dir . $nouvelle_photo;


                                                if (move_uploaded_file($fileTmpPath, $target_file)) {

                                                    try {
                                                        $req = "UPDATE User SET user_pp = :nouvelle_photo, user_nom = :nom, user_prenom = :prenom, user_mail = :mail, user_passwd = :mdp WHERE user_id = :allJardin";
                                                        $stmt = $mabd->prepare($req);
                                                        $stmt->execute([
                                                            'nouvelle_photo' => $nouvelle_photo,
                                                            'nom' => $nom,
                                                            'prenom' => $prenom,
                                                            'mail' => $mail,
                                                            'mdp' => $mdp,
                                                            'allJardin' => $allJardin
                                                        ]);

                                                        echo '<p>Modification de l\'utilisateur réussie ! <i class="fas fa-circle-check" style="color: #037c58;"></i></p>';
                                                        echo "<br>";
                                                        echo '<a  class="btn btn-success" href="user_gestion.php">Retour au tableau de bord</a>';
                                                    } catch (PDOException $e) {
                                                        echo "Erreur : " . $e->getMessage();
                                                    }
                                                } else {
                                                    echo "Une erreur s'est produite lors du téléchargement du fichier.";
                                                }
                                            } else {

                                                if (isset($_POST['nouvelle_photo_old'])) {
                                                    $nouvelle_photo = $_POST['nouvelle_photo_old'];
                                                } else {
                                                    echo "Erreur : ancienne photo non spécifiée.";
                                                    die();
                                                }


                                                try {
                                                    $req = "UPDATE User SET user_nom = :nom, user_prenom = :prenom, user_mail = :mail, user_passwd = :mdp WHERE user_id = :allJardin";
                                                    $stmt = $mabd->prepare($req);
                                                    $stmt->execute([
                                                        'nom' => $nom,
                                                        'prenom' => $prenom,
                                                        'mail' => $mail,
                                                        'mdp' => $mdp,
                                                        'allJardin' => $allJardin
                                                    ]);

                                                    echo '<p>Modification du jardin réussie ! <i class="fas fa-circle-check" style="color: #037c58;"></i></p>';
                                                    echo "<br>";
                                                    echo '<a  class="btn btn-success" href="user_gestion.php">Retour au tableau de bord</a>';
                                                } catch (PDOException $e) {
                                                    echo "Erreur : " . $e->getMessage();
                                                }
                                            }
                                        } else {
                                            echo "<p>Méthode non autorisée.</p>";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script src="../assets/vendor/jquery/jquery.min.js"></script>
                <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
                <script src="../assets/js/script.js"></script>
</body>

</html>
