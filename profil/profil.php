<?php
// Vérifiez si l'utilisateur est connecté
require('../connexion_sql.php');

session_start();

try {
    $stmt = $mabd->prepare("SELECT * FROM User WHERE user_id = :user_id");
    $stmt->bindParam(':user_id', $_SESSION['id']);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo "Utilisateur non trouvé.";
        exit;
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sae 202</title>
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Archivo+Black&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .profile-container {
            max-width: 400px;
            margin: 100px auto;
            background-color: #fff;
            padding: 20px 30px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1 {
            margin-top: 0;
            color: #333;
        }
        p {
            margin: 10px 0;
            color: #555;
        }
    </style>
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


      </div>
    </div>
  </div>
</nav>

<div class="profile-container">
    <h1>Votre profil</h1>
    <p><strong>Nom :</strong> <?php echo htmlspecialchars($user['user_nom']); ?></p>
    <p><strong>Prénom :</strong> <?php echo htmlspecialchars($user['user_prenom']); ?></p>
    <p><strong>Email :</strong> <?php echo htmlspecialchars($user['user_mail']); ?></p>
    <a href="modif_profil.php?num=<?php echo htmlspecialchars($user['user_id']); ?>" > modifier </a>
</div>
<?php
$user_id = $_SESSION['id'];

$stmt = $mabd->prepare("SELECT * FROM Jardin WHERE user_id = ?");
$stmt->execute([$user_id]);
$gardens = $stmt->fetchAll();
?>
 <?php if (empty($gardens)): ?>
        <p>Aucun jardin trouvé.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($gardens as $garden): ?>
                <li>
                    <h3><?php echo htmlspecialchars($garden['jardin_nom']); ?></h3>
                    <p>Coordonnées : <?php echo htmlspecialchars($garden['jardin_coord']); ?></p>
                    <p>Surface : <?php echo htmlspecialchars($garden['jardin_surface']); ?></p>
                    <?php if ($garden['jardin_photo']): ?>
                        <img src=""<?php echo htmlspecialchars($garden['jardin_photo']); ?>" alt="Photo du jardin">
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>
<footer>
    <p>© PAGEC - Tous droits réservés</p>
    <a href="../mentions.php">Mentions légales</a>
</footer>
