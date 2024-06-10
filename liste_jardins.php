<?php
require('header.php');
require('menu.php');
?>


<div id="listeJardin">
    <div id="banniere">
        <h2>Réservez votre jardin dès maintenant</h2>
    </div>

    <h1>Liste de nos jardins</h1>

    <?php
        require('connexion_sql.php');
        $mabd->query('SET NAMES utf8;');
        $req = "SELECT * FROM Jardin";
        $resultat = $mabd->query($req);
        echo '<main class="page1-2">';
        echo '<section class="produits">';
        foreach ($resultat as $value) {

            echo '<article>';
            echo '<div class="liste">' ;
            echo '<img alt="jardin" class="img_jardin" src="images/uploads/'.$value['jardin_photo'].'">';
            echo '<p>Jardin : '.$value['jardin_nom'] . '</p>';
            echo '<p>Adresse : ' . $value['jardin_coord'] . '</p>';
            echo '<p>Surface : ' . $value['jardin_surface'] . '</p>';
            echo '<p>N° de parcelle : '.$value['jardin_n_parcelle'] . '</p>';
            echo '<hr>';
            echo '</div>';
            echo '</article>';

        }
        echo '</section>';
        echo '</main>';
        ?>

    <div>
    </div>

</div>
















<?php
require('footer.php');
?>