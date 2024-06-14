<?php
require('header.php');
require('menu.php');
?>
<body>
    <div id="home">
        <img src="images/logo.png" alt="">
        <p>Semer aujourd'hui, récolter demain</p>
        <a href="liste_jardins.php">Réserver maintenant</a>
    </div>
    <div id="home_content">
        <div id="recherche">
            <form action="">
                <h2>Rechercher un jardin près de chez vous</h2>
                <div class="input-container">
                    <img src="images/jardin.png" alt="Icon Nom">
                    <input type="text" placeholder="Nom du jardin">
                </div>

                <div class="input-container">
                    <img src="images/city.png" alt="Icon Ville">
                    <input type="text" placeholder="Ville">
                </div>

                <input id="recherche_button" type="submit" value="Recherche">
            </form>
        </div>
        <div id="tutos">
            <h2>Nos derniers tutos</h2>
            <p>Découvrez nos différentes vidéos de jardinage</p>
            <div id="videos">
                <img src="" alt="">
                <img src="" alt="">
                <img src="" alt="">
            </div>
            <a href="">Voir plus</a>
        </div>
        <div id="bienvenue">
            <h2>Bienvenue chez Gard'éco !</h2>
            <p>Site de cojardinage</p>

        </div>
        <div class="left">
            <div class="text">
                <h2>Jardinez ensemble !</h2>
                <p>Découvrez une nouvelle manière de jardiner en partageant votre passion 
                avec des jardiniers de votre quartier.<br>
                Que vous soyez un novice ou un expert du jardinage, notre communauté est 
                ouverte à tous.<br><br>
                Rejoignez-nous pour échanger des conseils, partager des ressources, et 
                cultiver ensemble un avenir plus vert et florissant.</p>
            </div>
            <img src="images/ensemble.png" alt="">
        </div>
        <div class="right">
            <div class="text">
                <h2>À Propos de Gard’éco</h2>
                <p>Gard’éco est né de l'envie de créer des liens entre jardiniers passionnés 
                et novices. Nous croyons que le jardinage est bien plus enrichissant lorsqu'il 
                est partagé. Notre plateforme vous permet de trouver des partenaires de jardinage, 
                de partager vos connaissances et de profiter des avantages du jardinage collaboratif.<br>
                Ensemble, faisons pousser non seulement des plantes, mais aussi des amitiés et des 
                communautés plus soudées.</p>
            </div>
            <img src="images/cojardinage.jpg" alt="">
        </div>
    </div>
    

<?php
require('footer.php');
?>