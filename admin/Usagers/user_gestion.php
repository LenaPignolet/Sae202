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
                    <a href="../Jardins/gestion_jardin.php"><i class="fas fa-tree"></i> Gestion Jardins</a>
                </li>

                <li>
                    <a href="../Parcelle/gestion_parcelle.php"><i class="fas fa-chess-board"></i> Gestion Parcelles</a>
                </li>

                <li>
                    <a href="user_gestion.php"><i class="fas fa-user-friends"></i> Gestion Users</a>
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
                        <h3>Gestion les utilisaterus</h3>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-header"><a href="ajouter_user_form.php" style="color: #03543F; background-color: #fffff1; padding: 6px; border-radius: 3px;">Ajouter un utilisateur <i class="fas fa-plus" style="color: #03543F;"></i></a></div>
                                <div class="card-body">
                                    <p class="card-title"></p>
                                    <table class="table table-hover" id="dataTables-example" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Photo</th>
                                                <td>Nom</td>
                                                <td>Prénom</td>
                                                <td>Mail</td>
                                                <td>Mot de passe</td>
                                                <td>Modifier</td>
                                                <td>Supprimer</td>
                                            </tr>
                                        </thead>
                                        <?php require('../../connexion_sql.php') ?>
                                        <?php
                                        $sql = "SELECT * FROM User";
                                        $query = $mabd->prepare($sql);
                                        $query->execute();
                                        $resultat = $query->fetchAll();
                                        foreach ($resultat as $value) {
                                            echo '<tr>';
                                            echo '<td><img class="photo_gestion" style="width:100px;" src="/images/pp/' . $value['user_pp'] . '" alt="User photo"></td>';
                                            echo '<td>' . htmlspecialchars($value['user_nom']) . '</td>';
                                            echo '<td>' . htmlspecialchars($value['user_prenom']) . '</td>';
                                            echo '<td>' . htmlspecialchars($value['user_mail']) . '</td>';
                                            echo '<td>' . htmlspecialchars($value['user_passwd']) . '</td>';
                                            echo '<td><a class="btn btn-outline-info btn-rounded" aria-label="Modifier" href="modifier_user_form.php?num=' . $value['user_id'] . '"><i class="fas fa-pen"></i></a></td>';
                                            echo '<td><a class="btn btn-outline-danger btn-rounded" aria-label="Supprimer" href="supprimer_user.php?num=' . $value['user_id'] . '"><i class="fas fa-trash"></i></a></td>';
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
