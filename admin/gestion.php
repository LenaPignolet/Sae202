<!doctype html>
<!-- 
* Bootstrap Simple Admin Template
* Version: 2.1
* Author: Alexis Luna
* Website: https://github.com/alexis-luna/bootstrap-simple-admin-template
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Page admin">
    <title>Dashboard</title>
    <link href="assets/vendor/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome/css/solid.min.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome/css/brands.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/master.css" rel="stylesheet">
    <link href="assets/vendor/flagiconcss/css/flag-icon.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="/images/logo.png">
</head>

<body>
    <div class="wrapper">
        <nav id="sidebar" class="active">
            <div class="sidebar-header">
                <img src="assets/img/logo.png" alt="bootraper logo" width="40px" class="app-logo">
            </div>
            <ul class="list-unstyled components text-secondary">
                <li>
                    <a href="gestion.php"><i class="fas fa-home"></i> Dashboard</a>
                </li>

                <li>
                    <a href="./Jardins/gestion_jardin.php"><i class="fas fa-tree"></i> Gestion Jardins</a>
                </li>

                <li>
                    <a href="./Parcelle/gestion_parcelle.php"><i class="fas fa-chess-board"></i> Gestion Parcelles</a>
                </li>

                <li>
                    <a href="./Usagers/user_gestion.php"><i class="fas fa-user-friends"></i> Gestion Users</a>
                </li>

                <li>
                    <a href="../index.php"><i class="fas fa-arrow-left"></i> Retour</a>
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

            <!-- end of navbar navigation -->
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 page-header">
                            <div class="page-pretitle">Overview</div>
                            <h2 class="page-title">Dashboard</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-3 mt-3">
                            <div class="card">
                                <div class="content">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="icon-big text-center">
                                                <i class="fas fa-seedling" style="color: #03543F;"></i>
                                            </div>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="detail">
                                                <p class="detail-subtitle">Nombre total des jardins</p>
                                                <?php
                                                    // Connexion à la base de données
                                                    $servername = "localhost";
                                                    $username = "Usersae202";
                                                    $password = "123";
                                                    $database = "sae202Base";

                                                    $conn = new mysqli($servername, $username, $password, $database);

                                                    // Vérifier la connexion
                                                    if ($conn->connect_error) {
                                                        die("Échec de la connexion : " . $conn->connect_error);
                                                    }

                                                    // Requête SQL pour compter le nombre total de jardins
                                                    $sql = "SELECT COUNT(*) AS total_parcelle FROM Jardin";
                                                    $result = $conn->query($sql);

                                                    if ($result->num_rows > 0) {
                                                        // Récupérer le résultat
                                                        $row = $result->fetch_assoc();
                                                        $total_parcelle = $row["total_parcelle"];
                                                        echo "<span class='number'>" . $total_parcelle . "</span>";
                                                    } else {
                                                        echo "Aucun jardin trouvé.";
                                                    }

                                                    // Fermer la connexion
                                                    $conn->close();
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-3 mt-3">
                            <div class="card">
                                <div class="content">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="icon-big text-center">
                                            <i class="fas fa-cubes" style="color: #8a460f;"></i>
                                            </div>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="detail">
                                                <p class="detail-subtitle">Nombre total des parcelles</p>
                                                <?php
                                                    // Connexion à la base de données
                                                    $servername = "localhost";
                                                    $username = "Usersae202";
                                                    $password = "123";
                                                    $database = "sae202Base";

                                                    $conn = new mysqli($servername, $username, $password, $database);

                                                    // Vérifier la connexion
                                                    if ($conn->connect_error) {
                                                        die("Échec de la connexion : " . $conn->connect_error);
                                                    }

                                                    // Requête SQL pour compter le nombre total de parcelles
                                                    $sql = "SELECT COUNT(*) AS total_parcelle FROM Parcelle";
                                                    $result = $conn->query($sql);

                                                    if ($result->num_rows > 0) {
                                                        // Récupérer le résultat
                                                        $row = $result->fetch_assoc();
                                                        $total_parcelle = $row["total_parcelle"];
                                                        echo "<span class='number'>" . $total_parcelle . "</span>";
                                                    } else {
                                                        echo "Aucun jardin trouvé.";
                                                    }

                                                    // Fermer la connexion
                                                    $conn->close();
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-3 mt-3">
                            <div class="card">
                                <div class="content">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="icon-big text-center">
                                            <i class="fas fa-users" style="color: #74C0FC;"></i>
                                            </div>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="detail">
                                                <p class="detail-subtitle">Nombre total des utilisateurs</p>
                                                <?php
                                                    // Connexion à la base de données
                                                    $servername = "localhost";
                                                    $username = "Usersae202";
                                                    $password = "123";
                                                    $database = "sae202Base";

                                                    $conn = new mysqli($servername, $username, $password, $database);

                                                    // Vérifier la connexion
                                                    if ($conn->connect_error) {
                                                        die("Échec de la connexion : " . $conn->connect_error);
                                                    }

                                                    // Requête SQL pour compter le nombre total d'utilisateurs
                                                    //modifie ca pour qu'il convienne ton code et ta base de données
                                                    $sql = "SELECT COUNT(*) AS total_user FROM User";
                                                    $result = $conn->query($sql);

                                                    if ($result->num_rows > 0) {
                                                        // Récupérer le résultat
                                                        $row = $result->fetch_assoc();
                                                        $total_user = $row["total_user"];
                                                        echo "<span class='number'>" . $total_user . "</span>";
                                                    } else {
                                                        echo "Aucun jardin trouvé.";
                                                    }

                                                    // Fermer la connexion
                                                    $conn->close();
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
    </div>
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chartsjs/Chart.min.js"></script>
    <script src="assets/js/dashboard-charts.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>
