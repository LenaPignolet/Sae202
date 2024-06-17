<?php

require('../connexion_sql.php');

$getAllMyQuestions = $mabd->prepare('SELECT id, titre, description FROM forum WHERE user_id = ?');
$getAllMyQuestions->execute(array($_SESSION['id']));