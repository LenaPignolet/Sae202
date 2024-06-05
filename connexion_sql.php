<?php
    try {
        $mabd = new PDO('mysql:host=localhost;dbname=sae202;charset=UTF8;','sae202User', '123');
    } catch (\PDOException $e) {
        echo $e->getMessage();
    }
?>