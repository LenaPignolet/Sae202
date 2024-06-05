<?php
require('header.php');
require('menu.php');
?>

<form action="admin/Usagers/validFormInscription.php" method="post">
    <label for="nom">Nom</label>
    <input type="text" id="nom" name="nom" placeholder="Votre nom">

    <label for="prenom">Prénom</label>
    <input type="text" id="prenom" name="prenom" placeholder="Votre prénom">

    <label for="email">Email</label>
    <input type="text" id="email" name="email" placeholder="Votre email">

    <label for="mdp">Mot de passe</label>
    <input type="password" id="mdp" name="mdp" placeholder="Votre nom">

    <input type="submit" value="S'inscrire" name="ok">
</form>

<?php
require('footer.php');
?>