<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validation</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</head>
<body>
<nav class="bg-gray-800">
  <div class="mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-16">
      <div class="flex">
        <div class="-ml-2 mr-2 flex items-center md:hidden">
          <!-- Mobile menu button -->
          <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <!--
              Icon when menu is closed.

              Heroicon name: outline/menu

              Menu open: "hidden", Menu closed: "block"
            -->
            <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <!--
              Icon when menu is open.

              Heroicon name: outline/x

              Menu open: "block", Menu closed: "hidden"
            -->
            <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
        <div class="flex-shrink-0 flex items-center">
          <img class="hidden lg:block h-8 w-auto mr-3" src="../images/logo.png" alt="Workflow">
        </div>
        <div class="hidden md:ml-6 md:flex md:items-center md:space-x-4">
          <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
          <a href="../index.php" class="bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium" aria-current="page">Accueil</a>

          <a href="../liste_jardins.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Jardins</a>

          <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Qui sommes-nous ?</a>

          <a href="../contact.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Contact</a>
        </div>
      </div>
      <div class="flex items-center">
        <div class="flex-shrink-0">
          <div id="connexion">
            <?php
                if(isset($_SESSION['id'])){ // Check if $_SESSION['id'] is set
            ?>
            
            <?php
              }else {?>
            <a href="formConnexion.php" class="relative inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-500 hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-indigo-500"><span>Connexion</span></a>
            <a href="formInscription.php" class="relative inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-500 hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-indigo-500"><span>Inscription</span></a>
            <!-- Profile dropdown -->
          <div class="ml-3 relative">
            <div>
              <button type="button" class="bg-gray-800 flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                <span class="sr-only">Open user menu</span>
                <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
              </button>
            </div>

            <!--
              Dropdown menu, show/hide based on menu state.

              Entering: "transition ease-out duration-200"
                From: "transform opacity-0 scale-95"
                To: "transform opacity-100 scale-100"
              Leaving: "transition ease-in duration-75"
                From: "transform opacity-100 scale-100"
                To: "transform opacity-0 scale-95"
            -->
            <div class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
              <!-- Active: "bg-gray-100", Not Active: "" -->
              <a href="../profil/profil.php" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Profil</a>

              <a href="logout.php" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-2">Déconnexion</a>
            </div>
          </div>
            <?php
            }
            ?>
          </div>
          
        </div>
        <div class="hidden md:ml-4 md:flex-shrink-0 md:flex md:items-center">
          <button type="button" class="bg-gray-800 p-1 rounded-full text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
            <a href="/admin/admin.php" class="sr-only">Admin</a>
            <!-- Heroicon name: outline/bell -->
            <img class="h-6 w-6" src="images/admin.png" alt="">
          </button>

          
        </div>
      </div>
    </div>
  </div>

  <!-- Mobile menu, show/hide based on menu state. -->
  <div class="md:hidden" id="mobile-menu">
    <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
      <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
      <a href="#" class="bg-gray-900 text-white block px-3 py-2 rounded-md text-base font-medium" aria-current="page">Dashboard</a>

      <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Team</a>

      <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Projects</a>

      <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Calendar</a>
    </div>
    <div class="pt-4 pb-3 border-t border-gray-700">
      <div class="flex items-center px-5 sm:px-6">
        <div class="flex-shrink-0">
          <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
        </div>
        <div class="ml-3">
          <div class="text-base font-medium text-white">Tom Cook</div>
          <div class="text-sm font-medium text-gray-400">tom@example.com</div>
        </div>
        <button type="button" class="ml-auto flex-shrink-0 bg-gray-800 p-1 rounded-full text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
          <span class="sr-only">View notifications</span>
          <!-- Heroicon name: outline/bell -->
          <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
          </svg>
        </button>
      </div>
      <div class="mt-3 px-2 space-y-1 sm:px-3">
        <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700">Your Profile</a>

        <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700">Settings</a>

        <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700">Sign out</a>
      </div>
    </div>
  </div>
</nav>

<a href="gestion_jardin.php">Retour au tableau de bord</a>
<hr>

<h1 class="valide">Gestion de nos jardins</h1>
<h2 class="valide">Vous venez d'ajouter un jardin</h2>
<hr>

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
    die();
}

// Création d'un nouveau nom pour cette image téléchargée pour éviter d'avoir 2 fichiers avec le même nom
$nouvelleImage = date("Y_m_d_H_i_s") . "---" . basename($_FILES["photo"]["name"]);
$targetDir = "/var/www/sae202/images/uploads/"; // Chemin correct vers le dossier

// Vérification si le dossier existe et est accessible
if (!is_dir($targetDir)) {
    echo '<p>Le dossier cible n\'existe pas. Veuillez vérifier le chemin.</p>';
    die();
}

$targetFilePath = $targetDir . $nouvelleImage;

// Dépôt du fichier téléchargé dans le dossier
if (is_uploaded_file($_FILES["photo"]["tmp_name"])) {
    if (!move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFilePath)) {
        echo '<p>Problème avec la sauvegarde de l\'image, désolé...</p>';
        die();
    }
} else {
    echo '<p>Problème : image non chargée...</p>';
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
    echo '<p>Jardin ajouté avec succès !</p>';
} catch (PDOException $e) {
    echo '<p>Échec de l\'ajout du jardin : ' . $e->getMessage() . '</p>';
}

?>


<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
<footer>
    <p>© PAGEC - Tous droits réservés</p>
    <a href="../mentions.php">Mentions légales</a>
</footer>
</html>
