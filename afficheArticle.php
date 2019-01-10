<?php
require_once 'connexionbdd.php';
if (!empty($_POST)){
    $result = $pdo->query('SELECT * FROM articles');
    $req = $pdo->prepare('INSERT INTO articles(artTitre, artContenu, artDate) VALUES (:titre, :contenu, :art_date)');
    $req->execute([
        'titre' => $_POST['artTitre'],
        'contenu' => $_POST['artContenu'],
        'art_date' => $_POST['artDate']
    ]);
    header('Location: afficheArticle.php');
}

?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>aticles</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <?php
    $result = $pdo->prepare('SELECT * FROM articles WHERE idarticle = :idarticle');
    $result->execute([
        'idarticle' => $_GET['id']
    ]);
    $article = $result->fetch(PDO::FETCH_ASSOC);

        ?>
        <tbody>
            <tr>
                <td><?= $article['artTitre']?></td>
            <br><br>
                <td><?= $article['artContenu']?>
            <br><br>
                    <td><a href="modifierArticle.php?id=<?= $article['idarticle'] ?>">modifier</a></td></br>
                    <td><a href="supprimerArticle.php?id=<?= $article['idarticle'] ?>">Supprimer</a></td>
            <br><br>
                </tr>

            </tbody>

        <?php ?>
        <br>
        <a href="index.php">Retour</a>

</body>
</html>
