<?php
require_once 'connexionbdd.php';
if (!empty($_POST)){
    $result = $pdo->query('SELECT * FROM articles');
    $req = $pdo->prepare('INSERT INTO articles(artTitre, artContenu, artDate) VALUES (:titre, :contenu, NOW())');
    $req->execute([
        'titre' => $_POST['artTitre'],
        'contenu' => $_POST['artContenu'],

    ]);
    header('Location: index.php');
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

    <form class="articles" action="index.php" method="post">
        <input type="text" name="artTitre" placeholder="Titre" required><br/>
        <textarea name="artContenu" rows="8" cols="80" placeholder="Contenu" required></textarea> <br/>

        <input type="submit" value="Envoyer">
    </br>
</br>
</form>
<table>
    <thead>

        <caption>Articles</caption>
        <tr class="titre_colonnes">
            <td>Titre</td>
            <td>Date</td>

        </tr>
    </thead>
    <?php
    $result = $pdo->query('SELECT * FROM articles');
    $articles= $result->fetchAll(PDO::FETCH_ASSOC);
    foreach ($articles as $article) {
        ?>
        <tbody>
            <tr>
                <td><?= $article['artTitre']?></td>
                <td><?= date('d/m/Y à H:i:s', strtotime($article['artDate']))?>
                        <td><a href="afficheArticle.php?id=<?= $article['idarticle'] ?>">voir</a></td></br>



                    </tr>
                </tbody>
            <?php } ?>
        </table>

    </body>
    </html>
