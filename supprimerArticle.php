<?php
    require_once 'connexionbdd.php';

    $result = $pdo->prepare('DELETE FROM articles WHERE idarticle = :idarticle');
    $result->execute(
        [
            'idarticle' => $_GET['id']
           ]);
           header('Location: afficheArticle.php');
 ?>
