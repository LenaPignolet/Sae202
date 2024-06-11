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
                    <a href="gestion_jardin.php"><i class="fas fa-tree"></i> Gestion Jardins</a>
                </li>
                <li>
                    <a href="../Parcelle/gestion_parcelle.php"><i class="fas fa-chess-board"></i> Gestion Parcelles</a>
                </li>
                <li>
                    <a href="./Usagers/user_gestion.php"><i class="fas fa-user-friends"></i> Gestion Users</a>
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
                        <h3>Vous venez d'ajouter un jardin</h3>
                    </div>
                    <div class="box box-primary">
                        <div class="box-body">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade active show" id="general" role="tabpanel" aria-labelledby="general-tab">
                                    <div class="col-md-6">
                                        <?php
                                        $nom = $_POST['nom'];
                                        $adresse = $_POST['adresse'];
                                        $surface = $_POST['surface'];
                                        $nParcelle = $_POST['nParcelle'];

                                        try {
                                            $mabd = new PDO('mysql:host=localhost;dbname=sae202Base;charset=UTF8;', 'Usersae202', '123');
                                            $mabd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                            $mabd->query('SET NAMES utf8;');
                                        } catch (PDOException $e) {
                                            echo 'Connexion échouée : ' . $e->getMessage();
                                            die();
                                        }

                                        // Vérification du format de l'image téléchargée
                                        $imageType = $_FILES["photo"]["type"];
                                        $allowedTypes = ["image/png", "image/jpg", "image/jpeg"];
                                        if (!in_array($imageType, $allowedTypes)) {
                                            echo '<p>Désolé, le type d\'image n\'est pas reconnu ! Seuls les formats PNG et JPEG sont autorisés.</p>';
                                            echo "<br>";
                                            echo '<a class="btn btn-success" href="gestion_jardin.php">Retour au tableau de bord</a>';
                                            die();
                                        }

                                        // Création d'un nouveau nom pour cette image téléchargée pour éviter d'avoir 2 fichiers avec le même nom
                                        $nouvelleImage = date("Y_m_d_H_i_s") . "---" . basename($_FILES["photo"]["name"]);
                                        $targetDir = "/var/www/sae202/images/uploads/"; // Chemin correct vers le dossier

                                        // Vérification si le dossier existe et est accessible
                                        if (!is_dir($targetDir)) {
                                            echo '<p>Le dossier cible n\'existe pas. Veuillez vérifier le chemin.</p>';
                                            echo "<br>";
                                            echo '<a class="btn btn-success" href="gestion_jardin.php">Retour au tableau de bord</a>';
                                            die();
                                        }

                                        $targetFilePath = $targetDir . $nouvelleImage;

                                        // Dépôt du fichier téléchargé dans le dossier
                                        if (is_uploaded_file($_FILES["photo"]["tmp_name"])) {
                                            if (!move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFilePath)) {
                                                echo '<p>Problème avec la sauvegarde de l\'image, désolé...</p>';
                                                echo "<br>";
                                                echo '<a class="btn btn-success" href="gestion_jardin.php">Retour au tableau de bord</a>';
                                                die();
                                            }
                                        } else {
                                            echo '<p>Problème : image non chargée...</p>';
                                            echo "<br>";
                                            echo '<a class="btn btn-success" href="gestion_jardin.php">Retour au tableau de bord</a>';
                                            die();
                                        }

                                        // Préparation de la requête d'insertion
                                        $req = $mabd->prepare('INSERT INTO Jardin (jardin_photo, jardin_nom, jardin_coord, jardin_surface, jardin_n_parcelle) VALUES (:photo, :nom, :adresse, :surface, :nParcelle)');

                                        // Exécution de la requête avec les valeurs passées en paramètres
                                        try {
                                            $resultat = $req->execute([
                                                ':photo' => $nouvelleImage,
                                                ':nom' => $nom,
                                                ':adresse' => $adresse,
                                                ':surface' => $surface,
                                                ':nParcelle' => $nParcelle
                                            ]);
                                            echo '<p>Jardin ajouté avec succès ! <i class="fas fa-check-circle" style="color: #037c58;"></i></p>';
                                            echo "<br>";
                                            echo '<a class="btn btn-success" href="gestion_jardin.php">Retour au tableau de bord</a>';
                                        } catch (PDOException $e) {
                                            echo '<p>Échec de l\'ajout du jardin : ' . $e->getMessage() . '</p>';
                                            echo "<br>";
                                            echo '<a class="btn btn-success" href="gestion_jardin.php">Retour au tableau de bord</a>';
                                        }
                                        ?>
                                    </div> <!-- Fin de .col-md-6 -->
                                </div> <!-- Fin de .tab-pane -->
                            </div> <!-- Fin de .tab-content -->
                        </div> <!-- Fin de .box-body -->
                    </div> <!-- Fin de .box -->
                </div> <!-- Fin de .container -->
            </div> <!-- Fin de .content -->
        </div> <!-- Fin de #body -->
    </div> <!-- Fin de .wrapper -->

    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/script.js"></script>
</body>

</html>
