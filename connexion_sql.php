<?php
    try {
        $mabd = new PDO('mysql:host=localhost;dbname=sae202Base;charset=UTF8;','usersae202', 'sae202');
    } catch (\PDOException $e) {
        echo $e->getMessage();
    }
?>