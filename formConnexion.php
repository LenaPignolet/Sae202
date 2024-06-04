<?php
require('header.php');
require('menu.php');
?>

<div id="form_contact">

    <form action="admin/Usagers/verifFormConnexion.php">
        <label for="">Email</label>
        <input type="text">

        <label for="">Mot de passe</label>
        <input type="text">

        <input type="submit">
    </form>
</div>

<?php
require('footer.php');
?>