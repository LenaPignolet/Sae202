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
    <link href="../assets/css/master.css" rel="stylesheet">
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
            <!-- end of navbar navigation component -->
            <div class="content">
                <div class="container">
                    <div class="page-title">
                        <h3>Modification d'un jardin</h3>
                    </div>
                    <div class="box box-primary">
                        <div class="box-body">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade active show" id="general" role="tabpanel" aria-labelledby="general-tab">
                                    <div class="col-md-6">

                                        <?php
                                        if (isset($_GET['num'])) {
                                            $allJardinId = $_GET['num'];

                                            try {
                                                $mabd = new PDO('mysql:host=localhost;dbname=sae202Base;charset=UTF8;', 'Usersae202', '123');
                                                $mabd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                                $req = "SELECT * FROM Jardin WHERE jardin_id = :allJardinId";
                                                $stmt = $mabd->prepare($req);
                                                $stmt->execute(['allJardinId' => $allJardinId]);

                                                if ($stmt->rowCount() > 0) {
                                                    $allJardin = $stmt->fetch(PDO::FETCH_ASSOC);
                                                    $req_parcelle = "SELECT * FROM Parcelle";
                                                    $resultat_parcelle = $mabd->query($req_parcelle);

                                                    echo '<form method="POST" action="modifier_jardin_valid.php" enctype="multipart/form-data">';
                                                    // Champ caché pour stocker l'ancien nom de fichier photo
                                                    echo '<input type="hidden" name="nouvelle_photo_old" value="' . htmlspecialchars($allJardin['jardin_photo']) . '">';
                                                    // Champ hidden pour l'ID du jardin
                                                    echo '<input type="hidden" name="num" value="' . htmlspecialchars($allJardin['jardin_id']) . '">';
                                                    // Champ pour la nouvelle photo
                                                    echo '<div class="mb-3">
                                                    <label class="form-label">Nouvelle Photo</label>
                                                    <input id="formFile1" class="form-control" type="file" name="nouvelle_photo">
                                                    </div> 
                                                    <br>';

                                                    echo '<div class="mb-3"> <label for="site-title" class="form-label">Le nom du jardin</label>
                                                        <input class="form-control" type="text" name="nom" value="' . htmlspecialchars($allJardin['jardin_nom']) . '">
                                                        </div><br>';

                                                    echo '<div class="mb-3"> <label for="site-title" class="form-label">Adresse</label>
                                                        <input class="form-control" type="text" name="adresse" value="' . htmlspecialchars($allJardin['jardin_coord']) . '">
                                                        </div><br>';

                                                    echo '<div class="mb-3"> <label for="site-title" class="form-label">Surface (m²)</label>
                                                        <input class="form-control" type="text" name="surface" value="' . htmlspecialchars($allJardin['jardin_surface']) . '">
                                                        </div><br>';

                                                    echo '<div class="mb-3"> <label for="site-title" class="form-label">Nombre de parcelles</label>
                                                        <input class="form-control" type="text" name="jardin_n_parcelle" value="' . htmlspecialchars($allJardin['jardin_n_parcelle']) . '">
                                                        </div><br>';

                                                    echo '<div class="mb-3 text-end">
                                                        <input class="btn btn-success" type="submit" value="Modifier">
                                                        </div>';
                                                    echo '</form>';
                                                } else {
                                                    echo '<p>Le jardin avec l\'ID ' . htmlspecialchars($allJardinId) . ' n\'existe pas.</p>';
                                                }
                                            } catch (PDOException $e) {
                                                echo "Erreur : " . $e->getMessage();
                                            }
                                        } else {
                                            echo '<p>Aucun ID du jardin fourni.</p>';
                                        }
                                        ?>
                                    </div>
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
