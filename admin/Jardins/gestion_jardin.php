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
                    <a href="../Usagers/user_gestion.php"><i class="fas fa-user-friends"></i> Gestion Users</a>
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
            <!-- end of navbar navigation component -->
            <div class="content">
                <div class="container">
                    <div class="page-title">
                        <h3>Gestion les jardins</h3>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-header"><a href="ajouter_jardin_form.php" style="color: #03543F; background-color: #fffff1; padding: 6px; border-radius: 3px;">Ajouter un jardin <i class="fas fa-plus" style="color: #03543F;"></i></a></div>
                                <div class="card-body">
                                    <p class="card-title"></p>
                                    <table class="table table-hover" id="dataTables-example" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Photo</th>
                                                <th>Nom</th>
                                                <th>Adresse</th>
                                                <th>Surface (m²)</th>
                                                <th>Nombre de parcelles</th>
                                                <th>Nom de parcelle</th>
                                                <th>Modifier</th>
                                                <th>Supprimer</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            <?php
                                            $mabd = new PDO('mysql:host=localhost;dbname=sae202;charset=UTF8;', 'Usersae202', '123');
                                            $mabd->query('SET NAMES utf8;');

                                            $req = "
                                            SELECT j.*, COUNT(p.parcelle_id) AS total_parcelles, MIN(p.parcelle_nom) AS premier_parcelle_nom
                                            FROM Jardin j
                                            LEFT JOIN Parcelle p ON j.jardin_id = p.jardin_id
                                            GROUP BY j.jardin_id
                                        ";
                                        
                                        
                                            $resultat = $mabd->query($req);

                                            foreach ($resultat as $value) {
                                                echo '<tr>';
                                                echo '<td><img class="photo_gestion" style="width:100px;" src="/images/uploads/' . htmlspecialchars($value['jardin_photo']) . '" alt="Jardin"></td>';
                                                echo '<td>' . htmlspecialchars($value['jardin_nom']) . '</td>';
                                                echo '<td>' . htmlspecialchars($value['jardin_coord']) . '</td>';
                                                echo '<td>' . htmlspecialchars($value['jardin_surface']) . '</td>';
                                                echo '<td>' . htmlspecialchars($value['total_parcelles']) . '</td>';
                                                
                                                // Affichage du nom de la première parcelle
                                                echo '<td>';
                                                if (!empty($value['premier_parcelle_nom'])) {
                                                    echo htmlspecialchars($value['premier_parcelle_nom']);
                                                } else {
                                                    echo 'Aucune parcelle';
                                                }
                                                echo '</td>';
                                                
                                                echo '<td><a class="btn btn-outline-info btn-rounded" aria-label="Modifier" href="modifier_jardin_form.php?num=' . $value['jardin_id'] . '"><i class="fas fa-pen"></i></a></td>';
                                                echo '<td><a class="btn btn-outline-danger btn-rounded" aria-label="Supprimer" href="supprimer_jardin.php?num=' . $value['jardin_id'] . '"><i class="fas fa-trash"></i></a></td>';
                                                echo '</tr>';
                                            }
                                            
                                            
                                            
                                            ?>


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="../assets/vendor/jquery/jquery.min.js"></script>
        <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../assets/vendor/datatables/datatables.min.js"></script>
        <script src="../assets/js/initiate-datatables.js"></script>
        <script src="../assets/js/script.js"></script>
</body>

</html>
