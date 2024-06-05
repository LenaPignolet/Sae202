<?php
require('header.php');
require('menu.php');
?>

<div id="form_contact">
    <h1>Connexion</h1>
    <form action="admin/Usagers/verifFormConnexion.php" method="post">
        <label for="">Email</label>
        <input type="text" name="user_email" placeholder="Votre email">

        <label for="">Mot de passe</label>
        <input type="password" name="user_password" placeholder="Mot de passe">

        <input type="submit">
    </form>
    <p>Pas encore de compte ? </p><a href="">Inscription</a>
</div>

<?php
require('footer.php');
?>