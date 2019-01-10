<?php
try{
    $dns_bdd = 'mysql:host=localhost;dbname=cours_php';
    $user_bdd = 'root';
    $pass_bdd = '';
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];
    $pdo = new PDO($dns_bdd, $user_bdd, $pass_bdd, $options);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
 ?>
